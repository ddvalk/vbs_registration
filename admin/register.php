<?php


/*
** EkklesiaSoft | VBS Registration
** http://www.ekklesiasoft.com
** index.php written by Jake Shepherd (jake@ekklesiasoft.com)
** Copyright (c) 2010 EkklesiaSoft, All Rights Reserved

*/

//Check for USER Login
	require_once('settings.php');

	checkLogin ( '1' );
$Level_access ='1';


	require_once('settings.php');

	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( $_POST['username'] != '' && $_POST['password'] != '' && $_POST['password'] == $_POST['password_confirmed'] && $_POST['email'] != '' && valid_email ( $_POST['email'] ) == TRUE )
		{
			if ( ! checkUnique ( 'Username', $_POST['username'] ) )
			{
				$error = 'Username already taken. Please try again!';
			}
			elseif ( ! checkUnique ( 'Email', $_POST['email'] ) )
			{
				$error = 'The email you used is associated with another user!';
			}
			else {	
					
				$query = $db->query ( "INSERT INTO " . DBPREFIX . "users (`Username` , `Password`, `date_registered`, `Email`, `Level_access`) VALUES (" . $db->qstr ( $_POST['username'] ) . ", " . $db->qstr ( md5 ( $_POST['password'] ) ).", '" . date ("Y-M-D") . "', " . $db->qstr ( $_POST['email'] ) . ", '$Level_access')" );
			$msg = 'User ' . $_POST['username'] .  ' has been added to the database.';

			}							
		}
		else {		
			$error = 'There was an error in your data. Please make sure you filled in all the required data, you provided a valid email address and that the password fields match one another.';	
		}
	}
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

	<div>
<?php	if ( isset ( $error ) )	{ echo '			<p class="error">' . $error . '</p>' . "\n";	}	?>
<?php	if ( isset ( $msg ) )	{ echo '			<p class="msg">' . $msg . '</p>' . "\n";	} else {//if we have a mesage we don't need this form again.?>
	</div>
  <h2 align="center">Add New User</h2>

	<div id="container" style="width:230px;">
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<input type="hidden" name="_submit_check" value="1"/> 
			
		<label for="username">Username</label>
		<input class="input" type="text" id="username" name="username" size="32" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" />
		
		<label for="password">Password</label>
		<input class="input" type="password" id="password" name="password" size="32" value="" />
		
		<label for="password_confirmed">Re-Password</label>
		<input class="input" type="password" id="password_confirmed" name="password_confirmed" size="32" value="" />
		
		<label for="email">Email</label>
		<input class="input" type="text" id="email" name="email" size="32" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" />
		
		<input type="image" name="register" value="register"  class="submit-btn" src="images/btn.gif" alt="submit" title="submit" />
		<div class="clear"></div>
	</form>
	</div>
<? } ?>
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
