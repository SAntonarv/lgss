<?php

 include "baseconf.inc";

//----------------  ����������� � ����  
 $dbds = mysql_connect($server, $user, $pass);
 if(!$dbds)
  {  die ("�� ����� ����������� � �������");   }
 if(!@mysql_select_db($basename, $dbds))
  {  die ("���� - �������");   }
//----------------  ������ ����� ���������� ���������
 $query = "SELECT * FROM ".$s_tablename." WHERE idt = 1";
 $qdata = mysql_query($query);
 $data = mysql_fetch_array($qdata);
 $dudate = $data["counter"];
 $regcount = $data["regcounter"];
 if($dudate == "")
  {
  mysql_close($dbds);
  die ("��� ������ ��� �������� 1");
  }
 echo ("����� ��������� � ���������: ".$dudate."<BR>");
 echo ("����� ����������������: ".$regcount."<BR>");
//----------------  ������ � ����� ���������� �� ����
 $query = "SELECT * FROM ".$s_tablename." ORDER BY inday DESC LIMIT 30000";
 $qdata = mysql_query($query);
echo("<table border=1><tr><td>����</td><td>���������</td><td>�����������</td><td>����������� ���������</td><td>����������� ���������</td><td>���������</td></tr>");
 while ($data = mysql_fetch_array($qdata))
 {
 echo ("<tr><td> ".$data["inday"]."</td><td>".$data["counter"]."</td><td>".$data["regcounter"]."</td><td>".$data["regdiary"]."</td><td>".$data["regcommunity"]."</td><td>".$data["errorregcounter"]."</td></tr>");
 }
echo("</table>");

 mysql_close($dbds);


?>
