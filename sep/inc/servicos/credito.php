<?php
/*
COPYRIGHT 2008 - 2010 DO PORTAL PUBLICO INFORMATICA LTDA

Este arquivo e parte do programa E-ISS / SEP-ISS

O E-ISS / SEP-ISS e um software livre; voce pode redistribui-lo e/ou modifica-lo
dentro dos termos da Licenca Publica Geral GNU como publicada pela Fundacao do
Software Livre - FSF; na versao 2 da Licenca

Este sistema e distribuido na esperanca de ser util, mas SEM NENHUMA GARANTIA,
sem uma garantia implicita de ADEQUACAO a qualquer MERCADO ou APLICACAO EM PARTICULAR
Veja a Licenca Publica Geral GNU/GPL em portugues para maiores detalhes

Voce deve ter recebido uma copia da Licenca Publica Geral GNU, sob o titulo LICENCA.txt,
junto com este sistema, se nao, acesse o Portal do Software Publico Brasileiro no endereco
www.softwarepublico.gov.br, ou escreva para a Fundacao do Software Livre Inc., 51 Franklin St,
Fith Floor, Boston, MA 02110-1301, USA
*/
?>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#CCCCCC">
  <tr>
    <td width="18" align="left" background="img/form/cabecalho_fundo.jpg"><img src="img/form/cabecalho_icone.jpg" /></td>
    <td width="600" background="img/form/cabecalho_fundo.jpg" align="left" class="formCabecalho">&nbsp;Utilit&aacute;rios - Cr&eacute;ditos</td>  
    <td width="19" align="right" valign="top" background="img/form/cabecalho_fundo.jpg"><a href=""><img src="img/form/cabecalho_btfechar.jpg" width="19" height="21" border="0" /></a></td>
  </tr>
  <tr>
    <td width="18" background="img/form/lateralesq.jpg"></td>
    <td align="center">
		<form method="post">
			<input type="hidden" name="include" id="include" value="<?php echo $_POST["include"];?>" />
			<fieldset><legend>Creditos</legend>
				<table width="100%">
					<tr>
						<td width="50%" align="right">
							<input type="submit" class="botao" name="btRegras" value="Regras de Crédito" />
						</td>
						<td width="50%" align="left">
							<input type="submit" class="botao" name="btUtilizacao" value="Utilizar Crédito" />
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
			<?php
				if($_POST["btRegras"] == "Regras de Crédito"){
					include("inc/utilitarios/regras_credito.php");
				}elseif($_POST["btUtilizacao"] == "Utilizar Crédito"){
					include("inc/utilitarios/creditos/creditos.php");
				}//fim elseif
			?>
            
	</td>
	<td width="19" background="img/form/lateraldir.jpg"></td>
  </tr>
  <tr>
    <td align="left" background="img/form/rodape_fundo.jpg"><img src="img/form/rodape_cantoesq.jpg" /></td>
    <td background="img/form/rodape_fundo.jpg"></td>
    <td align="right" background="img/form/rodape_fundo.jpg"><img src="img/form/rodape_cantodir.jpg" /></td>
  </tr>
</table>
<?php
if($_POST['btConfirma']){
	//Array ( [txtMenu] => [txtTomCpfCnpj] => 05.005.501/0001-84 [txtImovel] => 57 [btConfirma] => Confirmar ) 
	//Array ( [txtMenu] => creditos [hdCod] => 20182005 [txtImovel] => 57 [txtCredito] => 64,84 [btConfirma] => Confirmar )
	require_once("../include/conect.php");
	require_once("../../../middleware/pmfeliz/autoload.php");
	$valorcredito=$_POST["txtCredito"];
	if($valorcredito>0){
		$abatimento = MoedaToDec($_POST["hdAbat"]);
		$codigoimoveis=$_POST["txtImovel"];
		$codcadastro=$_POST["hdCod"];
		$query=mysql_query("SELECT credito FROM cadastro WHERE codigo='$codcadastro'");
		list($creditocadastro)=mysql_fetch_array($query);
		$valorcredito=MoedaToDec($valorcredito);
		$creditonovo = $creditocadastro - $valorcredito;
		$hoje = date("Y-m-d H:i:s");
		$procura = mysql_query("SELECT * FROM creditos_imoveis WHERE codcadastro = '$cod' AND estado = 'A'");
		if(mysql_num_rows($procura)>0){
			Mensagem("Esse CNPJ já fez solicita&ccedil;&atilde;o e aguarda libera&ccedil;&atilde;o da prefeitura.");
		}else{
			if(mysql_query("INSERT INTO creditos_imoveis (codcadastro, codimovel) VALUES ('$codcadastro','$codigoimoveis')")){
				$imoveis = new Postgre_Smabas01();
				$imoveis->setNumCad($codigoimoveis);
				$guia = new Postgre_GuiaPagamento();
				$imoveis->CarregaNumCad();
				$valoratual=$imoveis->getVlrDesc();
				$valtotal=MoedaToDec($valorcredito)+$valoratual;
				$imoveis->setVlrDesc($valtotal);
				$querycod=mysql_query("SELECT MAX(codigo) FROM creditos_imoveis");
				list($codcredimoveis)=mysql_fetch_array($querycod);	
				if($valtotal>$abatimento){
					mysql_query("DELETE FROM creditos_imoveis WHERE codigo='$codcredimoveis'");
					Mensagem('Erro ao utilizar cr&eacute;ditos4');
				}else{
					$imoveis->AtualizaValor();
					mysql_query("UPDATE cadastro SET credito='$creditonovo' WHERE codigo = '$codcadastro'");
					$hoje = date("Y-m-d H:i:s");
					if(mysql_query("INSERT INTO creditos_imoveis_usado (codcadastro, creditousado, creditoanterior, creditoatual, data, codcredito) VALUES ('$codcadastro','$valorcredito','$creditocadastro','$creditonovo','$hoje','$codcredimoveis')")){
						mysql_query("UPDATE creditos_imoveis SET estado = 'U' WHERE codigo='$codcredimoveis'");
						Mensagem("Cr&eacute;ditos usados");
					}else{
						Mensagem('Erro ao utilizar cr&eacute;ditos1');
					}
				}
			}else{
				Mensagem('Erro ao utilizar cr&eacute;ditos2');	
			}
		}
	}else{
		Mensagem('Erro ao utilizar cr&eacute;ditos3');	
	}
	/*$cnpj = $_POST['txtTomCpfCnpj'];
	$imovel = $_POST['txtImovel'];
	if($imovel!=""){
		$cod = $_POST['hdCod'];
		$vercredito = mysql_query("SELECT credito FROM cadastro WHERE codigo = '$cod'");
		list($credito)=mysql_fetch_array($vercredito);
		if($credito>0){
			$procura = mysql_query("SELECT * FROM creditos_imoveis WHERE codcadastro = '$cod' AND estado = 'A'");
			if(mysql_num_rows($procura)>0){
				Mensagem("Esse CNPJ já fez solicita&ccedil;&atilde;o e aguarda libera&ccedil;&atilde;o da prefeitura.");
			}else{
				if(mysql_query("INSERT INTO creditos_imoveis (codcadastro, codimovel) VALUES ('$cod','$imovel')")){
					Mensagem('Solicita&ccedil;&atilde;o enviada &agrave; prefeitura');	
				}else{
					Mensagem('Erro ao fazer solicita&ccedil;&atilde;o');	
				}
			}
		}else{
			Mensagem("Esse CNPJ n&atilde;o possui cr&eacute;ditos");	
		}
	}else{
		Mensagem("Nenhum im&oacute;vel selecionado");	
	}*/
	//$sql = mysql_query("SELECT * FROM cadastro");
}

	//Recebe as variaveis da busca
	$tipopessoa = $_POST['cmbTipoPessoa'];
	$issretido  = $_POST['cmbISSRetido'];
	$valor      = $_POST['txtValor'];
	$credito    = $_POST['txtCredito'];
	
	
	
	if($_POST['btInserir'] == "Inserir regra"){
		if(($tipopessoa) && ($issretido) && ($valor) && ($credito)){
			$valor = MoedaToDec($valor);
			mysql_query("INSERT INTO nfe_creditos SET credito = '$credito', tipopessoa = '$tipopessoa', issretido = '$issretido', valor = '$valor', estado = 'A'");
			add_logs('Inseriu uma Regra');
			Mensagem("Regra inserida com sucesso!");
		}else{
			Mensagem("Preencha os campos obrigatórios!");
		}		
	}
	
	if($_POST['btApagarCreditos']=="Apagar"){
		//require_once("../../../middleware/pmfeliz/autoload.php"); path do labin
		require_once("../include/conect.php");
		require_once("../../../middleware/pmfeliz/autoload.php");
		$imoveis=new Postgre_Smabas01();
		$imoveis->setNumCad('5');
		$imoveis->CarregaNumCad();
		$imoveis->ApagarValores(); 
		Mensagem('Valores apagados');
		
	}
	
	if($_POST['btSalvar'] == "Salvar"){
		$codigoedit     = $_POST['hdCodCredito'];
		$tipopessoaedit = $_POST['cmbTipoPessoaEdit'];
		$issretidoedit  = $_POST['cmbISSRetidoEdit'];
		$valoredit      = MoedaToDec($_POST['txtValorEdit']);
		$creditoedit    = $_POST['txtCreditoEdit'];
		$estadoedit     = $_POST['cmbEstadoEdit'];
		mysql_query("UPDATE nfe_creditos SET credito = '$creditoedit', tipopessoa = '$tipopessoaedit', issretido = '$issretidoedit', valor = '$valoredit', estado = '$estadoedit' WHERE codigo = '$codigoedit'");
		add_logs('Atualizou uma regra');
		Mensagem("Informações da regra atualizadas!");
	}
	
	if($_POST['btExcluir'] != ""){
		$cod = $_POST['hdCodCred'];
		mysql_query("DELETE FROM nfe_creditos WHERE codigo = '$cod'");
		add_logs('Exclui uma regra');
		Mensagem("Regra Excluida!");
	}
	
	if($_POST['btAtivarSistema']){
		if($_POST['rbCreditos'] == 'sim'){
			mysql_query("UPDATE configuracoes SET ativar_creditos = 's'") or die(mysql_error());
			//Mensagem_onload("Sistema de regras ativado");
		}else{
			mysql_query("UPDATE configuracoes SET ativar_creditos = 'n'") or die(mysql_error());
			//Mensagem_onload("Sistema de regras desativado");
		}
		
		
		if($_POST['rbCreditosUtilizacao'] == 'sim'){
			mysql_query("UPDATE configuracoes SET utilizar_creditos = 's'") or die(mysql_error());
			//require_once("../../../middleware/pmfeliz/autoload.php"); path do labin
			require_once("../include/conect.php");
			require_once("../../../middleware/pmfeliz/autoload.php");
			$imoveis=new Postgre_Smabas01();
			$imoveis->setNumCad('5');
			$imoveis->CarregaNumCad();
			$imoveis->ApagarValores(); 
			//Mensagem_onload("Cr&eacute;ditos podem ser utilizados");
		}else{
			mysql_query("UPDATE configuracoes SET utilizar_creditos = 'n'") or die(mysql_error());
			//Mensagem_onload("Cr&eacute;ditos bloqueados para utiliza&ccedil;&atilde;o");
		}
		Mensagem_onload("Regras de cr&eacute;ditos atualizadas com sucesso");
	}

?>