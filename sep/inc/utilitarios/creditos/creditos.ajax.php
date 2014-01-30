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
<table width="580" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td colspan="3" height="1" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
			<td height="60" colspan="3" bgcolor="#CCCCCC">
<?php
require_once("../../../../include/conect.php");
require_once("../../../../funcoes/util.php");


$txtTomCpfCnpj = $_GET['txtTomCpfCnpj'];
	if($txtTomCpfCnpj !=""){ 
			$campo = tipoPessoa($txtTomCpfCnpj);
			$sql = mysql_query("SELECT codigo, $campo, credito, nome  FROM cadastro WHERE $campo = '$txtTomCpfCnpj'");
			if(mysql_num_rows($sql)>0){
				$nrocreditos=mysql_num_rows($sql);
				list($codtom, $cpfcnpj, $credito, $nro)=mysql_fetch_array($sql);
					?>
						<table bgcolor="#CCCCCC" width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
							<tr bgcolor="#999999">
								<td align="center">Nome</td>
								<td align="center">CPF/CNPJ</td>
								<td align="center">Créditos</td>
								<td width="40" align="center">Ações</td>
							</tr>
					<?php
					
					echo "<input type=\"hidden\" value=\"$codtom\" name=\"hdCod\" />";
					$crd_tomador = DecToMoeda($credito);
					echo "
						<tr bgcolor=\"#FFFFFF\">
							<td align=\"center\">$nro</td>
							<td align=\"center\">$cpfcnpj</td>
							<td align=\"center\">R$ $crd_tomador</td>
							<td width=\"40\">";
							if($UTILIZAR_CREDITOS=="s"){echo "<input type=\"button\" name=\"btUsarCreditos\" class=\"botao\" onclick=\"acessoAjax('inc/utilitarios/creditos/creditos_usar.ajax.php?cod=".$codtom."&','frmCreditos','divUsarCreditosR')\" id=\"btUsarCreditos\" value=\"Utilizar Créditos\" />";}
							
							echo "</td>
						</tr>
					";
					?>
					</table><div id="divUsarCreditosR" style="background:#CCC"></div>
					<?php
			}else{
				echo 'Tomador não cadastrado no sistema';
			}
	}	
	else{
		echo 'O campo CPF/CNPJ deve ser preenchido';
	}
?>			
			</td>
        </tr>
	</table>
