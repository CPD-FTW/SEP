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
<?php
	//Recebe as variaveis de post vindas do arquivo regras_visualizar.ajax.php e atualiza no banco
	$aliquota   = $_POST['txtAliquotaEdit'];
	$estado     = $_POST['cmbEstadoEdit'];
	$cod_update = $_POST['hdCodAliquotaAtualizar'];
	
	$result = mysql_query("SELECT aliquota FROM aliquotas WHERE aliquota = $aliquota AND codigo != '$cod_update'");
	$row = mysql_fetch_row($result);
	
	if($row > 0){
		Mensagem_onload(utf8_decode("Esta alíquota já foi inserida!"));
	}
	else{	
		mysql_query("UPDATE aliquotas SET aliquota = $aliquota, estado = '$estado' WHERE codigo = '$cod_update'");
		Mensagem_onload(utf8_decode("Alíquota atualizada!"));
	}
?>