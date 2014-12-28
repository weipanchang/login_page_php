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
<title>Airecenter Activation Adjust Page</title>
</head>
<!--<link href="default.css" rel="stylesheet" type="text/css" /> -->
</head>  

<body> 
<form method="post" action="Airecenter_adjust.php">
<br>
<h2 style="color:blue; text-decoration: underline">Update Airecenter STB Activation Status</h2>
<tr>
   <td>Enter id</td>
   <td><input type="text" name="idx" size=12" value=""></td>
</tr>

<table>

<br>
<br>
<label style="color: green;">Activate</label>
<input type='radio' name='activate' value=1 />

<label style="color: red;">De-Activate</label>
<input type='radio' name='activate' value=0 />
<br>

<br>
<input type='submit' name='submit' value='Submit' /> 
</table>
</form>

<?php  
$hostname="localhost";
$user="root";
$password="abc123";
$database="acc1";
$TableName="ac_product";

if (!isset($_POST['idx'])) 
    {
    $idx = "";
    }
else
    {
    $idx = $_POST['idx'];
    }

if(isset($_POST['activate']))
    {
	if($_POST['activate'] == 1)
	{
	    $activate = 1;
	}
	elseif($_POST['activate'] == 0)
	{
	    $activate = 0;
	}
    }
else
    {
        $activate = null;
    }




$DBConnect=mysql_connect($hostname, $user, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());

$success1 = false;
	
$result = mysql_query("UPDATE $TableName set active='$activate' WHERE idx ='$idx'");  
if(($result))
        {
	$success1 = true;
	echo "<br>";
	echo " id = ".$idx;
	//echo "<br>";
	//echo "<br>";
	if ($activate == 1)
	   {
		echo "<p style='color:green; text-decoration: underline'> is set to Active </p>";    
	   }
	else
	    {
	        echo "<p style='color:red; text-decoration: underline'> is set to In-Active </p>";
	    }
	} 
  
echo '<br>';
echo '<br>';


echo '<hr>';
echo '<hr>';
echo '<br>';
echo 'The following result is to confirm the activation setting from database, and should be the same as above';

echo '<br>';
echo '<br>';

$result = mysql_query("select idx, active from $TableName WHERE idx ='$idx'");  
while($row=mysql_fetch_array($result))
    {
    $activate=$row['active'];
    $idx=$row['idx'];    
    echo " id = ".$idx;
    echo "  ";
    if ($activate == 1)
	{
	    echo "<p style='color:green; text-decoration: underline'> is set to Active </p>";
	}
    else
	{
	    echo "<p style='color:red; text-decoration: underline'> is set to In-Active </p>";
	}
    }

mysql_close($DBConnect);

?> 

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
