<?php	
/*
** EkklesiaSoft | VBS Registration
** http://www.ekklesiasoft.com
** index.php written by Jake Shepherd (jake@ekklesiasoft.com)
** Copyright (c) 2010 EkklesiaSoft, All Rights Reserved
*/

	require_once('settings.php');
	include ( 'lib/Pagination.php' );
	checkLogin ( '1' );
	
	$active_users		=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 1" );
	$inactive_users		=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 0" );
	$suspended_users	=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 2" );
	
	$which_users		=	( numeric ( $_GET['active'] ) ) ? $_GET['active'] : '1';
	
	$pagination = new Pagination();
	$pagination->start = ( @$_GET['start'] ) ? $_GET['start'] : '0';
	$pagination->filePath = APPLICATION_URL . 'manage_users.php';
	$pagination->select_what = '*';
	$pagination->the_table = '`' . DBPREFIX . 'users`';
	$pagination->add_query = ' WHERE `Active` = ' . $db->qstr ( $which_users ) . ' ORDER BY `ID` DESC';
	$pagination->otherParams = '&active=' . $which_users;
	
	$query = $pagination->getQuery ( TRUE );
	$paginate = $pagination->paginate();

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
<script type="text/JavaScript">
	<!--
		function MM_jumpMenu(targ,selObj,restore){ //v3.0
		  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		  if (restore) selObj.selectedIndex=0;
		}
	//-->
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

	<div id="container" style="text-align:center;width:400px;">
	
   
		<TABLE width="98%">
			
			<caption>users control panel for <?=get_username ( $_SESSION['user_id'] )?></caption>
		
			<thead>
				<tr>
					<th><DIV align="center"><a href="manage_users.php"><b>Active</b></a></DIV></th>
					<th><DIV align="center"><a href="manage_users.php?active=0"><b>Inactive</b></a></DIV></th>
					<th><DIV align="center"><a href="manage_users.php?active=2"><b>Suspended</b></a></DIV></th>
				</tr>
			</thead>
			
			<tr>	
				<td width="60px"><DIV align="center"><b><?=$active_users?></b></DIV></td>
				<td width="60px"><DIV align="center"><b><?=$inactive_users?></b></DIV></td>
				<td width="60px"><DIV align="center"><b><?=$suspended_users?></b></DIV></td>
			</tr>
			
		</table>

		<div style="margin:20px 0 20px">
		
		<TABLE border="0" cellpadding="4" cellspacing="3" width="98%">
			
			<caption>users list</caption>
			
			<thead>
				<tr>
					<th><DIV align="center">&nbsp;</DIV></th>
					<th><DIV align="left"><b>Username</b></DIV></th>
					<th><DIV align="center"><b>Options</b></DIV></th>
				</tr>
			</thead>
<?php
	$nr = 1;
	if ( $db->RecordCount ( $query ) > 0 )
	{
		$users = $db->get_results ( $query );
		require_once ( BASE_PATH . "/lib/date_class/date.php" );
		$date = new DateClass ();//Create the date class instance

		foreach ( $users as $row ):
?>
			<tr>
				<th><DIV align="center"><b><?=$nr?></b></DIV></th>
				<td><DIV align="left" style="padding-left:8px"><?=$row->Username?><em>Registered on: <?=$date->ToString( 'd-M-Y', $row->date_registered )?></em></DIV></td>
				<td width="60">
					<DIV align="center">
					
						<select name="option" onChange="MM_jumpMenu('parent',this,0)">
							
							<option>----------</option>
<?php
						if ( $row->Active == 1 || $row->Active == 0 ):
?>
							<option value="admin_options.php?ID=<?=$row->ID?>&action=suspend&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Suspend</option>
<?php 
						endif;
?>
							
<?php
						if ( $row->Active == 0 || $row->Active == 2 ):
?>
							<option value="admin_options.php?ID=<?=$row->ID?>&action=activate&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Activate</option>
<?php
						endif;
?>
							<option value="admin_options.php?ID=<?=$row->ID?>&action=delete&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Delete</option>
							
						</select>
					
					</DIV>
				</td>
			</tr>
<?php
	$nr++;
		endforeach;
	}
	else {
?>
			<tr>
				<td colspan="3">No users to display</td>
			</tr>
<? } ?>
				
		</table>
		
		</div>

		<?=$paginate;?>
		
	
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
