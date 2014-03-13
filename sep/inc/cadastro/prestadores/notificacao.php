<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sem t&iacute;tulo</title>
<script>
function funcaoNotificacao(){
	if(document.getElementById('notificacao').value==""){
		alert('Favor preencher o campo: NOTIFICAÇÃO');
	}else{
		enviarNotificacao();
	}
}


function enviarNotificacao(){
	
	document.getElementById('campoOculto').value = "";
	var campos = "";
	var total = document.formulario.elements.length-4;
	var i = 0;
	while(i<=total){
		
		if(document.formulario.elements[i].checked == true){
			document.getElementById('campoOculto').value += document.formulario.elements[i].value+'|||';
		}
		i++;
	}

	
	var email = document.getElementById('emailOculto').value;
	var campos = document.getElementById('campoOculto').value;
	var codigo = document.getElementById('codigoOculto').value; 
	var notificacao = nl2br(document.getElementById('notificacao').value);
	
	
	var random_number = Math.floor(Math.random()*90000000000);
	var url = "http://barradopirai.rj.gov.br/enota_dev/site/enviarNotificacao.php?email="+email+"&codigo="+codigo+"&campos="+campos+"&notificacao="+notificacao+"&random_number="+random_number;
	window.open(url,"_blank","toolbar=no, scrollbars=no, resizable=no, top=100, left=100, width=300, height=300");
	document.getElementById('divNotificacao').style.visibility = "hidden";
	
}

function nl2br (str, is_xhtml) {
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Philip Peterson
  // +   improved by: Onno Marsman
  // +   improved by: Atli Þór
  // +   bugfixed by: Onno Marsman
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +   improved by: Maximusya
  // *     example 1: nl2br('Kevin\nvan\nZonneveld');
  // *     returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
  // *     example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
  // *     returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
  // *     example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
  // *     returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'
  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}


</script>
</head>

<body>

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
    <td  background="img/form/cabecalho_fundo.jpg" align="left" class="formCabecalho">&nbsp;SEPISS - Notifica&ccedil;&atilde;o</td>  
    <td width="19" align="right" valign="top" background="img/form/cabecalho_fundo.jpg"><img src="img/form/cabecalho_btfechar.jpg" width="19" height="21" border="0" onclick="document.getElementById('divNotificacao').style.visibility='hidden'" title="Fechar" /></td>
  </tr>
  <tr>
    <td width="18" background="img/form/lateralesq.jpg"></td>
    <td align="center">
    <form name="formulario" id="formulario" method="post">
    <input type="hidden" id="emailOculto" name="emailOculto" />
    <input type="hidden" id="codigoOculto" name="codigoOculto" />
    
	<table width="100%"> 
    	<tr>
        	<td colspan="4">
            <b>Selecione abaixo os campos que ser&atilde;o notificados:</b>
            </td>
        </tr>
        <tr>
        	<td><input type="checkbox" name="notificacao_nome" id="notificacao_nome" value="Nome" />&nbsp;Nome</td>
        	<td><input type="checkbox" name="notificacao_razao" id="notificacao_razao" value="Raz&atilde;o Social" />&nbsp;Raz&atilde;o Social</td>
        	<td><input type="checkbox" name="notificacao_inscr_estadual" id="notificacao_inscr_estadual" value="Incric. Estadual" />&nbsp;Incric. Estadual</td>
        	<td><input type="checkbox" name="notificacao_inscr_municipal" id="notificacao_inscr_municipal" value="Incric. Municipal" />&nbsp;Incric. Municipal</td>
        </tr>
        <tr>
        	<td><input type="checkbox" name="notificacao_cpf_cnpj" id="notificacao_cpf_cnpj" value="CPF/CNPJ" />&nbsp;CPF/CNPJ</td>
        	<td><input type="checkbox" name="notificacao_logradouro" id="notificacao_logradouro" value="Logradouro" />&nbsp;Logradouro</td>
        	<td><input type="checkbox" name="notificacao_numero" id="notificacao_numero" value="N&uacute;mero" />&nbsp;N&uacute;mero</td>
        	<td><input type="checkbox" name="notificacao_complemento" id="notificacao_complemento" value="Complemento" />&nbsp;Complemento</td>
        </tr>
        <tr>
        	<td><input type="checkbox" name="notificacao_bairro" id="notificacao_bairro" value="Bairro" />&nbsp;Bairro</td>
        	<td><input type="checkbox" name="notificacao_cep" id="notificacao_cep" value="CEP" />&nbsp;CEP</td>
        	<td><input type="checkbox" name="notificacao_tel_com" id="notificacao_tel_com" value="Telefone Comercial" />&nbsp;Telefone Comercial</td>
        	<td><input type="checkbox" name="notificacao_tel_cel" id="notificacao_tel_cel" value="Telefone Celular" />&nbsp;Telefone Celular</td>
        </tr>
        <tr>
        	<td><input type="checkbox" name="notificacao_data_inicio" id="notificacao_data_inicio" value="Data In&iacute;cio" />&nbsp;Data In&iacute;cio</td>
        	<td><input type="checkbox" name="notificacao_email" id="notificacao_email" value="Email"  />&nbsp;Email</td>
        	<td><input type="checkbox" name="notificacao_pis" id="notificacao_pis" value="PIS/PASEP" />&nbsp;PIS/PASEP</td>
        	<td><input type="checkbox" name="notificacao_socio" id="notificacao_socio" value="S&oacute;cio" />&nbsp;S&oacute;cio</td>
        </tr>
        <tr>
        	<td><input type="checkbox" name="notificacao_uf" id="notificacao_uf" value="UF" />&nbsp;UF</td>
        	<td><input type="checkbox" name="notificacao_municipio" id="notificacao_municipio" value="Munic&iacute;pio" />&nbsp;Munic&iacute;pio</td>
        	<td><input type="checkbox" name="notificacao_tipo_declaracao" id="notificacao_tipo_declaracao" value="Tipo de Declara&ccedil;&atilde;o" />&nbsp;Tipo de Declara&ccedil;&atilde;o</td>
        	<td><input type="checkbox" name="notificacao_servicos" id="notificacao_servicos" value="Servi&ccedil;os" />&nbsp;Servi&ccedil;os</td>
        </tr>
        <tr>
        	<td><input type="checkbox" name="notificacao_regime_especial" id="notificacao_regime_especial" value="Regime Especial" />&nbsp;Regime Especial</td>
        	<td colspan="3"><input type="checkbox" name="notificacao_isento" id="notificacao_isento" value="Isento (Esta empresa &eacute; isenta de ISS)" />&nbsp;Isento (Esta empresa &eacute; isenta de ISS)</td>
        </tr>
        <tr>
        	<td colspan="4">
            Descreva abaixo a notifica&ccedil;&atilde;o ao prestador:<br />
            <textarea id="notificacao" name="notificacao" style="width:100%;height:150px;"></textarea>
            <br />
   			<input type="hidden" id="campoOculto" name="campoOculto" />
            <input type="button" value="Enviar" class="botao" onclick="funcaoNotificacao();" style="float:right"/><!-- funcaoNotificacao(); -->
            </td>
        </tr>
        
    </table>
    </form>

<!--
<form method="post"  name="frmbusca" id="frmbusca">
		<input type="hidden" name="include" id="include" value="<?php echo  $_POST['include'];?>" />
	<table width="100%">        
        <tr>        	
			<td>
            	CPF/CNPJ</td>
            <td rowspan="4" valign="middle"><input name="btBuscarCliente" type="submit" value="" id="btBuscarCliente" title="Buscar"></td>
        </tr>   
        <tr>        	
			<td>
            	<input name="txtBuscaCPFCNPJ" id="txtBuscaCPFCNPJ" type="text" class="texto" size="59" style="background-color:#255b8f; color:#FFFFFF; text-transform:uppercase" onkeydown="return NumbersOnly( event );" onkeyup="CNPJCPFMsk( this );">	
			</td>            
	  	</tr>
        <tr>        	
			<td colspan="2"> 
            	Nome
			</td>
        </tr>   
        <tr>        	
			<td colspan="2">
            	<input name="txtBuscaNome" id="txtBuscaNome" type="text" class="texto" size="59" style="background-color:#255b8f; color:#FFFFFF; text-transform:uppercase"  >	
			</td>
            
	  	</tr>
	  <tr>
		<td background="img/busca_fundo.jpg" align="center" colspan="2">	
		<select name="CODEMISSOR" id="CODEMISSOR" size="18" style="width:400px; background-color:#255b8f;color:#FFFFFF;" class="combo" onchange="document.frmbusca.submit();">   		
			<?php 
				$codtipo_orgaop = codtipo('orgao_publico');
			if(isset($_POST['txtBuscaNome']))
				{
					$nome=$_POST['txtBuscaNome'];
					$cpfcnpj = $_POST['txtBuscaCPFCNPJ'];
					$campo = tipoPessoa($cpfcnpj);
					
					if($nome != '' && $cpfcnpj == ''){
						$where=" WHERE nome LIKE'%$nome%' AND estado <> 'NL'";
					}
					else if($nome == '' && $cpfcnpj != ''){
						$where=" WHERE $campo LIKE'%$cpfcnpj%' AND estado <> 'NL'";
					}
					
					//$nome?$cpfcnpj?$where=" WHERE nome LIKE'%$nome%' AND $campo = '$cpfcnpj' AND estado <> 'NL'":$where=" WHERE nome LIKE'%$nome%' AND estado <> 'NL'":NULL;
					//$cpfcnpj?$where=" WHERE $campo = '$cpfcnpj' AND estado <> 'NL'":NULL;
					
					$sql=mysql_query("
					SELECT 
						codigo,
						nome, 
						razaosocial,
						IF(cnpj <> '',cnpj,cpf) AS cnpjcpf,
						inscrmunicipal,
						logradouro,
						numero, 
						municipio, 
						uf, 
						logo,
						email,
						ultimanota, 						
						notalimite,						
						estado, 
						codcontador,
						nfe					
					FROM 
						cadastro 										
					$where
					ORDER BY
						nome
					");
					while(list($codigo,$nome,$razaosocial,$cnpjcpf,$inscrmunicipal,$logradouro,$numero,$municipio,$uf,$logo,$email,$ultima,$notalimite,$estado,$simplesnaconal,$codcontador,$nfe) = mysql_fetch_array($sql)){
						if(!$razaosocial){
							$razaosocial = $nome;
						}
						switch($notalimite){
							case 0:	 $aidf = "Liberado";  break;
							default: $aidf = $notalimite; break;
						}//fim switch
						switch($estado){
							case "A": $estado = "Ativo";  break;
							case "I": $estado = "Inativo";break;
						}//fim switch
						if($razaosocial){
							echo "<option value=\"$codigo\">".$cnpjcpf." - ".$razaosocial."</option>";
						}
					}
				}?>
		</select>
       
		</td>
	</tr>
</table>
</form>
-->
	</td>
	<td width="19" background="img/form/lateraldir.jpg"></td>
  </tr>
  <tr>
    <td align="left" background="img/form/rodape_fundo.jpg"><img src="img/form/rodape_cantoesq.jpg" /></td>
    <td background="img/form/rodape_fundo.jpg"></td>
    <td align="right" background="img/form/rodape_fundo.jpg"><img src="img/form/rodape_cantodir.jpg" /></td>
  </tr>
</table>

<map name="Map"><area shape="rect" coords="277,4,294,18" onclick="document.getElementById('divNotificacao').style.visibility='hidden';" title="Fechar">
</map>
</body>
</html>
