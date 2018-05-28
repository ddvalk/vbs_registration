<?php

/*
** EkklesiaSoft | VBS Registration
** http://www.ekklesiasoft.com
** login.php written by Jake Shepherd (jake@ekklesiasoft.com)
** Copyright (c) 2010 EkklesiaSoft, All Rights Reserved
*/

	require_once ( 'settings.php' );

	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( $_POST['username'] != '' && $_POST['password'] != '' )
		{
			$query = 'SELECT ID, Username, Active, Password FROM ' . DBPREFIX . 'users WHERE Username = ' . $db->qstr ( $_POST['username'] ) . ' AND Password = ' . $db->qstr ( md5 ( $_POST['password'] ) );

			if ( $db->RecordCount ( $query ) == 1 )
			{
				$row = $db->getRow ( $query );
				if ( $row->Active == 1 )
				{
					set_login_sessions ( $row->ID, $row->Password, ( $_POST['remember'] ) ? TRUE : FALSE );
					header ( "Location: " . REDIRECT_AFTER_LOGIN );
				}
				elseif ( $row->Active == 0 ) {
					$error = 'Your membership was not activated. Please open the email that we sent and click on the activation link.';
				}
				elseif ( $row->Active == 2 ) {
					$error = 'You are suspended!';
				}
			}
			else {		
				$error = 'Login failed!';		
			}
		}
		else {
			$error = 'Please use both your username and password to access your account';
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
<?php if ( isset( $error ) ) { echo '			<p class="error">' . $error . '</p>' . "\n";}?>
	</div>
	<div id="container" style="width:230px;">

		<form class="form" action="<?=$_SERVER['PHP_SELF']?>" method="post">

			<input type="hidden" name="_submit_check" value="1"/> 
		
			<div style="margin-top:12px; margin-bottom:10px">
				<img src="images/username.gif" alt="username" border="0" />
				<input class="input" type="text" name="username" id="username" size="25" maxlength="40" value="" />
			</div>
			<div style="margin-bottom:6px">
				<img src="images/password.gif" alt="password" border="0" />
				<input class="input" type="password" name="password" id="password" size="25" maxlength="32" />
			</div>
			<?php if ( ALLOW_REMEMBER_ME ):?>
			<div style="margin-bottom:6px">
				<input type="checkbox" name="remember" id="remember" />
				<label for="remember">Remember me</label>
			</div>
			<?php endif;?>
			<input type="image" name="Login" value="Login"  class="submit-btn" src="images/btn.gif" alt="submit" title="submit" />
			<br class="clear" />			
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