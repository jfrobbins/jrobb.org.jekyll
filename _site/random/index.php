<?php 
$starttime = microtime();
$startarray = explode(" ", $starttime);
$starttime = $startarray[1] + $startarray[0];
require_once("includer.php");

mtrand_seed();

global $homedir;
global $version;

$siteTitle = "the jrobb Hubb";
$homedir = "jrobb.org";
$siteAlias ="factorQ.net";
$version = "2011.02.05";

require "../templates/header.php";
?>

<table align="center" border=0 CELLPADDING=4 CELLSPACING=0 HEIGHT=90% WIDTH=90% bgcolor="#A8A8A8" bordercolor="#000000" link="#0C0071" alink="#0C36FC" vlink="#0F0095">
<tr align="center">
<td align="left" valign="top" width=15% bgcolor=#CCCCCC>
<h2>Menu:</h2>
<?php
require "../content/menu.htm";
echo "<br>";
?>
</td>
<td align="left" valign="top"><font size=3>
<br>
This simple (<a href="http://en.wikipedia.org/wiki/Random_number_generator#.22True.22_random_numbers_vs._pseudo-random_numbers\">pseudo</a>) random number generator is free to use for any purpose. 
<br>I wrote this <a href="http://jrobb.org/blog/?article=163">for my wife</a> to use, but of course anyone else can use it. :-)
<br>
This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/us/">Creative Commons Attribution-ShareAlike 3.0 United States License</a>.  
<br>If you would like the source code, it is available <a href="/xfer/code/jrobborg-random.src.tar.gz">here</a>.
<P>These calculations make use of the <a href="http://en.wikipedia.org/wiki/Mersenne_twister">Mersenne Twister</a> to generate better random numbers.
<br>
<br>
No information that you enter is stored...trust me, I don't want it!  
<br>(however, take note that this site is not secure, I am not liable for lost data or anything else blah blah)

<P>and now...</P>
<h2>The Randomness</h2>
<P><hr></P>
<?php
///////////////////////////////////////////////////////////////////////////////////////
//Random stuff starts here
///////////////////////////////////////////////////////////////////////////////////////


$type = get_param("type");
$result = "<center><font size=5 color=\"#097E00\">";
switch ($type) {
  case 0:
    $result=false;
    break;
    
  case 1:  //random value
    $minVal = get_param("min");
    $maxVal = get_param("max");
    //echo "true random: " . get_true_random_number($minVal,$maxVal);
    if ( $minVal == "" ) $minVal = 0;
    if ( $maxVal == "" ) {
      $maxVal = 0; 
    }
    
    if (!( $minVal == 0 ) and ( $maxVal > 0 )) {        
      $random = ((mt_rand()%$maxVal)+$minVal);
      $result .= "your random number is: <B>" . $random . "</B>";
    }  else $result=false;
    break;
    
  case 2:  //random list value
    if (get_param("randomlist")) {
      $rlist = explode(",",get_param("randomlist"));
      if (count($rlist)==1) $rlist = explode("\n",get_param("randomlist"));
    } else {
      $rlist = false;
      $result=false;
    }
    
    if (!( $rlist == false ) and (is_array($rlist))) {
      $minVal=0;
      $maxVal = count($rlist)-1;
      if ($maxVal<0) break;
      $random = ((mt_rand()%$maxVal)+$minVal);

      $result .=  "your random entry is: <B>" . $rlist[$random] . "</B>";
    }  else $result=false;
    break;
    
  case 3: //random string
    $rlength = get_param("length");
    if ($rlength <= 0) $rlength = 10;
    $result .= "your random string is: <b>" . genRandomString($rlength) . "</b>";
    break;
    
  case 4: //image w/numbers
    $result=false;
    $type=0;
    break;
    
  case 5:
    $useColor = get_param("color");
    $result = "Random PNG image:";
    $result .= "<br><center><img src='randompng.php?xlen=256&ylen=256&color=$useColor'></center>";  
    break;
    
  default:
    $result=false;
    $type=0;
    break;
}

if ($result) {
  $result .= "</font></center>";
  echo $result;
  echo "<P><hr></P>";
}

echo '<table width=95%>
      <tr>
      <td width=70% valign=top>';

//type 1 just is a random number
echo "<h3>number randomizer:</h3>";
echo "<P></P><form action=\"index.php?\" method=\"POST\" style=\"display: inline;\">   
      <input type=\"hidden\" name=\"type\" value=\"1\">   
  <table width=\"50%\" cellpadding=0 cellspacing=0 border=0>
    <tr>
    <td><b>Min Value:</b></td>
    <td align=\"left\"><input type=\"text\" size=\"25\" maxlength=\"25\" name=\"min\" value=\"1\"></td>
    </tr>
    <tr>
    <td><b>Max Value:</b></td>
    <td align=\"left\"><input type=\"text\" size=\"25\" maxlength=\"50\" name=\"max\" value=\"200\"></td>
    </tr>    
    <tr><td></td>
    <td colspan=><input type=\"submit\" value=\"Get Random Number\" style=\"display: inline;\"></td>
    </tr>
    </table>
    </form><P></P>";   
    
    ////////////////////////////
echo "<P><hr></P>";
    
//type 2 = list    
if (($type==2) and !( $rlist == false ) and (is_array($rlist))) {
  echo "<br>you previously entered: " . implode(",",$rlist);
}
echo "<h3>Comma or Line delimited list randomizer:</h3>";
print "ie. test1,test2,test3<br>";
echo "<P></P><form action=\"index.php?\" method=\"GET\" style=\"display: inline;\">   
      <input type=\"hidden\" name=\"type\" value=\"2\">   
  <table width=\"50%\" cellpadding=0 cellspacing=0 border=0>
    <tr>
    <td><b>List:</b></td>
    <td align=\"left\"><textarea cols=40 rows=10 name=\"randomlist\"></textarea></td>
    </tr>
    <tr><td></td>
    <td colspan=><input type=\"submit\" value=\"Get Random Entry\" style=\"display: inline;\"></td>
    </tr>
    </table>
    </form><P></P>";    
    
////////////////////////////
echo "<P><hr></P>";
    
//type 3 = random string   
echo "<h3>string randomizer:</h3>";
echo "<P></P><form action=\"index.php?\" method=\"GET\" style=\"display: inline;\">   
      <input type=\"hidden\" name=\"type\" value=\"3\">   
  <table width=\"50%\" cellpadding=0 cellspacing=0 border=0>
    <tr>
    <td><b>Length:</b></td>
    <td align=\"left\"><input type=\"text\" size=\"25\" maxlength=\"100\" name=\"length\" value=\"10\"></td>
    </tr>
    <tr><td></td>
    <td colspan=><input type=\"submit\" value=\"Create Random String\" style=\"display: inline;\"></td>
    </tr>
    </table>
    </form><P></P>";      
      
      
////////////////////////////
echo "<P><hr></P>";  
//type 4
echo "<h3>An image of randomized numbers:</h3>";   
echo "<br><center><img src='antibot.php'></center>";     

////////////////////////////
echo "<P><hr></P>";  
//type 5
echo "<h3>A randomized PNG image:</h3>";   
//echo "this code to generate this img is from <a href='http://www.boallen.com/random-numbers.html'>here</a>";
// followup http://cod.ifies.com/2008/05/php-rand01-on-windows-openssl-rand-on.html
echo "<P></P><form action=\"index.php?\" method=\"GET\" style=\"display: inline;\">   
      <input type=\"hidden\" name=\"type\" value=\"5\">   
  <table width=\"50%\" cellpadding=0 cellspacing=0 border=0>
    <tr>
    <td><b>Color:</b></td>
    <td align=\"left\"><input type=\"checkbox\" name=\"color\" value=\"1\" /> Color<br /></td>
    </tr>
    <tr><td></td>
    <td colspan=><input type=\"submit\" value=\"Create Random PNG\" style=\"display: inline;\"></td>
    </tr>
    </table>
    </form><P></P>";   

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////  
?>       
</td>
<td align="right" valign="top">
  <!-- adstuff -->
  
    <script type="text/javascript"><!--
    google_ad_client = "ca-pub-2775682770358114";
    /* sm_square_img_gray */
    google_ad_slot = "8587372772";
    google_ad_width = 200;
    google_ad_height = 200;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
<br>  
    <script type="text/javascript"><!--
    google_ad_client = "ca-pub-2775682770358114";
    /* w-skyscraper-txt-gray */
    google_ad_slot = "6857918376";
    google_ad_width = 180;
    google_ad_height = 600;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>    
    
  <!-- /adstuff -->
</td>
</tr>
</table>


</font>

</td>
</tr>
</table>

<?php 
include("../templates/footer.php"); 
?>
