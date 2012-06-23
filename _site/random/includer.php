<?php
	

/////////////////////////////////////////////////
////////////////////////////////////////////////

function get_param($param_name)
{
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;
  $param_value = "";
  if(isset($HTTP_POST_VARS[$param_name]))
    $param_value = $HTTP_POST_VARS[$param_name];
  else if(isset($HTTP_GET_VARS[$param_name]))
    $param_value = $HTTP_GET_VARS[$param_name];
  return $param_value;
}

function filegetcontents($fn)
{
  $ret = "";

  $fp = fopen($fn, "r");
  if($fp)
  {
    $ret = fread($fp, filesize($fn));
    fclose($fp);
  }

  return($ret);
}



function getFirstInt($str) {
  for($x = 0; $x < strlen($str)-1; $x ++) {
    $ret = substr($str,$x,1);
    if (is_numeric($ret)) {
      break;
    } else {
      $ret = false;
    }
  }
  return $ret;
}

function getLastInt($str) {
  for($x = 0; $x < strlen($str)-1; $x ++) {
    $y= (strlen($str)-1)-$x; //count backwards
    $ret = substr($str,$y,1);
    if (is_numeric($ret)) {
      break;
    } else {
      $ret = false;
    }
  }
  return $ret;
}

   function getStrBetween($wholeStr, $Str1, $Str2, $start=0) {
     //gets string from between two values
      $ret = "";
      $start = strpos($wholeStr, $Str1, $start);
      if (!$start) return $ret;
      $stop = strpos($wholeStr, $Str2, $start);
      if (!$stop) return $ret;
      
      $ret = chop(substr($wholeStr, $start, ($stop-$start))) ;
    return $ret;
  }

function arPos($ar,$value,$caseSensitive=true) {
  //position of $value inside of $ar[] (or false)
	for($x = 0; $x < count($ar); $x ++) {
		if ($value==$ar[$x]) {
			return $x; 			
		} else
		{
			if ($caseSensitive===false) {
				if (stripos($ar[$x], $value) === false) {
					continue;
				} else {
					return $x;
				}
			}
		}
	}
	return false;
}

function genRandomString($length=10) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";  
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}

function mtrand_seed() {
  //try to create a more random seed
  $n = ((double)microtime()*1000000);
  mt_srand($n);//initial seed
  $ip_address = VISITORS_IP; //get the visitors IP address
  $appended_ip = $ip_address + date("zB"); //append the numeric day of the year + 	Swatch Internet time to the ip_address
  $salt = genRandomString(); //add some salt to the appended_ip
  $salted_string = $appended_ip+$salt;
  $md5_string = md5($salted_string) ; //get the md5sum of the salted string
  $first_int = getFirstInt($md5_string); //get the first and last integer of the md5_string
  $last_int = getLastInt($md5_string);
  
  $n = ((double)microtime()*1000000);
  if($first_int>$last_int)
	{
    $n = $first_int -$last_int + $n ;
  } else {
    $n = $last_int - $first_int + $n ;
  }
  return $n;
  
  mt_srand($n);
}


function anti_bot($length=6) 
{ 
  $number = ""; 
  for ($i = 1; $i <= $length; $i++) 
  { 
       $number .= mt_rand(0,9).""; 
  } 

  $width = 11*$length; 
  $height = 30; 

  $img = ImageCreate($width, $height); 
  $background = imagecolorallocate($img,255,255,255); 
  $color_black = imagecolorallocate($img,0,0,0); 
  $color_grey = imagecolorallocate($img,169,169,169); 
  imagerectangle($img,0, 0,$width-1,$height-1,$color_grey); 
  imagestring($img, 5, $length, 7, $number, $color_black);  
  imagepng($img); 
  imagedestroy($img); 
} 


?>
