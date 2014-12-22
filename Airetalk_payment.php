<?PHP
require_once("./include/membersite_config.php");

$controller_list=array("maria pei", "william chang");
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
      <title>AireTalk Payment Search Page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<p>
<a href='login-home.php'>Back to Menu Page</a>
</p>
<h2 style="color:blue; text-decoration: underline ">Search AireTalk Payment Page</h2>
<p style="color:red">
Warning: This page is only to allow PingShow Controller to access.<br> 
</p>
<p style="color:blue">
Search Airetalk Payment
</p>

<form method="post" action="Airetalk_payment.php">

<table> 
<?php
  $timezone = "America/Los_Angeles";
  date_default_timezone_set($timezone);
  $today = date("Y-m-d 00:00:00");
?>
<!--<html>
  <body>
    <input type="date" value="<?php echo $today; ?>">
  </body>
</html>-->
<tr>
<td style="color:blue" >Start Date YYYY-MM-DD</td>
<td><input type="text" name="start_time" size="8" value=""</td>
</tr>

<tr>
<td style="color:blue" >End Date YYYY-MM-DD</td>
<td><input type="text" name="end_time" size="8" value="<?php echo date('Y-m-d'); ?>"></td>
</tr>
 
<tr>
<td style="color:blue" >Enter Amount</td>
<td><input type="text" name="amount" size="8" value=""></td>
</tr>

<!--<tr>
<td style="color:blue">Enter idx</td>
<td><input type="text" name="idx" size="30" value=""></td>
</tr>-->

<tr>
<td ><input type="submit" value="Submit" style="background-color:#0000ff; color:#fff;" ></td>
</table>

</form>

<?php  

$hostname = "localhost";
$user = "root";
$password = "abc123";
$database = "freeswitch";
$TableName = "payments";

//$hostname1 = "localhost";
//$user1 = "root";
//$password1 = "abc123";
//$database1 = "freeswitch";
//$TableName1 = "accounts";

if (!isset($_POST['start_time'])) 
    {
    $start_time = null;
    }
else 
    {
    $start_time = $_POST['start_time']; //Primary Phone Number
    }

if (!isset($_POST['end_time'])) 
    {
    $end_time = null;
    }
else
    {
    $end_time = $_POST['end_time'];
    }
    
if (!isset($_POST['amount'])) 
    {
    $amount = null;
    }
else
    {
    $amount = $_POST['amount'];
    }

if ( (($_POST) and ( strlen($start_time) >= 8 ) and strlen($end_time) >= 8 ))
{
    echo "<h2> Payment Check  : </h2>";  
    echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
    echo "<tr style='font-weight: bold;'>";  
    echo "<td width='100' align='center'>id</td><td width='300' align='center'>time</td><td width='100' align='center'>amount</td><td width='150' align='center'>status</td><td width='400' align='center'>payment id</td><td width='400' align='center'>card info</td>";
    //echo "<td width='100' align='center'>homeid</td><td width='100' align='center'>roamid</td><td width='100' align='center'>sipIP</td></tr>";  
    
    $DBConnect=mysql_connect("$hostname", "$user", "$password") or die(mysql_error());
    mysql_select_db("$database") or die(mysql_error());
    //$phonenum1 = preg_replace("/[^0-9]/", '', $phonenum1);
    
    $start2=$start_time;
    //$start1 = rtrim($start);
    //$start2 = ltrim($start1);
    $end2=$end_time;
    //$end1 = rtrim($end);
    //$end2 = ltrim($end1);
    
    $success = false;

    $result = mysql_query("SELECT * FROM $TableName WHERE CAST(time as DATE) >= CAST('$start2' as DATE) and CAST(time as DATE) <= CAST('$end2' as DATE) order by time DESC LIMIT 120");
      while($row=mysql_fetch_array($result))  
    { 
        echo "<tr style='font-weight: bold;'>"; 
        echo "<tr>";  
        echo "<td align='center' width='100'>" . $row['id'] . "</td>";  
        echo "<td align='center' width='300'>" . $row['time'] . "</td>";  
        echo "<td align='center' width='100'>" . $row['amount'] . "</td>";  
        echo "<td align='center' width='150'>" . $row['status'] . "</td>";  
        echo "<td align='center' width='400'>" . $row['payment_id'] . "</td>";
        echo "<td align='center' width='400'>" . $row['card_info'] . "</td>"; 
        echo "</tr>"; 
    $success = true; 
    }	
	echo "</table>";  
//        mysq_close($DBConnect);
    }


if ( ($_POST) && ( strlen($amount) > 0 ) )
    {
echo "<h2> Payment Check  : </h2>";  
    echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
    echo "<tr style='font-weight: bold;'>";  
    echo "<td width='100' align='center'>id</td><td width='300' align='center'>time</td><td width='100' align='center'>amount</td><td width='150' align='center'>status</td><td width='400' align='center'>payment id</td><td width='400' align='center'>card info</td>";
    //echo "<td width='100' align='center'>homeid</td><td width='100' align='center'>roamid</td><td width='100' align='center'>sipIP</td></tr>";  
    
    $DBConnect=mysql_connect("$hostname", "$user", "$password") or die(mysql_error());
    mysql_select_db("$database") or die(mysql_error());
    $amt=$amount;
    $amt1 = rtrim($amt);
    $amount = ltrim($amt1);
    $success = false;
    $result = mysql_query("SELECT * FROM $TableName WHERE CONCAT(amount) = '$amount' order by id DESC LIMIT 90");  
    while($row=mysql_fetch_array($result))  
        { 
            echo "<tr style='font-weight: bold;'>"; 
            echo "<tr>";  
            echo "<td align='center' width='100'>" . $row['id'] . "</td>";  
            echo "<td align='center' width='300'>" . $row['time'] . "</td>";  
            echo "<td align='center' width='100'>" . $row['amount'] . "</td>";  
            echo "<td align='center' width='150'>" . $row['status'] . "</td>";  
            echo "<td align='center' width='400'>" . $row['payment_id'] . "</td>";
            echo "<td align='center' width='400'>" . $row['card_info'] . "</td>"; 
            echo "</tr>"; 
            $success = true; 
        }  
    echo "</table>";  
//  mysqli_close($DBConnect);
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
<a href='login-home.php'>Back to Menu Page</a>
</p>
</div>
</body>
</html>
