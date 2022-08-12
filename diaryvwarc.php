<?php
function getddate($idd)
{
$addr = "http://pda.diary.ru/member/?".$idd;
$fiarr = file($addr);
if (!$fiarr)
 {
  sleep(1);
  $fiarr = file($addr);
 }
if (!$fiarr)
 {
  sleep(1);
  $fiarr = file($addr);
 }
if (!$fiarr)
 {
  sleep(1);
  $fiarr = file($addr);
 }

$ddate = "";
$isdiary = true;
echo("addr=".$addr.", size - ".sizeof($fiarr)."<BR>");
for ($i=0; $i<sizeof($fiarr); $i++) 
 {
 if (strpos($fiarr[$i],"ведется с:") != "")
  {
  $ddate = substr($fiarr[$i], strpos($fiarr[$i],"ведется с:")+23, 10);
  $isdiary=true;
  break;
  } 
 if (strpos($fiarr[$i],"Сообщество\n\t\t\t\t ведется с:") != "")
  {
  $ddate = substr($fiarr[$i], strpos($fiarr[$i],"Сообщество\n\t\t\t\t ведется с:")+26, 10);
  $isdiary = false;
  break;
  } 
 } 
if ($ddate == "")
  { return -1; exit();}
$nddate = explode(".", $ddate);
$retdata[0] = $isdiary;
$retdata[1] = $nddate[2]."-".$nddate[1]."-".$nddate[0];

return $retdata; 
}
?>
