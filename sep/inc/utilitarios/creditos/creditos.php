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
<script type="text/javascript">
//Rodrigo----------------------------------------------------
//verifica digitos de cpf/cnpj
function verificacpfcnpj(){
	
	var x = document.getElementById('txtTomCpfCnpj').value;
	if (x.length < 14){
		var msg = utf8_decode('CNPJ/CPF inválido');
		alert(msg);
		document.getElementById('txtTomCpfCnpj').value = '';

	} else if (x.length >= 15 && x.length <=17) {
		var msg = utf8_decode('CNPJ/CPF inválido');
		document.getElementById('txtTomCpfCnpj').value = '';
	} else {
		return false;
	}
}
//Rodrigof--------------fim-------------------------------
function RetornaImovel(str,cod)
{
if (str.length==0)
  {
  document.getElementById("spanRetorno").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("spanRetorno").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","inc/utilitarios/creditos/creditos_imoveis.ajax.php?q="+str+"&cod="+cod,true);
xmlhttp.send();
}
function atualizacreditos(valormaximo,valortotal){
	var credito = MoedaToDec(document.getElementById('txtCredito').value);
	if(credito>valormaximo){
		credito=valormaximo;
		document.getElementById('txtCredito').value = DecToMoeda(valormaximo);
	}
	var valordesconto = (valortotal - credito);
	document.getElementById('txtValorDesconto').value = DecToMoeda(valordesconto);	
}

function validaLoginTomador(){
	
}
</script>
<fieldset>
<form method="post" id="frmCreditos">
<input type="hidden" name="include" id="include" value="<?php echo $_POST["include"];?>" />
	<div id="divUsarCreditos">
	<table width="580" border="0" cellpadding="0" cellspacing="1">
		<tr>
			<td height="60" colspan="3" bgcolor="#CCCCCC">
                <table width="99%" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                        <td width="30%" align="left">Tomador CPF/CNPJ</td>
                        <td width="70%"  align="left"><input type="text" name="txtTomCpfCnpj" id="txtTomCpfCnpj" onblur="verificacpfcnpj( this )" size="20" class="texto" onkeyup="CNPJCPFMsk(this);"/></td> 
                    </tr>
                    <tr>
                        <td align="left" colspan="2">
                        	<input type="button" name="btConsultarCreditos" id="btConsultarCreditos" value="Consultar" class="botao" 
                            	onclick="return (ValidaFormulario('txtTomCpfCnpj','Preencha todos os dados para continuar')) &&
                                (acessoAjax('inc/utilitarios/creditos/creditos.ajax.php','frmCreditos','divUsarCreditos'));" 
                             />
                        </td>
                    </tr>
                </table>
		        <tr>
            <td height="1" colspan="3" bgcolor="#CCCCCC"></td>
        </tr>
	</table>
    </div>
</form>
</fieldset><br />