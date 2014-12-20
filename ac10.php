<?PHP
require_once("./include/membersite_config.php");

$controller_list=array("fred yang");
if(!$fgmembersite->CheckLogin() or !(in_array( $fgmembersite->UserFullName(), $controller_list)))
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
    <title>Audit: Cash update</title>
</head>  

<body> 
<?php
    function prTblHeadings() {
        $a=func_get_args();
        foreach ($a as &$e) {
            echo "<th>$e</td>\n";
        }
    }

    
    
    $n = (isset($_REQUEST['n'])) ?$_REQUEST['n'] :7;
    $nDay = $n - 1;
    $dbs66 = new mysqli("74.3.165.66", "root", "fafayou123!!", "fafa") or die(mysql_error());
    $dbs49 = new mysqli("71.19.247.49", "root", "fafayou123!!", "freeswitch") or die(mysql_error());
    $txResults = $dbs49->query(
        "SELECT ad.id, ad.changetime, format(ad.amount,4), format(ad.newBalance,4), ad.acctId, a.imei, format(a.cash,4)".
        " FROM auditAcctCash ad LEFT JOIN accounts a".
        " ON ad.acctId = a.id".
        " WHERE ad.changetime > DATE_SUB(CURDATE(), INTERVAL $nDay DAY)".
        " ORDER BY ad.id DESC");

    echo "<h2>Audit: Cash update > $10 on 71.19.247.49 freeswitch.accounts for the past $n day(s)</h2>";  
    echo "<table border='1' style='border-collapse: collapse; border-color: silver'>";  
    prTblHeadings("update time", "amount", "nBalance", "cBalance", "acct Id",
        "ID", "email", "last login", "created");
    echo "</tr>";  
    while ($row=$txResults->fetch_assoc()) { 
        $query = "SELECT id, email, lastlogin, created".
            " FROM member".
            " WHERE idx=".$row['acctId'];
        $mbr = $dbs66->query($query)->fetch_assoc();
        echo "<tr>\n";  
        echo "<td align='right'>" . $row['changetime'] . "</td>\n";
        echo "<td align='right'>" . $row['format(ad.amount,4)'] . "</td>\n";
        echo "<td align='right'>" . $row['format(ad.newBalance,4)'] . "</td>\n";
        echo "<td align='right'>" . $row['format(a.cash,4)'] . "</td>\n";
        echo "<td align='right'>" . $row['acctId'] . "</td>\n";
        echo "<td align='left'>"  . $mbr['id'] . "</td>\n";
        echo "<td align='left'>"  . $mbr['email'] . "</td>\n";
        echo "<td align='left'>"  . $mbr['lastlogin'] . "</td>\n";
        echo "<td align='left'>"  . $mbr['created'] . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";  
    echo "<br><b>Last updated ".date('Y-m-d H:i:s T')."</b>\n";
?> 
</body>  
</html>   
