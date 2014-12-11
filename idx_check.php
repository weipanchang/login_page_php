<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
      <title>AireTalk idx Check</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<h2>AireTalk idx Query Page</h2>
This page can be accessed after logging in only. To make more access controlled pages, 
copy paste the code between &lt;?php and ?&gt; to the page and name the page to be php.

</head>  
<body> 

<form method="post" action="idx_check.php">

Check Member Data


  <table> 

	<tr>
      <td>Enter Phone Number</td>
      <td><input type="text" name="phonenum" size="30" value=""></td>
    </tr>
	 <tr>

      <td>Enter Email</td>
      <td><input type="text" name="email" size="30" value=""></td>
    </tr>
	 <tr>

      <td>Enter idx</td>
      <td><input type="text" name="idx" size="30" value=""></td>
    </tr>
	 <tr>



      <td><input type="submit" value="Submit"></td>
  </table>


</form>

 
<?php  

$hostname = "localhost";
$user = "root";
$password = "abc123";
$database = "test";
        if (!isset($_POST['phonenum'])) 
          {
           $phonenum = null;
          }
        else 
          {
	   $phonenum = $_POST['phonenum']; //Primary Phone Number
          }
	
        if (!isset($_POST['email'])) 
          {
           $email = null;
          }
        else
          {
           $email = $_POST['email'];
          }
	

        if (!isset($_POST['idx'])) 
          {
           $idx = null;
          }
        else
          {
            $idx = $_POST['idx'];
          }

	$phonenum1 = str_replace("+","",$phonenum);

if ( ($_POST) && ( strlen($phonenum1) >4 ) )
{
echo "<h2> Member Check  : </h2>";  
echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
echo "<tr style='font-weight: bold;'>";  
echo "<td width='200' align='center'>id</td><td width='200' align='center'>phone number</td><td width='100' align='center'>password</td><td width='100' align='center'>email</td><td width='100' align='center'>nickname</td><td width='20' align='center'>status</td>  ";  
echo "<td width='100' align='center'>homeid</td><td width='100' align='center'>roamid</td><td width='100' align='center'>sipIP</td></tr>";  


$DBConnect=mysql_connect("localhost", "root", "abc123") or die(mysql_error());
mysql_select_db("test") or die(mysql_error());
//$phonenum1 = preg_replace("/[^0-9]/", '', $phonenum1);


$number=$phonenum1;
//$number="861082158603";
$num = rtrim($number);
$num1 = ltrim($num);

//$num1 = "+".$num1;
$success = false;
$TableName = "member";
$long =0.0001;
$lat =0.0001;

//----------------------- Please use $plan to select dialplan
//------------------------use rate for calling rate
	
		$result = mysql_query("SELECT * FROM $TableName WHERE id LIKE '%$num1%'");  
		while($row=mysql_fetch_array($result))  
		{ 
		echo "<tr style='font-weight: bold;'>"; 
		echo "<tr>";  
		echo "<td align='center' width='200'>" . $row['idx'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['id'] . "</td>";  

		echo "<td align='center' width='200'>" . $row['password'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['email'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['nickname'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['status'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['homeserid'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['roamserid'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['roamserip'] . "</td>";  
		echo "</tr>"; 
		$success = true; 
		$long = $row['latitude'];
		$lat = $row['longitude'];

        $idxxx= $row['idx'] ;
        $dbconnect=mysql_connect($hostname, $user, $password ) or die(mysql_error());
          mysql_select_db($database) or die(mysql_error());

        echo "idxx==".$idxxx;

         //$sql="SELECT cash FROM accounts where id='$idxxx'";
         $result5 = mysql_query("SELECT * FROM accounts WHERE id=".$idxxx,$dbconnect);
        $row = mysql_fetch_array( $result5 );
         if ($row)
                  {
                      $cash=$row['cash'];
                  }


              mysql_close($dbconnect);

         echo " CASH =".$cash;


		
		}  
		echo "</table>";  

		$long= $long/1000000;
		echo "   ";
		$lat= $lat/1000000;
mysql_close($DBConnect);

}


if ( ($_POST) && ( strlen($email) >=4 ) )
{
echo "<h2> Member Check  : </h2>";  
echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
echo "<tr style='font-weight: bold;'>";  
echo "<td width='200' align='center'>id</td><td width='200' align='center'>phone number</td><td width='100' align='center'>password</td><td width='100' align='center'>email</td><td width='100' align='center'>nickname</td><td width='20' align='center'>status</td>  ";  
echo "<td width='100' align='center'>homeid</td><td width='100' align='center'>roamid</td><td width='100' align='center'>sipIP</td></tr>";  

$DBConnect=mysql_connect($hostname, $user, $password) or die(mysql_error());
mysql_select_db("test") or die(mysql_error());
$phonenum1 = preg_replace("/[^0-9]/", '', $phonenum1);


$success = false;
$TableName = "member";

//----------------------- Please use $plan to select dialplan
//------------------------use rate for calling rate
	
		$result = mysql_query("SELECT * FROM $TableName WHERE email LIKE '%$email%'");  
		while($row=mysql_fetch_array($result))  
		{ 
		echo "<tr style='font-weight: bold;'>"; 
		echo "<tr>";  
		echo "<td align='center' width='200'>" . $row['idx'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['id'] . "</td>";  

		echo "<td align='center' width='200'>" . $row['password'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['email'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['nickname'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['status'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['homeserid'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['roamserid'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['roamserip'] . "</td>";  
		echo "</tr>"; 
		$success = true; 
		
		}  
		echo "</table>";  


        mysql_close($DBConnect);

}


if ( ($_POST) && ( strlen($idx) >2 ) )
{
echo "<h2> Member Check  : </h2>";  
echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
echo "<tr style='font-weight: bold;'>";  
echo "<td width='200' align='center'>id</td><td width='200' align='center'>phone number</td><td width='100' align='center'>password</td><td width='100' align='center'>email</td><td width='100' align='center'>nickname</td><td width='20' align='center'>status</td>  ";  
echo "<td width='100' align='center'>homeid</td><td width='100' align='center'>roamid</td><td width='100' align='center'>sipIP</td></tr>";  

$DBConnect=mysql_connect($hostanem, $user, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());
$phonenum1 = preg_replace("/[^0-9]/", '', $phonenum1);


$success = false;
$TableName = "member";

//----------------------- Please use $plan to select dialplan
//------------------------use rate for calling rate




		$result = mysql_query("SELECT * FROM $TableName WHERE idx = '$idx'");  
		while($row=mysql_fetch_array($result))  
		{ 
		echo "<tr style='font-weight: bold;'>"; 
		echo "<tr>";  
		echo "<td align='center' width='200'>" . $row['idx'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['id'] . "</td>";  

		echo "<td align='center' width='200'>" . $row['password'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['email'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['nickname'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['status'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['homeserid'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['roamserid'] . "</td>";  
		echo "<td align='center' width='200'>" . $row['roamserip'] . "</td>";  
		echo "</tr>"; 
        
        $idxxx= $row['idx'] ;
         $dbconnect=mysql_connect($hostname, $user, $password) or die(mysql_error());
           mysql_select_db($test) or die(mysql_error());


         echo "idxx==".$idxxx;

          //$sql="SELECT cash FROM accounts where id='$idxxx'";
          $result5 = mysql_query("SELECT * FROM accounts WHERE id=".$idxxx,$dbconnect);
         $row = mysql_fetch_array( $result5 );
          if ($row)
                   {
                       $cash=$row['cash'];
                   }


               mysql_close($dbconnect);

          echo " CASH =".$cash."\n";




		$success = true; 
		
		}  
		echo "</table>";  


//mysqli_close($DBConnect);
mysql_close($DBConnect);

}


?> 
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>
Logged in as: <?= $fgmembersite->UserFullName() ?>
</p>
<p>
<a href='login-home.php'>Home</a>
</p>
</div>
</body>
</html>
