<?php 
include "diaryvw.php";
include "msqlreg.php";

$idd = $_POST["idd"];
$cbissoo = $_POST["cbissoo"];
if ($idd=="")
{
?>
<html>
<head>
<title>Счетчик жизни @дневника</title>
<meta http-equiv="content-type" content="text/html; charset=windows-1251">
<style type="text/css">
body {
 margin: 0px;
 padding: 0;
 font-family: "Trebuchet ms", Verdana, Arial, Helvetica, sans-serif;
 color: #804;
 background-color: #fff;
 background-image: url('pix/bug.jpg');
 background-repeat: no-repeat;
 font-size: 16px;
 min-width: 600px;
}
.mtable {
 border: dotted;
 border-width: 2px;
 background-color: none;
 background-image: url('pix/bg_extratop.gif');
 width: 85%;
 border-spacing: 3px 3px;


A:link { COLOR: #063; TEXT-DECORATION: underline; }
A:active { COLOR: #063; TEXT-DECORATION: underline; }
A:visited { COLOR: #063; TEXT-DECORATION: underline; }
A:hover { COLOR: #00f; TEXT-DECORATION: none; }
</style>

</head>
<body>
<BR>
<div align=center>
<table class="mtable">
<tr><td style='text-align:center; padding:5px;'><B>Сколько дней Вашему DiaryRu-дневнику?</B></td></tr>
<tr><td style='text-align:center; font-size:14px; padding:5px;'> Зарегистрируйте себе счетчик, и будете знать ответ каждый день :)<BR>
Введите дату создания дневника или сообщества в формате 23.02.2007 <BR><BR>
<form action=reg.php method=post>
<input type="text" name="idd" size="10">
<input type="submit" value="Зарегистрировать!">
<br><input type="checkbox" id="cbissoo" name="cbissoo" value="Сообщество">Счётчик для сообщества</input>
</form>
</td></tr>

</table></div>
<div align="center"><font face="sans-serif" color="#0000FF" size="2"><BR>
  Сделано <a href=http://www.diary.ru/~eatssp1/>Arvenktur'ом</a><BR>2007<BR>
  Вопрос можно задать <a href=http://www.diary.ru/~eatssp1/p80248243.htm>здесь</a>
  </font></div>
<div align=center><!--Rating@Mail.ru counter-->
<script language="javascript"><!--
d=document;var a='';a+=';r='+escape(d.referrer);js=10;//--></script>
<script language="javascript1.1"><!--
a+=';j='+navigator.javaEnabled();js=11;//--></script>
<script language="javascript1.2"><!--
s=screen;a+=';s='+s.width+'*'+s.height;
a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;//--></script>
<script language="javascript1.3"><!--
js=13;//--></script><script language="javascript" type="text/javascript"><!--
d.write('<a href="http://top.mail.ru/jump?from=2058810" target="_top">'+
'<img src="http://da.c6.bf.a1.top.mail.ru/counter?id=2058810;t=56;js='+js+
a+';rand='+Math.random()+'" alt="Рейтинг@Mail.ru" border="0" '+
'height="31" width="88"><\/a>');if(11<js)d.write('<'+'!-- ');//--></script>
<noscript><a target="_top" href="http://top.mail.ru/jump?from=2058810">
<img src="http://da.c6.bf.a1.top.mail.ru/counter?js=na;id=2058810;t=56" 
height="31" width="88" border="0" alt="Рейтинг@Mail.ru"></a></noscript>
<script language="javascript" type="text/javascript"><!--
if(11<js)d.write('--'+'>');//--></script>
<!--// Rating@Mail.ru counter-->
</div>

</body>
</html>
<?php
} else
 {
 $ddate = getddate($idd, $cbissoo);
 if (($ddate == "") or ($ddate < 0) or ($ddate[1] == "")) 
  {
  error_reg_count();
  echo("<meta http-equiv='content-type' content='text/html; charset=windows-1251'>");
  echo("<BR><div align=center>Ошибка чтения профиля :( </div>");
  exit();
  }
 $cntid = reguser($idd, $ddate);
 if ($cntid < 1)
 {
  $msg = 'Регистрация счётчика не получилась :( Попробуйте еще раз.';
  error_reg_count();
 } else
 {
  $msg = '';
  $msg = $msg.'<a href="http://trefoil.org.ua/lgss/reg.php"><img src="http://trefoil.org.ua/lgss/?id='.$cntid.'"></a>';
 }
    //--------- END INSERT FORM
  ?>
  <html>
  <head>
  <title>Счетчик жизни @дневника</title>
  <meta http-equiv="content-type" content="text/html; charset=windows-1251">
  </head>
  <body bgcolor=#808090>

  <table background="bgl.jpg" width="95%" align="center" border="3" cellspacing="3" cellpadding="13">
  <tr>
   <td align="center">
    <font face="Arial" size="3"><B>Код Вашего счетчика:</B></font>
    <BR><HR><BR>
    <textarea cols=42 rows=5><?php echo($msg); ?></textarea>
   </td>
  </tr>
  </table>
  <div align="center"><font face="arial" color="#FFFFFF" size="3">Вопросы по счетчику задавать <a href="http://diary.ru/~eatssp1/">здесь</a>. <BR>Изготовлено <a href="http://diary.ru/~eatssp1">Arvenktur</a></font></div>

  </body>
  </html>

<?php

 }
?>
