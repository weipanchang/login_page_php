//<?PHP
//require_once("./include/membersite_config.php");
//
//$controller_list=array("fred yang");
//if(!$fgmembersite->CheckLogin() or !(in_array( $fgmembersite->UserFullName(), $controller_list)))
//    {
//        $fgmembersite->RedirectToURL("login.php");
//        exit;
//    }
//?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
    <title>Audit: Cash update</title>
</head>  

<body>
    
<p>
<a href='login-home.php'>Menu Page</a>
</p>

<p>
<a href='logout.php'>Logout</a>
</p>

<?php
    function prTblHeadings() {
        $a=func_get_args();
        foreach ($a as &$e)
        {
            echo "<th>$e</td>\n";         
        }
    }
    
    $hostname = "localhost";
    $user = "root";
    $password = "abc123";
    $database = "fafa";
    $TableName = "member";
    
    $hostname1 = "localhost";
    $user1 = "root";
    $password1 = "abc123";
    $database1 = "freeswitch";
    $TableName1 = "auditAcctCash";
    $TableName2 = "accounts";
    
    $n = (isset($_REQUEST['n'])) ?$_REQUEST['n'] :180;
    $nDay = $n - 1;
    $dbs66 = new mysqli("$hostname", "$user", "$password", "$database") or die(mysql_error());
    $dbs49 = new mysqli("$hostname1", "$user1", "$password1", "$database1") or die(mysql_error());
    $txResults = $dbs49->query(
        "SELECT ad.id, ad.changetime, format(ad.amount,4), format(ad.newBalance,4), ad.acctId, a.imei, format(a.cash,4)".
        " FROM $TableName1 ad LEFT JOIN $TableName2 a".
        " ON ad.acctId = a.id".
        " WHERE ad.changetime > DATE_SUB(CURDATE(), INTERVAL $nDay DAY)".
        " ORDER BY ad.id DESC");
//<h2 style="color:blue; text-decoration: underline ">AireTalk Member Query Page</h2>
    echo "<h2 style='color:blue; text-decoration: underline '>Audit: Cash update more than $10 on $hostname1 $database1.$TableName2 for the past $n day(s)</h2>";
    echo "<table border='1' style='border-collapse: collapse; border-color: silver'>";  
    prTblHeadings("update time", "added amount", "Balance after added ", "current Balance", "acct Id",
        "ID", "email", "last login", "created");
    echo "</tr>";  
    while ($row=$txResults->fetch_assoc()) { 
        $query = "SELECT id, email, lastlogin, created".
            " FROM $TableName".
            " WHERE idx=".$row['acctId'];
        $mbr = $dbs66->query($query)->fetch_assoc();
        echo "<tr>\n";  
        echo "<td align='center' width='150'>" . $row['changetime'] . "</td>\n";
        //echo "<td align='right'>" . $row['format(ad.amount,4)'] . "</td>\n";
        echo "<td align='center' width='100'>" . $row['format(ad.amount,4)'] . "</td>\n";
        echo "<td align='center' width='100'>" . $row['format(ad.newBalance,4)'] . "</td>\n";
        echo "<td align='center' width='100'>" . $row['format(a.cash,4)'] . "</td>\n";
        echo "<td align='center' width='100'>" . $row['acctId'] . "</td>\n";
        echo "<td align='center' width='200'>"  . $mbr['id'] . "</td>\n";
        echo "<td align='center' width='200'>"  . $mbr['email'] . "</td>\n";
        echo "<td align='center' width='150'>"  . $mbr['lastlogin'] . "</td>\n";
        echo "<td align='center' width='150'>"  . $mbr['created'] . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";  
    echo "<br><b>Last updated ".date('Y-m-d H:i:s T')."</b>\n";
?>

<p>
Logged in as: <?= $fgmembersite->UserFullName() ?>
</p>
<p>
<a href='login-home.php'>Menu Page</a>
</p>

<p>
<a href='logout.php'>Logout</a>
</p>

</body>  
</html>   
