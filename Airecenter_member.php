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
      <title>AireTcenter Member Data Check</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<h2 style="color:blue; text-decoration: underline ">AireCenter Member Query Page</h2>
<p style="color:red">
Warning: This page is only to allow PingShow employee to access.<br>
</p>
<p style="color:blue">
Check AireCenter Member Data
</p>

<form method="post" action="Airecenter_member.php">

<table>
<?php
  $timezone = "America/Los_Angeles";
  date_default_timezone_set($timezone);
  $today = date("Y-m-d 00:00:00");
?>
<tr>
<td style="color:blue" >UUID</td>
<td><input type="text" name="uuid" size="30" value=""></td>
</tr>

<tr>
<td style="color:blue" >Enter Nickname</td>
<td><input type="text" name="nickname" size="30" value=""></td>
</tr>

<tr>
<td style="color:blue" >Enter Email</td>
<td><input type="text" name="email" size="30" value=""></td>
</tr>

<tr>
<td style="color:blue">Enter idx</td>
<td><input type="text" name="idx" size="30" value=""></td>
</tr>

<tr>
<td style="color:blue" ><span style ="font-style:italic;font-size:70%;color:black">Search with STB register date</span> Start Date YYYY-MM-DD</td>
<td><input type="text" name="created_start_time" size="10" value=""</td>
<!--<td><input type="text" name="created_start_time" size="8" value=""</td>-->
<!--</tr>

<tr>-->
<td style="color:blue" ><span style ="font-style:italic;font-size:70%;color:black">Search with STB register date</span> End Date YYYY-MM-DD</td>
<!--<td style="color:blue" ><span style ="font-style:italic;font-size:70%;color:black">Search with member crateion date</span> End Date YYYY-MM-DD</td>-->
<td><input type="text" name="created_end_time" size="10" value="<?php echo date('Y-m-d'); ?>"></td>
</tr>

<tr>
<td ><input type="submit" value="Submit" style="background-color:#0000ff; color:#fff;" ></td>
</table>

</form>

<?php

$hostname = "localhost";
$user = "root";
$password = "abc123";
$database = "acc1";
$TableName = "ac_product";

$hostname1 = "localhost";
$user1 = "root";
$password1 = "abc123";
$database1 = "freeswitch";
$TableName1 = "accounts";


if (!isset($_POST['uuid']))
    {
    $uuid = null;
    }
else
    {
    $uuid = $_POST['uuid'];
    }

if (!isset($_POST['nickname']))
    {
    $nickname = null;
    }
else
    {
    $nickname = $_POST['nickname'];
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


if (!isset($_POST['created_start_time']))
    {
    $created_start_time = null;
    }
else
    {
    $created_start_time = $_POST['created_start_time'];
    }


if (!isset($_POST['created_end_time']))
    {
    $created_end_time = null;
    }
else
    {
    $created_end_time = $_POST['created_end_time'];
    }


if ( ($_POST) && ( strlen($uuid) >= 6 ) )
{
    echo "<h2> AireCenter Member Check  : </h2>";
    echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
    echo "<tr style='font-weight: bold;'>";
    echo "<td width='120' align='center'>UUID</td><td width='100' align='center'>Password</td><td width='120' align='center'>EMAIL</td><td width='200' align='center'>Nickname</td><td width='100' align='center'>id</td><td width='100' align='center'>Crate Date</td>";
    echo "<td width='100' align='center'>Account Type</td><td width='50' align='center'>Active</td><td width='100' align='center'>Product</td><td width='100' align='center'>Date Last Paid</td><td width='100' align='center'>Date Expired</td><td width='100' align='center'>ip ddress</td></tr>";

    $DBConnect=mysql_connect("$hostname", "$user", "$password") or die(mysql_error());
    mysql_select_db("$database") or die(mysql_error());

    //$number=$uuid;
    //$num = rtrim($number);
    //$num1 = ltrim($num);

    //$num1 = "+".$num1;
    $success = false;

    $result = mysql_query("SELECT * FROM $TableName WHERE id LIKE '%$uuid%'");
    while($row=mysql_fetch_array($result))
    {
        echo "<tr style='font-weight: bold;'>";
        echo "<tr>";
        echo "<td align='center' width='120'>" . $row['id'] . "</td>";
        echo "<td align='center' width='100'>" . $row['password'] . "</td>";
        echo "<td align='center' width='120'>" . $row['email'] . "</td>";
        echo "<td align='center' width='200'>" . $row['nickname'] . "</td>";
        echo "<td align='center' width='100'>" . $row['idx'] . "</td>";
        echo "<td align='center' width='100'>" . $row['created'] . "</td>";
        echo "<td align='center' width='100'>" . $row['accounttype'] . "</td>";
        echo "<td align='center' width='50'>" . $row['active'] . "</td>";
        echo "<td align='center' width='100'>" . $row['product'] . "</td>";
        echo "<td align='center' width='100'>" . $row['last_purchase'] . "</td>";
        echo "<td align='center' width='100'>" . $row['expire'] . "</td>";
        echo "<td align='center' width='100'>" . $row['ip_addr'] . "</td>";
        echo "</tr>";
        $success = true;
//        $idxxx= $row['idx'] ;
    }
    echo "</table>";
//    echo "   ";
}


if (($_POST) && ( strlen($nickname) >=2 ) )
    {
    echo "<h2> AireCenter Member Check  : </h2>";
    echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
    echo "<tr style='font-weight: bold;'>";
    echo "<td width='120' align='center'>UUID</td><td width='100' align='center'>Password</td><td width='120' align='center'>EMAIL</td><td width='200' align='center'>Nickname</td><td width='100' align='center'>id</td><td width='100' align='center'>Crate Date</td>";
    echo "<td width='100' align='center'>Account Type</td><td width='50' align='center'>Active</td><td width='100' align='center'>Product</td><td width='100' align='center'>Date Last Paid</td><td width='100' align='center'>Date Expired</td><td width='100' align='center'>ip ddress</td></tr>";

    $DBConnect=mysql_connect($hostname, $user, $password) or die(mysql_error());
    mysql_select_db("$database") or die(mysql_error());
    $success = false;

    $result = mysql_query("SELECT * FROM $TableName WHERE nickname LIKE '%$nickname%'");
    while($row=mysql_fetch_array($result))
	{
            echo "<tr style='font-weight: bold;'>";
            echo "<tr>";
            echo "<td align='center' width='120'>" . $row['id'] . "</td>";
            echo "<td align='center' width='100'>" . $row['password'] . "</td>";
            echo "<td align='center' width='120'>" . $row['email'] . "</td>";
            echo "<td align='center' width='200'>" . $row['nickname'] . "</td>";
            echo "<td align='center' width='100'>" . $row['idx'] . "</td>";
            echo "<td align='center' width='100'>" . $row['created'] . "</td>";
            echo "<td align='center' width='100'>" . $row['accounttype'] . "</td>";
            echo "<td align='center' width='50'>" . $row['active'] . "</td>";
            echo "<td align='center' width='100'>" . $row['product'] . "</td>";
            echo "<td align='center' width='100'>" . $row['last_purchase'] . "</td>";
            echo "<td align='center' width='100'>" . $row['expire'] . "</td>";
            echo "<td align='center' width='100'>" . $row['ip_addr'] . "</td>";
            echo "</tr>";
            $success = true;
//		}
//            $success = true;
	}
	echo "</table>";
//      mysql_close($DBConnect);
    }

if ( ($_POST) && ( strlen($email) >=4 ) )
    {
    echo "<h2> AireCenter Member Check  : </h2>";
    echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
    echo "<tr style='font-weight: bold;'>";
    echo "<td width='120' align='center'>UUID</td><td width='100' align='center'>Password</td><td width='120' align='center'>EMAIL</td><td width='200' align='center'>Nickname</td><td width='100' align='center'>id</td><td width='100' align='center'>Crate Date</td>";
    echo "<td width='100' align='center'>Account Type</td><td width='50' align='center'>Active</td><td width='100' align='center'>Product</td><td width='100' align='center'>Date Last Paid</td><td width='100' align='center'>Date Expired</td><td width='100' align='center'>ip ddress</td></tr>";

    $DBConnect=mysql_connect($hostname, $user, $password) or die(mysql_error());
    mysql_select_db("$database") or die(mysql_error());
    //$phonenum1 = preg_replace("/[^0-9]/", '', $phonenum1);

    $success = false;

    $result = mysql_query("SELECT * FROM $TableName WHERE email LIKE '%$email%'");
    while($row=mysql_fetch_array($result))
	{
            echo "<tr style='font-weight: bold;'>";
            echo "<tr>";
            echo "<td align='center' width='120'>" . $row['id'] . "</td>";
            echo "<td align='center' width='100'>" . $row['password'] . "</td>";
            echo "<td align='center' width='120'>" . $row['email'] . "</td>";
            echo "<td align='center' width='200'>" . $row['nickname'] . "</td>";
            echo "<td align='center' width='100'>" . $row['idx'] . "</td>";
            echo "<td align='center' width='100'>" . $row['created'] . "</td>";
            echo "<td align='center' width='100'>" . $row['accounttype'] . "</td>";
            echo "<td align='center' width='50'>" . $row['active'] . "</td>";
            echo "<td align='center' width='100'>" . $row['product'] . "</td>";
            echo "<td align='center' width='100'>" . $row['last_purchase'] . "</td>";
            echo "<td align='center' width='100'>" . $row['expire'] . "</td>";
            echo "<td align='center' width='100'>" . $row['ip_addr'] . "</td>";
            echo "</tr>";
            $success = true;

	}
	echo "</table>";
//      mysql_close($DBConnect);
    }

if ( ($_POST) && ( strlen($idx) > 2 ) )
    {
    echo "<h2> AireCenter Member Check  : </h2>";
    echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
    echo "<tr style='font-weight: bold;'>";
    echo "<td width='120' align='center'>UUID</td><td width='100' align='center'>Password</td><td width='120' align='center'>EMAIL</td><td width='200' align='center'>Nickname</td><td width='100' align='center'>id</td><td width='100' align='center'>Crate Date</td>";
    echo "<td width='100' align='center'>Account Type</td><td width='50' align='center'>Active</td><td width='100' align='center'>Product</td><td width='100' align='center'>Date Last Paid</td><td width='100' align='center'>Date Expired</td><td width='100' align='center'>ip ddress</td></tr>";

    $DBConnect=mysql_connect($hostname, $user, $password) or die(mysql_error());
    mysql_select_db($database) or die(mysql_error());

    $success = false;

    $result = mysql_query("SELECT * FROM $TableName WHERE idx = '$idx'");
    while($row=mysql_fetch_array($result))
        {
            echo "<tr style='font-weight: bold;'>";
            echo "<tr>";
            echo "<td align='center' width='120'>" . $row['id'] . "</td>";
            echo "<td align='center' width='100'>" . $row['password'] . "</td>";
            echo "<td align='center' width='120'>" . $row['email'] . "</td>";
            echo "<td align='center' width='200'>" . $row['nickname'] . "</td>";
            echo "<td align='center' width='100'>" . $row['idx'] . "</td>";
            echo "<td align='center' width='100'>" . $row['created'] . "</td>";
            echo "<td align='center' width='100'>" . $row['accounttype'] . "</td>";
            echo "<td align='center' width='50'>" . $row['active'] . "</td>";
            echo "<td align='center' width='100'>" . $row['product'] . "</td>";
            echo "<td align='center' width='100'>" . $row['last_purchase'] . "</td>";
            echo "<td align='center' width='100'>" . $row['expire'] . "</td>";
            echo "<td align='center' width='100'>" . $row['ip_addr'] . "</td>";
            echo "</tr>";
            $success = true;
        }
    echo "</table>";
    mysql_close($DBConnect);
    }

if ( (($_POST) and ( strlen($created_start_time) >= 8 ) and strlen($created_end_time) >= 8 ))
{
    echo "<h2> AireCenter Member Check  : </h2>";
    echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";
    echo "<tr style='font-weight: bold;'>";
    echo "<td width='120' align='center'>UUID</td><td width='100' align='center'>Password</td><td width='120' align='center'>EMAIL</td><td width='200' align='center'>Nickname</td><td width='100' align='center'>id</td><td width='100' align='center'>Crate Date</td>";
    echo "<td width='100' align='center'>Account Type</td><td width='50' align='center'>Active</td><td width='100' align='center'>Product</td><td width='100' align='center'>Date Last Paid</td><td width='100' align='center'>Date Expired</td><td width='100' align='center'>ip ddress</td></tr>";

    $DBConnect=mysql_connect($hostname, $user, $password) or die(mysql_error());
    mysql_select_db($database) or die(mysql_error());

    $start2=$created_start_time;
    $end2=$created_end_time;

    $success = false;

    $result = mysql_query("SELECT * FROM $TableName WHERE CAST(created as DATE) >= CAST('$start2' as DATE) and CAST(created as DATE) <= CAST('$end2' as DATE) order by created DESC LIMIT 1000");
    while($row=mysql_fetch_array($result))
    {
        echo "<tr style='font-weight: bold;'>";
        echo "<tr>";
            echo "<td align='center' width='120'>" . $row['id'] . "</td>";
            echo "<td align='center' width='100'>" . $row['password'] . "</td>";
            echo "<td align='center' width='120'>" . $row['email'] . "</td>";
            echo "<td align='center' width='200'>" . $row['nickname'] . "</td>";
            echo "<td align='center' width='100'>" . $row['idx'] . "</td>";
            echo "<td align='center' width='100'>" . $row['created'] . "</td>";
            echo "<td align='center' width='100'>" . $row['accounttype'] . "</td>";
            echo "<td align='center' width='50'>" . $row['active'] . "</td>";
            echo "<td align='center' width='100'>" . $row['product'] . "</td>";
            echo "<td align='center' width='100'>" . $row['last_purchase'] . "</td>";
            echo "<td align='center' width='100'>" . $row['expire'] . "</td>";
            echo "<td align='center' width='100'>" . $row['ip_addr'] . "</td>";
        echo "</tr>";

    }
    $result = mysql_query("SELECT count(*) FROM $TableName WHERE CAST(created as DATE) >= CAST('$start2' as DATE) and CAST(created as DATE) <= CAST('$end2' as DATE) LIMIT 1000");

    if ($row=mysql_fetch_array($result))
      {
          $total=$row['count(*)'];
      }
    echo " TOTAL Members Created in the Period = ".$total;
}
?>

<p>&nbsp;</p>
<!--<p>&nbsp;</p>
<p>&nbsp;</p>-->

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
