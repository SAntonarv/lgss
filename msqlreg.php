<?php
function error_reg_count()
{
 include "baseconf.inc";
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
  $query = "SELECT * FROM ".$s_tablename." WHERE inday = CURDATE()  LIMIT 1";
 $qdata = mysql_query($query);
 if($qdata == FALSE)
 {
  mysql_close($dbds);
  return -1;
  exit();
 }
 $data = mysql_fetch_array($qdata);
 if ($data == FALSE)
 {
   $query ="INSERT INTO ".$s_tablename." (errorregcounter) VALUES (1)";
   $qdata = mysql_query($query);
   if($qdata == FALSE)
   {
    mysql_close($dbds);
    exit();
   }
   $dudate = 1;
 } else  $dudate = $data["errorregcounter"];
 if($dudate == "")
 {
  mysql_close($dbds);
  exit();
 }
 $dudate++;
 $query = "UPDATE ".$s_tablename." SET errorregcounter = ".$dudate." WHERE inday = CURDATE()  LIMIT 1";
 $qdata = mysql_query($query);
 mysql_close($dbds);
 return 1;

}



function reguser($id, $userregdate)
{
 include "baseconf.inc";
//connect to base
 $dbds = mysql_connect($server, $user, $pass);
 if(!$dbds)// get user's idt
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
// insert new user
if ($userregdate[0]) { $query = "INSERT INTO ".$tablename." VALUES (0, '".$id."', 1, '".$userregdate[1]."', CURDATE())"; }
 else { $query = "INSERT INTO ".$tablename." VALUES (0, '".$id."', 0, '".$userregdate[1]."', CURDATE())"; }
$iduser = mysql_query($query);
// get user's idt
$query = "SELECT MAX(idt) FROM ".$tablename;
$iduser = mysql_query($query);
$iduser = mysql_fetch_array($iduser);
$iduser = $iduser[0];

// statistics. inc main counter
 $query = "SELECT * FROM ".$s_tablename." WHERE idt = 1";
 $qdata = mysql_query($query);
 $data = mysql_fetch_array($qdata);
 $dudate = $data["regcounter"];
 if($dudate == "")
 {
  mysql_close($dbds);
  return -1;
  exit();
 }
 $dudate++;
 $query = "UPDATE ".$s_tablename." SET regcounter = ".$dudate." WHERE idt =1 LIMIT 1";
 $qdata = mysql_query($query);

// statistics. inc day counter
 $query = "SELECT * FROM ".$s_tablename." WHERE inday = CURDATE()  LIMIT 1";
 $qdata = mysql_query($query);
 if($qdata == FALSE)
 {
  mysql_close($dbds);
  return -1;
  exit();
 }
 $data = mysql_fetch_array($qdata);
 if ($data == FALSE)
 {
   if ($userregdate[0]) { $query = "INSERT INTO ".$s_tablename." (counter, regcounter, regdiary, regcommunity, inday) VALUES (0, 1, 1, 0, CURDATE())"; }
    else  { $query = "INSERT INTO ".$s_tablename." (counter, regcounter, regdiary, regcommunity, inday) VALUES (0, 1, 0, 1, CURDATE())"; }
   $qdata = mysql_query($query);
   if($qdata == FALSE)
   {
    mysql_close($dbds);
    exit();
   }
   $dudate = 1;
 } else $dudate = $data["regcounter"];
 if($dudate == "") {  mysql_close($dbds);  exit(); }
 $dudate++;
 $query = "UPDATE ".$s_tablename." SET regcounter = ".$dudate." WHERE inday = CURDATE()  LIMIT 1";
 $qdata = mysql_query($query);
 if ($userregdate[0])
 {
  $dudate = $data["regdiary"];
  $dudate++;
  $query = "UPDATE ".$s_tablename." SET regdiary = ".$dudate." WHERE inday = CURDATE()  LIMIT 1";
  $qdata = mysql_query($query);
 } else
 {
  $dudate = $data["regcommunity"];
  $dudate++;
  $query = "UPDATE ".$s_tablename." SET regcommunity = ".$dudate." WHERE inday = CURDATE()  LIMIT 1";
  $qdata = mysql_query($query);
 }

 mysql_close($dbds);
 return $iduser;
}

//echo(reguser(12345,"2003-01-02"));

?>