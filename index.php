<?php
Header("Content-type: image/gif;");

include "msqldate.inc";
//----------------  Procedures                        --
//----------------  Вычисление времени в днях.
function datedist($sdt)
  {
   $sd = explode("-",$sdt);
   $ddist = Round(((time()+43200)-mktime(0,0,0,$sd[1],$sd[2],$sd[0]))/86400);
   return $ddist;
  }
//----------------  Слияние двух рисунков
function imgmerge($src1, $src2, $x1, $y1, $x2, $y2, $cx, $cy)
  {
   for($yt = 0; $yt < $cy; $yt++)
   {
    for($xt = 0; $xt < $cx; $xt++)
    {
     $color = imagecolorat($src2, $x2+$xt, $y2+$yt);
     imagesetpixel($src1, $x1+$xt, $y1+$yt, $color);
    }
   }
   return $src1;
  }

//--------------------------- Run
//---------------------------------------------  Основное.
  date_default_timezone_set("Europe/Kiev");
  $id = $_GET["id"];
  $l_id = strlen($id);
  // проверка правильности вх. данных
  $v_id = "";
  for ($x=0; ($x<10) && ($x < $l_id); $x++)
  {
   $v_char = substr($id, $x, 1);
   if (($v_char <= "9") && ($v_char >= "0"))
    {$v_id = $v_id.$v_char;}
  }
 // запрос данных из базы
  $userdata = reqdate($v_id);  // плюс статистика
  if ($userdata == "-1") { exit(); } else { $dsdate = datedist($userdata['create_d_date']); }
  if ($userdata['is_diary']) 
 {
  if (file_exists("cache/d_1_".$dsdate.".gif"))
  {
   $imain = imagecreatefromgif("cache/d_1_".$dsdate.".gif");
  } else
  {
   $datelen = strlen($dsdate);
   $lastchar = substr($dsdate, $datelen-1, 1);
   $tlastchar = substr($dsdate, $datelen-2, 2);
   $imain = imagecreatefromgif("working/blank.gif");
   $isec = imagecreatefromgif("working/diantp2.gif");
   //________ Формирование рисунка
   For ($cc=0; $cc < imagecolorstotal($imain); $cc++)  {imagecolordeallocate($imain, $cc);}
   For ($cc=0; $cc < imagecolorstotal($isec); $cc++)
   {
    $col = imagecolorsforindex($isec,$cc);
    imagecolorallocate($imain, $col['red'], $col['green'], $col['blue']);
   }
    imgmerge($imain, $isec, 0, 0, 0, 0, 88, 31);
    $curx=85;
    $cury=19;
    if(($lastchar == "1") and ($tlastchar <> "11"))
   {
    imgmerge($imain, $isec, $curx - 27, $cury, 47, 40, 27, 9);
    $curx = $curx - 29;
   } else
   {
    if ((($lastchar == "2") or ($lastchar == "3") or ($lastchar == "4")) and (($tlastchar <> "12") and ($tlastchar <> "13") and ($tlastchar <> "14")))
    {
     imgmerge($imain, $isec, $curx - 20, $cury, 27, 40, 20, 9);
     $curx = $curx - 22;
    } else
    {
     imgmerge($imain, $isec, $curx - 27, $cury, 0, 40, 27, 9);
     $curx = $curx - 29;
    }
   }
   //________ Рисование чисел
   for ($t1 = 0; $t1 < $datelen; $t1++)
   {
    $tchar = substr($dsdate, $datelen-1-$t1, 1);
    switch($tchar)
    {
     case "0":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 44, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "1":
      imgmerge($imain, $isec, $curx - 3, $cury - 1, 0, 31, 3, 9);
      $curx = $curx - 4;
      break;
     case "2":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 3, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "3":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 8, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "4":
      imgmerge($imain, $isec, $curx - 6, $cury - 1, 13, 31, 6, 9);
      $curx = $curx - 7;
      break;
     case "5":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 19, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "6":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 24, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "7":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 29, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "8":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 34, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "9":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 39, 31, 5, 9);
      $curx = $curx - 6;
      break;
    }
   } //------- end writing numbers
   ImageDestroy($isec);
   ImageGif($imain, "cache/d_1_".$dsdate.".gif");
  }}
 else
 {
  if (file_exists("cache/c_1_".$dsdate.".gif"))
  {
   $imain = imagecreatefromgif("cache/c_1_".$dsdate.".gif");
  } else
  {
   $datelen = strlen($dsdate);
   $lastchar = substr($dsdate, $datelen-1, 1);
   $tlastchar = substr($dsdate, $datelen-2, 2);
   $imain = imagecreatefromgif("working/blank.gif");
   $isec = imagecreatefromgif("working/diantp3.gif");
   //________ Формирование рисунка
   For ($cc=0; $cc < imagecolorstotal($imain); $cc++)  {imagecolordeallocate($imain, $cc);}
   For ($cc=0; $cc < imagecolorstotal($isec); $cc++)
   {
    $col = imagecolorsforindex($isec,$cc);
    imagecolorallocate($imain, $col['red'], $col['green'], $col['blue']);
   }
    imgmerge($imain, $isec, 0, 0, 0, 0, 88, 31);
    $curx=85;
    $cury=19;
    if(($lastchar == "1") and ($tlastchar <> "11"))
   {
    imgmerge($imain, $isec, $curx - 27, $cury, 47, 40, 27, 9);
    $curx = $curx - 29;
   } else
   {
    if ((($lastchar == "2") or ($lastchar == "3") or ($lastchar == "4")) and (($tlastchar <> "12") and ($tlastchar <> "13") and ($tlastchar <> "14")))
    {
     imgmerge($imain, $isec, $curx - 20, $cury, 27, 40, 20, 9);
     $curx = $curx - 22;
    } else
    {
     imgmerge($imain, $isec, $curx - 27, $cury, 0, 40, 27, 9);
     $curx = $curx - 29;
    }
   }
   //________ Рисование чисел
   for ($t1 = 0; $t1 < $datelen; $t1++)
   {
    $tchar = substr($dsdate, $datelen-1-$t1, 1);
    switch($tchar)
    {
     case "0":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 44, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "1":
      imgmerge($imain, $isec, $curx - 3, $cury - 1, 0, 31, 3, 9);
      $curx = $curx - 4;
      break;
     case "2":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 3, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "3":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 8, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "4":
      imgmerge($imain, $isec, $curx - 6, $cury - 1, 13, 31, 6, 9);
      $curx = $curx - 7;
      break;
     case "5":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 19, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "6":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 24, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "7":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 29, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "8":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 34, 31, 5, 9);
      $curx = $curx - 6;
      break;
     case "9":
      imgmerge($imain, $isec, $curx - 5, $cury - 1, 39, 31, 5, 9);
      $curx = $curx - 6;
      break;
    }
   } //------- end writing numbers
   ImageDestroy($isec);
   ImageGif($imain, "cache/c_1_".$dsdate.".gif");
  }
  }

//------
  ImageGif($imain);
  ImageDestroy($imain);
?>