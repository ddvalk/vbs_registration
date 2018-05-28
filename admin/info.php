<?php 

/*
** EkklesiaSoft | VBS Registration
** http://www.ekklesiasoft.com
** infp.php written by Jake Shepherd (jake@ekklesiasoft.com)
** Copyright (c) 2010 EkklesiaSoft, All Rights Reserved
*/

//Check for USER Login
	require_once('settings.php');

	checkLogin ( '1' );


//start a session
session_start();

//Include database connection file	
	include('../connections.php');



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
	<link href="css/styles.css" rel="stylesheet" type="text/css" />

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

<h2>Settings Info</h2>
	<p>These settings can be changed in  /admin/settings.php file.</p>
	<table width="460" border="0">
      <tr>
        <td width="140">Total Registered:</td>
        <td width="310"><?php echo $num_rows; ?></td>
      </tr>
    </table>
	<table width="460" border="0">
      <tr>
        <td width="141">VBS Director:</td>
        <td width="309"><?php echo $eventdirector; ?></td>
      </tr>
      <tr>
        <td>Director Title:</td>
        <td><?php echo $directortitle; ?></td>
      </tr>
      <tr>
        <td>Admin Email:</td>
        <td><?php echo $adminemail; ?></td>
      </tr>
      <tr>
        <td>Event Name:</td>
        <td><?php echo $eventname; ?></td>
      </tr>
      <tr>
        <td>Organization:</td>
        <td><?php echo $orginization; ?></td>
      </tr>
      <tr>
        <td>Year:</td>
        <td><?php echo $year; ?></td>
      </tr>
      <tr>
        <td>Website URL:</td>
        <td><?php echo $website; ?></td>
      </tr>
      <tr>
        <td>Event Date:</td>
        <td><?php echo $eventdate; ?></td>
      </tr>
      <tr>
        <td>Event Start Time:</td>
        <td><?php echo $eventstarttime; ?></td>
      </tr>
      <tr>
        <td>Event Location:</td>
        <td><?php echo $eventlocation; ?></td>
      </tr>
    </table>
	<table width="460" border="0">

      <tr>
        <td width="225"><span class="style2">Current Version: <?php echo $ekklesia_version; ?> </span></td>
        <td width="225"><div align="right"><span class="style2"><a href="http://www.ekklesiasoft.com/">Download</a> the latest version. </span></div></td>
      </tr>
    </table>
	<p>&nbsp;</p>
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
