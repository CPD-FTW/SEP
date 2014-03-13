<?php

$partes = explode('|||',$_GET['campos']);
$total = count($partes)-2;
$campos = '';
$i=0;
while($i<=$total){
	$campos .= "<b>&radic;&nbsp;".$partes[$i]."&nbsp;</b>&nbsp;"; 
	$i++;
}

//$email = $_GET['email'];
$email = 'diosanv@hotmail.com';
$notificacao = $_GET['notificacao'];

		$imagemTratada = "http://barradopirai.rj.gov.br/efiscal/enota_new/img/brasoes/prefeitura.png";
		$msg = "
		<a href=\"$LINK_ACESSO\" style=\"text-decoration:none\" ><img src=\"$imagemTratada\" alt=\"Bras&atilde;o Prefeitura\" title=\"Bras&atilde;o Prefeitura\" border=\"0\" style=\"max-height:80px;\" /></a><br><br>
		<br>
		Testeeeeee
		";
		
		$assunto = "Notificação NF-e (BARRA DO PIRAÍ).";
	
		$headers  = "MIME-Version: 1.0\r\n";
	
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	
		$headers .= "From: SECRETARIA DE FAZENDA de BARRA DO PIRAÍ <diosanv@hotmail.com>  \r\n";
	
		$headers .= "Cc: \r\n";
	
		$headers .= "Bcc: \r\n";

		$msg = utf8_decode($msg);
		
		/*
		$msg = "
		<a href=\"$LINK_ACESSO\" style=\"text-decoration:none\" ><img src=\"$imagemTratada\" alt=\"Bras&atilde;o Prefeitura\" title=\"Bras&atilde;o Prefeitura\" border=\"0\" style=\"max-height:80px;\" /></a><br><br>
		O cadastro da empresa <b>".utf8_encode($_POST['txtInsNomeEmpresa'])."</b> foi efetuado com sucesso.<br>
		Dados da empresa:<br><br>
		Razão Social: ".utf8_encode($_POST['txtInsRazaoSocial'])."<br>
		CPF/CNPJ: $cpfcnpj<br>
		Município: ".utf8_encode($_POST['txtInsMunicipioEmpresa'])."<br>
		Endereço: ".utf8_encode($_POST['txtLogradouro']).", ".utf8_encode($_POST['txtNumero'])."<br><br>
		  
		Veja passo a passo como acessar o sistema:	<br><br>
		1- Acesse o site <a href=\"$LINK_ACESSO\"><b>NF-e</b></a><br>
		2- Entre em consulta, insira seu CNPJ/CPF e verifique se j&aacute; foi liberado seu acesso ao sistema<br>
		3- Clique no link Prestador<br>
		4- Entre em acessar o sistema<br>
		5- Em login insira o cpf/cnpf da empresa<br>
		6- Sua senha &eacute; <b><font color=\"RED\">$senha</font></b><br>
		7- Insira o c&oacute;digo de verifica&ccedil;&atilde;o que aparece ao lado<br>";
		
		$assunto = "Acesso ao Sistema NF-e ($CONF_CIDADE).";
	
		$headers  = "MIME-Version: 1.0\r\n";
	
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	
		$headers .= "From: $CONF_SECRETARIA de $CONF_CIDADE <$CONF_EMAIL>  \r\n";
	
		$headers .= "Cc: \r\n";
	
		$headers .= "Bcc: \r\n";

		$msg = utf8_decode($msg);
		*/
		
		mail("$email",$assunto,$msg,$headers);
		
		print "ok";


?>