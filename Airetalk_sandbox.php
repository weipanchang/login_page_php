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
<title>Airetalk Sandbox</title>
</head>
<!--<link href="default.css" rel="stylesheet" type="text/css" /> -->
</head>  

<body> 

<?php  
$content = file_get_contents('http://www.airetalk.com/FirstData/sandbox_james.txt'); 
//if ($content !== false) {
//   // do something with the content
//   echo $content;
//}
//else {
//   // an error happened
//   echo "File not found!";
//}

$convert = explode("\n", $content);
for ($i=0;$i<count($convert);$i++) 
{
    echo $convert[$i]; //write value by index
    echo "<br/>";
}
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
