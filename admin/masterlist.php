<?php 

/*
** EkklesiaSoft | VBS Registration
** http://www.ekklesiasoft.com
** info.php written by Jake Shepherd (jake@ekklesiasoft.com)
** Copyright (c) 2010 EkklesiaSoft, All Rights Reserved
*/
//Check for USER Login
	require_once('settings.php');

	checkLogin ( '1' );



//start a session
session_start();

//Include database connection file	
	include('../connections.php');

//build and issue query
if ($_POST[groupset] !=NULL)
{
	$groupset = '$_POST[groupset]';
	$id = '$_POST[id]';


	$sql ="UPDATE $table_name SET

		`group` =$groupset,

		WHERE id =$id";	
	
		$result = @mysql_query($sql,$connection) or die(mysql_error());
}
else {


//build and issue query
$sql ="SELECT id, cfname, clname, `group`  FROM $table_name ORDER BY id";
$result = @mysql_query($sql,$connection) or die(mysql_error());



//FORM 1 - create list block of results
$contact_list ="<ol>";
while ($row = mysql_fetch_array($result)) {
	$id = $row['id'];
	$cfname = $row['cfname'];
	$clname = $row['clname'];
	$contact_list .= "<li><a href=\"printform.php?id=$id\" class=\"link\">$clname,   $cfname</a>";
}
$contact_list .="</ol>";
}

// Query the database and get the count 
$count_result = mysql_query("SELECT * FROM $table_name"); 
$num_rows = mysql_num_rows($count_result); 

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $orginization ?> - <?php echo $eventname ?> Administration</title>
<link href="css/layout.css" media="all" rel="stylesheet" />
<link href="css/color_text.css" media="all" rel="stylesheet" />
<script type="text/javascript"  src="../nifty_corners/javascript/niftycube.js"></script>

<script type="text/javascript">
<!--
window.onload=function(){
Nifty('div#nav,div#promo','medium same-height'); //medium rounded corners, same height cols
Nifty('div#main_wrapper,div#content,div#footer','medium');  //medium rounded corners
Nifty('div#header','transparent medium'); // medium rounded corners w/transparency for gradient background image
AddCss ("../nifty_corners/css/niftyCorners.css"); // location of Nifty CSS file relative to this page
}
-->
</script>

</head>


<body class="red">
   <div class="red" id="main_wrapper">
   <div id="header">
     <div id="header_inner">
	   <h1><?php echo $eventname ?> Registration</h1>
         <h3><?php echo $orginization ?> </h3>
      <div id="logo"></div>
       <!-- end header_nav -->
     </div>
     <!-- end header_inner -->
</div>
<!-- end header -->

    <div id="twocolwrap">


<div id="nav">
<div id="nav_inner">
	<ul>
    	<?php echo $admin_menu; ?>

	</ul>
</div>
</div>

<div id="content">
  <div id="content_inner">

<h2>EkklesiaSoft Master List</h2>
	<p>Total Registered: <?php echo $num_rows; ?></p>
<? echo "$contact_list"; ?>

</div>
</div>
</div>


<!--div style="clear:both"></div-->   <!-- uncomment to fix draw problem on rounded footer box in Safari-->
<div id="footer">
	<div id="footer_inner">
		<p>&copy; 2010 EkklesiaSoft</p>
	</div>
</div>
</div>

</body>
</html>
