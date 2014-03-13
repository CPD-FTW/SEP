<?php

  if(date("Ymd")< 20140224){
	 header('Content-Type: text/html; charset=utf-8');
	 print "<script>alert('O Ambiente de Produção estará disponível dia 24/02/2014. \\n Assim você está sendo redirecionado ao Ambiente de Teste.');window.location='http://www.barradopirai.rj.gov.br/enota_teste/site/index.php'</script>"; 
  }


  $useragent = $_SERVER['HTTP_USER_AGENT'];
  $testaNavegador = strrpos($useragent,"MSIE");
  if(is_numeric($testaNavegador)){
	  
	  print "<script>window.location='navegadores.php'</script>";
  }
  
  
?>
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
$URL ="http://www.barradopirai.rj.gov.br/enota"; 

$HOST = "br12.hostgator.com.br";
$USUARIO = "pmbpr396_desenvo";
$SENHA = "seiti*2013";
$BANCO = "pmbpr396_desenvolvimento";

echo "login: ".$_SESSION['login-banco']."<BR>";

if ($_SESSION['login-banco'] == 'yuri'){
	$USUARIO = 'pmbpr396_yuri';
}

echo 'usuario do banco:'. $USUARIO."<br>";

/*
$HOST = "localhost";
$USUARIO = "root";
$SENHA = "";
$BANCO = "enota";
*/
?>
