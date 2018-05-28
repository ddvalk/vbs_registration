<?

/*
** EkklesiaSoft | VBS Registration
** http://www.ekklesiasoft.com
** printform.php written by Jake Shepherd (jake@ekklesiasoft.com)
** Copyright (c) 2010 EkklesiaSoft, All Rights Reserved

*/

//Check for USER Login
	require_once('settings.php');

	checkLogin ( '1' );

	include('../connections.php');




//check for required query string variables
if (!$_GET[id]) {
	header("Location:index.php");
	exit;
} else {
	//if form variables are present,start a session
	session_start();
}

	include('../connections.php');

//build and issue query
$chk_id = "SELECT id FROM $table_name WHERE id ='$_GET[id]'";
$chk_id_res = @mysql_query($chk_id,$connection) or die(mysql_error());
$chk_id_num = mysql_num_rows($chk_id_res);

//check for valid results
if ($chk_id_num !=1){

	//if not valid, redirect to menu
	header("index.php");
	exit;

} else {

	//if valid, get information
	$sql ="SELECT * FROM $table_name WHERE id ='$_GET[id]'";
	$result = @mysql_query($sql,$connection) or die(mysql_error());

	//get results for display
	while ($row =mysql_fetch_array($result)) {

	//CHILD NAME
		$cfname = $row['cfname'];
		$clname = $row['clname'];

	//CHILD INFO
		$group = $row['group'];
		$bdmon = $row['bdmon'];
		$bdday = $row['bdday'];
		$bdyear = $row['bdyear'];
		$grade = $row['grade'];
		$school = $row['school'];
		$lang = $row['lang'];
		$med = $row['med'];
		$com = $row['com'];


	//FAMILY INFORMATION
		$mname = $row['mname'];
		$mhphone = $row['mhphone'];
		$mcphone = $row['mcphone'];
		$fname = $row['fname'];
		$fhphone = $row['fhphone'];
		$fcphone = $row['fcphone'];
		$address1 = $row['addy1'];
		$address2 = $row['addy2'];
		$city = $row['city'];
		$state = $row['state'];
		$zip = $row['zip'];
		$email = $row['email'];
		$churchyn = $row['churchyn'];
		$church = $row['church'];
		$hear = $row['hear'];
		$hear_txt = $row['hear_txt'];
		$sibling = $row['sibling'];

	}
}

?>


<html>

<head>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $orginization ?> - <?php echo $eventname ?></title>
<style type="text/css">
<!--
.style1 {
	font-size: 11px
}
-->
</style>
</head>


<body style="margin:0;padding:0">
<div align="center">
<p><img src="../logo.gif" alt="logo" width="150"><br>
  <font size="5" face="Times New Roman"><strong><?php echo $eventname ?> Registration</strong></font>

</p></div>
<div>

  <table width="700" border="0" cellpadding="1" cellspacing="12" id="1">
    <tr>
      <td colspan="2"><strong>Name:</strong>		<em>
		<?
					if ($cfname != "") {
					echo "$cfname $clname<br>";
					}

		?>
       </em> </td>
      <td width="197"><strong>Group:</strong><em>

      	<?
					if ($group != "") {
					echo "$group";
					}

		?>

      </em></td>
    </tr>
    <tr>
      <td width="265"><strong>Birth Date: </strong><em>
      	<?
					if ($bdmon != "") {
					echo "$bdmon ";
					}
				?>- <?
					if ($bdday != "") {
					echo "$bdday ";
					}
				?>- <?
					if ($bdyear != "") {
					echo "$bdyear ";
					}
						?>
	  </em>     </td>
      <td width="184"><strong>Grade: </strong>
      <em>	<?
					if ($grade != "") {
					echo "$grade";
					}
				?> </em>      </td>
      <td><strong>School: </strong>
       <em>	<?
					if ($school != "") {
					echo "$school";
					}
				?> </em>      </td>
    </tr>
    <tr>
      <td><strong>Primary Language:</strong>
       <em>	<?
					if ($lang != "") {
					echo "$lang";
					}
				?> </em>      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Mother Name:</strong>
       <em>	<?
					if ($mname != "") {
					echo "$mname";
					}
				?> </em>      </td>
      <td><strong>Phone H:</strong>
      <em>	<?
					if ($mhphone != "") {
					echo "$mhphone";
					}
				?> </em></td>
      <td><strong>Phone W/C: </strong>
      <em>	<?
					if ($mcphone != "") {
					echo "$mcphone";
					}
				?> </em></td>
    </tr>
    <tr>
      <td><strong>Father Name:</strong>
      <em>	<?
					if ($fname != "") {
					echo "$fname";
					}
				?> </em></td>
      <td><strong>Phone H:</strong>
      <em>	<?
					if ($fhphone != "") {
					echo "$fhphone";
					}
				?> </em></td>
      <td><strong>Phone W/C:</strong>
      <em>	<?
					if ($fcphone != "") {
					echo "$fcphone";
					}
				?> </em></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Home Address:</strong>
      <em>	<?
					if ($address1 != "") {
					echo "$address1 ";
					}

					if ($address2 != "") {
					echo "$address2";
					}
				?> </em></td>
    </tr>
    <tr>
      <td><strong>City:</strong>
      <em>	<?
					if ($city != "") {
					echo "$city";
					}
				?> </em></td>
      <td><strong>State: </strong> <em>	<?
					if ($state != "") {
					echo "$state";
					}
				?> </em> <strong> Zip:</strong> <em>	<?
					if ($zip != "") {
					echo "$zip";
					}
				?> </em></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Email:</strong>  <em>	<?
					if ($email != "") {
					echo "$email";
					}
				?> </em></td>
      <td colspan="2"><strong>Home Church: </strong>  <em>	<?
					if ($churchyn != "") {
					echo "$churchyn";
					}
				?> -- <?
					if ($church != "") {
					echo "$church";
					}
				?> </em></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Siblings: </strong>
      <em>
      <?
					if ($sibling != "") {
					  $siblings .= ", $sibling";
					}

					echo "$siblings";

				?> </em>      </td>
    </tr>
    <tr>
      <td colspan="3"><strong>How did you hear about VBS:</strong>  <em>	<?
					if ($hear != "") {
					echo "$hear";
					}
				?> -- <?
					if ($hear_txt != "") {
					echo "$hear_txt";
					}
				?> </em></td>
    </tr>
  </table>
  <p><font size="3" face="Times New Roman">******************************<WBR>******************************<WBR>******************************<WBR></font><br>
</p>
  <p><font size="3" face="Times New Roman">
<strong>Name:</strong>
    <em>
    <?
	echo $cfname . " " . $clname ;

?>
    </em>

<strong> Age: </strong>
 <em>
 <?
$birthtime = strtotime( "$bdmon" . "/" . "$bdday" . "/" . "$bdyear" );
$age = floor ( (time() - $birthtime) / (60*60*24*365.25));

echo "$age     ";
?>
 </em></font><font size="3" face="Times New Roman"><strong>Group:</strong><em>

      	<?
					if ($group != "") {
					echo "$group";
					}

		?>

      </em></font></p>
<p><font size="3" face="Times New Roman">Please state any conditions
or limitations of a medical nature, which might impact your child’s
participation <br>
in Vacation Bible School:</font></p>
<p>
 <font size="2" face="Times New Roman">
  <em>	<?
					if ($med != "") {
					echo "$med <br>";
					}
				?>
    </em>  </font></p>
<p><font size="3" face="Times New Roman">Other comments (allergies to
bee stings, aspirin, penicillin, foods, medications regularly taken):</font> </p>
<p>
<font size="2" face="Times New Roman">
<em>
  <?
					if ($com != "") {
					echo "$com <br>";
					}
				?>
</em></font></p>
<p><strong>Authorization To Consent To Medical Treatment Of A Minor And Photographic Release</strong></p>
<p class="style1">	 I (we), the undersigned parent/guardian of a minor, do hereby authorize <?php echo $orginization ?> of <?php echo $eventlocation ?> Registration as agents for the undersigned to consent to any X-ray examination, anesthetic, medical or surgical diagnosis or treatment and hospital care which is deemed advisable by and tendered under the general or special supervision of any physician or surgeon licensed under the MEDICINE PRACTICE ACT or the medial staff or any licensed hospital or clinic, whether such diagnosis or treatment is rendered at the office of said physician or at said hospital.  </p>
<p class="style1">This medical authorization shall remain in effect for one (1) year from date of approval unless revoked in writing and delivered to said agents.  </p>
<p class="style1">I hereby grant permission to the <?php echo $orginization ?> of <?php echo $eventlocation ?> to utilize photographs or video footage taken during Vacation Bible School on the World Wide Web or in other official church printed publications without further consideration, and I acknowledge the church’s right to crop or treat the photograph at its discretion. </p>
<p>Signature of parent or guardian:	____________________________________________ Date: _____________</p>
<div align="left"></div>
 <br>
</div>

</body></html>