<?PHP
require_once("./include/membersite_config.php");

$controller_list=array("fred yang");
if(!$fgmembersite->CheckLogin() or !(in_array( $fgmembersite->UserFullName(), $controller_list)))
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
<title>Airetalk Credit Adjust</title>
</head>
<!--<link href="default.css" rel="stylesheet" type="text/css" /> -->
</head>  

<body> 
<form method="post" action="Airetalk_adjust.php">
<br>
<h2 style="color:blue; text-decoration: underline">Update Member Credit</h2>

  <table>
   <tr> 
      <td>Enter Money</td>
      <td><input type="text" name="money" size="30" value="0.00"></td>
   </tr>

   <tr>
      <td>Enter id</td>
      <td><input type="text" name="idx" size="30" value=""></td>
   </tr>
   <tr>
      <td><input type="submit" value="Submit"></td>
   </tr>
  </table>

</form>

<?php  
$hostname="localhost";
$user="root";
$password="abc123";
$database="freeswitch";
$TableName="accounts";

//$money = $_POST['money'];
//$idx = $_POST['idx'];

if (!isset($_POST['money']))
    {
    $money = null;
    }
else
    {
    $money = $_POST['money'];
    }


if (!isset($_POST['idx'])) 
    {
    $idx = "";
    }
else
    {
    $idx = $_POST['idx'];
    }



$DBConnect=mysql_connect($hostname, $user, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());
//$phonenum1 = preg_replace("/[^0-9]/", '', $phonenum1);

$num1 = $money;

//$num1 = "+".$num1;
$success1 = false;
	
$result = mysql_query("UPDATE $TableName set cash='$num1' WHERE id ='$idx'");  
if(($result))
        {
	$success1 = true;
	echo "<br>";
        echo " Inject money =".$num1;
	echo "<br>";
	echo "<br>";
	echo " id = ".$idx;
	
	} 
  
echo '<br>';
echo '<br>';
//if ($success1)
//  {
//    $result5 = mysql_query("SELECT * FROM $TableName WHERE id='$idx'");
//    while($row=mysql_fetch_row($result5))
//	 {
//	    $cash=$row['cash'];
//	    $idx=$row['id'];
//	    echo " id=".$idx;
//	    echo "  ";
//	    echo " CASH=".$cash; 
//	 }
//  }
mysql_close($DBConnect);

?> 

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>
Logged in as: <?= $fgmembersite->UserFullName() ?>
</p>
<p>
<a href='login-home.php'>Menu Page</a>
</p>

<p>
<a href='logout.php'>Logout</a>
</p>

</div>
</body>
</html>
