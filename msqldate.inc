<?php
function reqdate($id)
{
 include "baseconf.inc";

// connecting to base
 $dbds = mysql_connect($server, $user, $pass);
 if(!$dbds)
  {
  mysql_close($dbds);
  return -1;
  exit();
  }
 if(!@mysql_select_db($basename, $dbds))
  {
  mysql_close($dbds);
  return -1;
  exit();
  }
// Getting data (for diary users) from base
 $query = "SELECT * FROM ".$tablename." WHERE idt = ".$id;
 $qdata = mysql_query($query);
 $data = mysql_fetch_array($qdata);
 $dud = $data['create_d_date'];
 if (($dud == "") || ($dud == "0000-00-00"))
 {
  $dud = -1;
 }
 $retdata = $data;

// statistics. inc main counter
 $query = "SELECT * FROM ".$s_tablename." WHERE idt = 1";
 $qdata = mysql_query($query);
 $data = mysql_fetch_array($qdata);
 $dudate = $data["counter"];
 if ($dudate == "")
 {
  mysql_close($dbds);
  return -1;
  exit();
 }
 $dudate++;
 $query = "UPDATE ".$s_tablename." SET counter = ".$dudate." WHERE idt = 1 LIMIT 1";
 $qdata = mysql_query($query);

// statistics. inc day counter
 $query = "SELECT * FROM ".$s_tablename." WHERE inday = CURDATE()  LIMIT 1";
 $qdata = mysql_query($query);
 if ($qdata == FALSE)
 {
  mysql_close($dbds);
  return -1;
  exit();
 }
 $data = mysql_fetch_array($qdata);
 if ($data == FALSE)
 {
   $query ="INSERT INTO ".$s_tablename." (counter, regcounter, regdiary, regcommunity, errorregcounter, inday) VALUES (1, 0, 0, 0, 0, CURDATE())";
   $qdata = mysql_query($query);
   if($qdata == FALSE)
   {
    mysql_close($dbds);
    exit();
   }
   $dudate = 1;
 } else { $dudate = $data["counter"]; }
 if ($dudate == "")
 {
  mysql_close($dbds);
  exit();
 }
 $dudate++;
 $query = "UPDATE ".$s_tablename." SET counter = ".$dudate." WHERE inday = CURDATE()  LIMIT 1";
 $qdata = mysql_query($query);

// ending
 mysql_close($dbds);

 if ($dud == -1) { return $dud; }
  else { return $retdata; }
}




?>