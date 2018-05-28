<?php 
/*
** EkklesiaSoft | VBS Registration
** http://www.ekklesiasoft.com
** Copyright (c) 2010 EkklesiaSoft, All Rights Reserved
*/
	require_once('settings.php');
	checkLogin('1 2');
	
	$query = "SELECT * FROM `" . DBPREFIX . "users` WHERE `ID` = " . $db->qstr ( $_SESSION['user_id'] );
	$row = $db->getRow ( $query );
	
	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( valid_email ( $_POST['email'] ) )
		{			
			$update = "UPDATE " . DBPREFIX . "users SET Email = " . $db->qstr ( $_POST['email'] );
			
			//do we allow users to change their usernames
			if ( ALLOW_USERNAME_CHANGE ) {
				$update .= ", Username = " . $db->qstr ( $_POST['username'] );
			}
			
			//if we have a new password via POST we update the old one
			if ( $_POST['password'] != '' ):
				$update .= ", Password = " . $db->qstr ( md5 ( $_POST['password'] ) );
			endif;
			
			$update .= " WHERE ID = " . $db->qstr ( $_SESSION['user_id'] );
			
			if ( $db->query ( $update ) )
			{
				$msg = 'Your profile was successfully updated!';
			}
			else {
				$error = 'I was unable to save your profile. Please contact the administrator at ' . ADMIN_EMAIL;
			}			 
		}
		else {
			$error = 'Invalid email address';
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

	<div id="log">
<?php	if ( isset ( $error ) )	{ echo '			<p class="error">' . $error . '</p>' . "\n";	}	?>
<?php	if ( isset ( $msg ) )	{ echo '			<p class="msg">' . $msg . '</p>' . "\n";	}	?>
	</div>
	  <h2 align="center">Edit User</h2>

	<div id="container" style="width:230px">
	<form class="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">
	
		<input type="hidden" name="_submit_check" value="1"/> 
			
		<label for="username">Username</label>
		<input class="input" type="text" id="username" name="username" size="32" <?php if ( ! ALLOW_USERNAME_CHANGE ): echo 'disabled'; endif; ?> value="<?=$row->Username?>" />
		
		<label for="password">Password</label>
		<input class="input" type="password" id="password" name="password" size="32" value="" />
		
		<label for="email">Email</label>
		<input class="input" type="text" id="email" name="email" size="32" value="<?=$row->Email?>" />
		
		<input type="image" name="register" value="register"  class="submit-btn" src="images/btn.gif" alt="submit" title="submit" />
		<div class="clear"></div>
					
	</form>
		
	</div>
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
