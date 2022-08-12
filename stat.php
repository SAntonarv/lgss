<?php

 include "baseconf.inc";

//----------------  Подключение к базе  
 $dbds = mysql_connect($server, $user, $pass);
 if(!$dbds)
  {  die ("Не сумел подрубиться к серверу");   }
 if(!@mysql_select_db($basename, $dbds))
  {  die ("База - инвалид");   }
//----------------  Запрос общей статистики посещений
 $query = "SELECT * FROM ".$s_tablename." WHERE idt = 1";
 $qdata = mysql_query($query);
 $data = mysql_fetch_array($qdata);
 $dudate = $data["counter"];
 $regcount = $data["regcounter"];
 if($dudate == "")
  {
  mysql_close($dbds);
  die ("Нет данных под индексом 1");
  }
 echo ("Всего обращений к счетчикам: ".$dudate."<BR>");
 echo ("Всего зарегистрировано: ".$regcount."<BR>");
//----------------  Запрос и вывод статистики по дням
 $query = "SELECT * FROM ".$s_tablename." ORDER BY inday DESC LIMIT 30000";
 $qdata = mysql_query($query);
echo("<table border=1><tr><td>Дата</td><td>Обращений</td><td>Регистраций</td><td>Регистраций дневников</td><td>Регистраций сообществ</td><td>Неудачных</td></tr>");
 while ($data = mysql_fetch_array($qdata))
 {
 echo ("<tr><td> ".$data["inday"]."</td><td>".$data["counter"]."</td><td>".$data["regcounter"]."</td><td>".$data["regdiary"]."</td><td>".$data["regcommunity"]."</td><td>".$data["errorregcounter"]."</td></tr>");
 }
echo("</table>");

 mysql_close($dbds);


?>
