<?php

	include('connections.php');
	session_start();

    $debug = 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $orginization ?> - <?php echo $eventname ?> Registration</title>
<link href="css/layout.css" media="all" rel="stylesheet" />
<link href="css/color_text.css" media="all" rel="stylesheet" />
<script type="text/javascript"  src="nifty_corners/javascript/niftycube.js"></script>

<script type="text/javascript">
window.onload=function(){
Nifty('div#nav,div#promo','medium same-height'); //medium rounded corners, same height cols
Nifty('div#main_wrapper,div#content,div#footer','medium');  //medium rounded corners
Nifty('div#header','transparent medium'); // medium rounded corners w/transparency for gradient background image
AddCss ("nifty_corners/css/niftyCorners.css"); // location of Nifty CSS file relative to this page
}
</script>

<style type="text/css">
<!--
.style2 {font-size: .8}
-->
</style>
</head>

<body class="red">
   <div id="main_wrapper">
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


<div id="content"> <!-- Start Content1 -->
  <div id="content_inner"> <!-- Start Content2 -->

      <table width="100%" border="0" cellspacing="10" cellpadding="30">
        <tr>
          <td height="2">


<!-- Checking fields -->

<?php

	if ($debug) { print_r ($_POST);  echo "<br><br>";   print_r ($_SESSION); echo "<br><br>\n"; }

    foreach (array_keys($_POST["cfname"]) as $i) {
       foreach (array (
            'cfname', 'clname', 'bdmon', 'bdday', 'bdyear',
            'grade', 'lang', 'school', 'conditionyn', "medfood",
            'medfoodtxt', "medmed", "medmedtxt", "medallother", "medallothertxt",
            "medlac", "medadd", "medaddtxt", "medasthma", "medasthmatxt",
            "medbring", "medbringtxt", "medother", "medothertxt"
           ) as $f) {
   	     $_SESSION["$f"][$i] = $_POST["$f"][$i];
       }
    }

    foreach (array ('mname', 'mhphone', 'mcphone',
		            'fname', 'fhphone', 'fcphone', 'addy1', 'addy2', 'city', 'state', 'zip', 'email', 'churchyn',
		            'church', 'hear', 'hear_txt', 'sibling') as $f) {
	   $_SESSION["$f"] = $_POST["$f"];
	}

	$missing = array();

    // print_r ($_POST);  echo "<br><br>";   print_r ($_SESSION);

	if (empty($_SESSION["cfname"][0]))
	   array_push ($missing, "<li>Please enter information for at least one child\n");
	   
	$siblings = '';
	
	foreach (array_keys($_SESSION["cfname"]) as $i) {
	   if (($i >= 0) && !empty($_SESSION["cfname"][$i])) {
          $conditionSet = 0;
	      if (empty($_SESSION["clname"][$i])) array_push ($missing, "<li>Missing last name for <b>" . $_SESSION["cfname"][$i] . "</b>\n");
	      if (empty($_SESSION["bdmon"][$i])) array_push ($missing, "<li>Missing birthday for <b>" . $_SESSION["cfname"][$i] . "</b>\n");
	      if (empty($_SESSION["bdday"][$i])) array_push ($missing, "<li>Missing birthday for <b>" . $_SESSION["cfname"][$i] . "</b>\n");
	      if (empty($_SESSION["bdyear"][$i])) array_push ($missing, "<li>Missing birthday for <b>" . $_SESSION["cfname"][$i] . "</b>\n");
	      if (empty($_SESSION["grade"][$i])) array_push ($missing, "<li>Missing grade for <b>" . $_SESSION["cfname"][$i] . "</b>\n");
	      if (empty($_SESSION["conditionyn"][$i]))
	            array_push ($missing, "<li>Please answer the medical condition question for <b>" . $_SESSION["cfname"][$i] . "</b> with Yes or No\n");
	      if (isset($_SESSION["medfood"][$i]) && ($_SESSION["conditionyn"][$i] == "Yes")) {
	          $conditionSet = 1;
	          if (empty($_SESSION["medfoodtxt"][$i]) ||
	            preg_match ('/Please specify food\(s\):\s+What/', $_SESSION["medfoodtxt"][$i]))
	                array_push ($missing, "<li>Please enter <i>food allergy</i> details for <b>" . $_SESSION["cfname"][$i] . "</b>");
	      }
	      if (isset($_SESSION["medmed"][$i]) && ($_SESSION["conditionyn"][$i] == "Yes")) {
	          $conditionSet = 1;
	          if (empty($_SESSION["medmedtxt"][$i]) ||
	            preg_match ('/medication\(s\):\s*What/', $_SESSION["medmedtxt"][$i]))
	                array_push ($missing, "<li>Please enter <i>medication allergy</i> details for <b>" . $_SESSION["cfname"][$i] . "</b>");
	      }
	      if (isset($_SESSION["medallother"][$i]) && ($_SESSION["conditionyn"][$i] == "Yes")) {
	          $conditionSet = 1;
	          if (empty($_SESSION["medallothertxt"][$i]) ||
	            preg_match ('/Please specify\s*$/', $_SESSION["medallothertxt"][$i]))
	                array_push ($missing, "<li>Please enter <i>other allergy</i> details for <b>" . $_SESSION["cfname"][$i] . "</b>");
	      }
	      if (isset($_SESSION["medasthma"][$i]) && ($_SESSION["conditionyn"][$i] == "Yes")) {
	          $conditionSet = 1;
	          if (empty($_SESSION["medasthmatxt"][$i]) ||
	            preg_match ('/Induced by:\s+Inhaler/', $_SESSION["medasthmatxt"][$i]))
	                array_push ($missing, "<li>Please enter <i>asthma</i> details for <b>" . $_SESSION["cfname"][$i] . "</b>");
	      }
	      if (isset($_SESSION["medadd"][$i]) && ($_SESSION["conditionyn"][$i] == "Yes")) {
	          $conditionSet = 1;
	          if (empty($_SESSION["medaddtxt"][$i]) ||
	            preg_match ('/Any special instructions\?\s*$/', $_SESSION["medaddtxt"][$i]))
	                array_push ($missing, "<li>Please enter <i>ADD/ADHD</i> comments for <b>" . $_SESSION["cfname"][$i] . "</b>");
	      }
	      if (isset($_SESSION["medbring"][$i]) && ($_SESSION["conditionyn"][$i] == "Yes")) {
	          $conditionSet = 1;
	          if (empty($_SESSION["medbringtxt"][$i]) ||
	            preg_match ('/Please list\:\s*All/', $_SESSION["medbringtxt"][$i]))
	                array_push ($missing, "<li>Please list <i>medications</i> for <b>" . $_SESSION["cfname"][$i] . "</b>");
	      }
	      if (isset($_SESSION["medother"][$i]) && ($_SESSION["conditionyn"][$i] == "Yes")) {
	          $conditionSet = 1;
	          if (empty($_SESSION["medothertxt"][$i]) ||
	            preg_match ('/Enter concerns\s*$/', $_SESSION["medothertxt"][$i]))
	                array_push ($missing, "<li>Please enter details on <i>other concerns</i> for <b>" . $_SESSION["cfname"][$i] . "</b>");
          }
          if (isset($_SESSION["medlac"][$i]))
  	          $conditionSet = 1;
  	     
  	      if (($_SESSION["conditionyn"][$i] == "Yes") && (!$conditionSet))
  	      	  array_push ($missing, "<li>You indicated <b>" . $_SESSION["cfname"][$i] . "</b> has a special need. Please choose a condition from the list.\n");

	   }

	   $siblings .= $_SESSION[cfname][$i] . " (" . $_SESSION[grade][$i] . ") ";

	}
	
	if (!empty($_SESSION[sibling]) &&
	     !preg_match ('/For planning purposes/', $_SESSION[sibling]))
	         $siblings = $siblings . " $_SESSION[sibling]";

	if (empty($_SESSION[fname]) && empty($_SESSION[mname]))
	   array_push ($missing, "<li>Please enter a mother or father's name\n");

	if (empty($_SESSION[fhphone]) && empty($_SESSION[fcphone]) && empty($_SESSION[mhphone]) && empty($_SESSION[mcphone]))
	   array_push ($missing, "<li>You must include at least one phone number.\n");

	if (empty($_SESSION[addy1])) {
	   array_push ($missing, "<li>An address must be included\n");
	} else {
	   if (empty($_SESSION[city]))
	      array_push ($missing, "<li>Address: Please enter a City\n");

	   if (empty($_SESSION[state]))
	      array_push ($missing, "<li>Address: Please enter a State\n");

	   if (empty($_SESSION[zip]))
	      array_push ($missing, "<li>Address: Please enter a Zip\n");
	}

	if (empty($_SESSION[hear]))
	   $missing[] = "<li>Please tell us how you heard about VBS this year\n";

	if (!empty($missing)) {
	  print "<h2>Missing Required Information</h2>\n";
	  print "<p>Please use the <i>BACK</i> button on your browser and complete the following missing fields:\n<ul>\n";
	  foreach ($missing as $msg) {
	     print "$msg\n";
	  }
	  print "</ul>\n";
	} else {

	  foreach (array_keys($_SESSION["cfname"]) as $i) {
	     if (empty($_SESSION["cfname"][$i])) {
	        break;
	     }

         $fields = '';
         $values = '';

	     foreach (array (
	         'cfname', 'clname', 'bdmon', 'bdday', 'bdyear', 'grade', 'school',
	         'lang', 'medfood', 'medmed', 'medallother', 'medlac', 'medadd',
	         'medasthma', 'medbring', 'medother', 'conditionyn') as $f) {
	        $fields .= "${f}, ";
	        $values .= "'" . $_SESSION[$f][$i] . "', ";
	     }

	     foreach (array ('mname', 'mhphone', 'mcphone',
	                     'fname', 'fhphone', 'fcphone', 'addy1', 'addy2',
	                     'city', 'state', 'zip', 'email', 'churchyn',
	                     'church', 'hear', 'hear_txt') as $f) {
	        $fields .= "$f, ";
	        $values .= "'$_SESSION[$f]', ";
	     }

	     $fields .= "sibling, ";
	     $values .= "'$siblings', ";

	     $fields .= "medfoodtxt, ";
	     $values .= isset($_SESSION[medfood][$i]) ? "'" . $_SESSION[medfoodtxt][$i] . "', " : "'', ";

	     $fields .= "medmedtxt, ";
	     $values .= isset($_SESSION[medmed][$i]) ? "'" . $_SESSION[medmedtxt][$i] . "', " : "'', ";

	     $fields .= "medallothertxt, ";
	     $values .= isset($_SESSION[medallother][$i]) ? "'" . $_SESSION[medallothertxt][$i] . "', " : "'', ";

	     $fields .= "medaddtxt, ";
	     $values .= isset($_SESSION[medadd][$i]) ? "'" . $_SESSION[medaddtxt][$i] . "', " : "'', ";

	     $fields .= "medasthmatxt, ";
	     $values .= isset($_SESSION[medasthma][$i]) ? "'" . $_SESSION[medasthmatxt][$i] . "', " : "'', ";

	     $fields .= "medbringtxt, ";
	     $values .= isset($_SESSION[medbring][$i]) ? "'" . $_SESSION[medbringtxt][$i] . "', " : "'', ";

	     $fields .= "medothertxt, ";
	     $values .= isset($_SESSION[medother][$i]) ? "'" . $_SESSION[medothertxt][$i] . "', " : "'', ";

   	     $fields = preg_replace('/, $/', '', $fields);
	     $values = preg_replace('/, $/', '', $values);

	     if ($debug) { print_r ($fields); print_r ($values); }
	     
	     //build and issue query
	     $sql = "INSERT INTO $table_name ($fields) VALUES ($values)";

	     $result = mysqli_query($connection,$sql) or warn(mysqli_error());
      }

	  $headers = "From: $eventname <$adminemail>\r\n" .
	             "Reply-To: $adminemail\r\n" .
	             'X-Mailer: PHP/' . phpversion();

	  print <<< EOM

	<h2><em>You have successfully registered your children.</em></h2><hr>
	<P>The information below was successfully submitted.<p>You will be receiving a confirmation email at '$_SESSION[email]' from <i>$adminemail</i>.</P>
	<table>
	<tr><td><h2>Children</h2>

EOM;

	$message = "Thank you for pre-registering for $eventname .\n\n" .
	           "We look forward to having you join us each morning $eventdate at $eventstarttime . Please be sure to arrive early on Monday morning to complete registration. We will have a separate area set aside for you to receive your materials.\n\n" .
	           "For more information, please visit our website at $website .\n\n" .
	           "The following children have been registered:\n\n";

	foreach (array_keys($_SESSION["cfname"]) as $i) {
	      if (empty($_SESSION["cfname"][$i])) {
	         break;
	      }

	      print "
	        <DIV id='child$i' class='width350'> <!-- START Table 3 -->
	          <TABLE width='100%'  border='0' cellpadding='4' cellspacing='0'>
	            <TR bgcolor='#F0F4CC'>
	              <TD height='10' colspan='2' class='arial-8'><b>Name: </b>" . $_SESSION[cfname][$i] . " " . $_SESSION[clname][$i] . "</TD>";

	      $message .= "     " . $_SESSION[cfname][$i] . " " . $_SESSION[clname][$i] . "\n";

	      print "
	            <TR bgcolor='#FFFFFF' align=left>
	              <TD height='10' colspan='1' class='arial-8'><b>Birthday: </b>" . $_SESSION[bdmon][$i]."/".$_SESSION[bdday][$i]."/".$_SESSION[bdyear][$i]."</TD>\n";
	      print "
	              <TD height='10' colspan='1' class='arial-8'><b>Grade (in Fall): </b>" . $_SESSION[grade][$i] . "</TD>\n";

	      print "
	            <TR bgcolor='#F0F4CC'>
	              <TD height='10' colspan='1' class='arial-8'><b>Primary Spoken Language: </b>" . $_SESSION[lang][$i] . "</TD>\n";

	      print "<TD height='10' colspan='1' class='arial-8'><b>School: </b>" . $_SESSION[school][$i] . "</TD>\n";
	      print "</tr>\n";

	      print "
	            </TABLE></DIV>  <!-- END Table 3 -->";
	}

	print <<< EOF

	<tr><td><hr><h2>Family Information</h2>

	   	<DIV id="family" class="width550"> <!-- start div 4 -->
	      <TABLE width="100%"  border="0" cellpadding="4" cellspacing="0">
	        <TR bgcolor="#F0F4CC">
	          <TD height="10" colspan="1" class="arial-8"><b>Father's Name: </b>$_SESSION[fname]</TD>
	          <TD height="10" colspan="1" class="arial-8"><b>Father's Home Phone: </b>$_SESSION[fhphone]</TD>
	          <TD height="10" colspan="1" class="arial-8"><b>Father's Cell Phone: </b>$_SESSION[fcphone]</TD>
	        </tr>
	        <TR bgcolor="#FFFFFF">
	          <TD height="10" colspan="1" class="arial-8"><b>Mother's Name: </b>$_SESSION[mname]</TD>
	          <TD height="10" colspan="1" class="arial-8"><b>Mother's Home Phone: </b>$_SESSION[mhphone]</TD>
	          <TD height="10" colspan="1" class="arial-8"><b>Mother's Cell Phone: </b>$_SESSION[mcphone]</TD>
	        </tr>

	        <TR bgcolor="#F0F4CC">
	          <TD height="10" class="arial-8"><b>Address</b></td>
	          <TD colspan=2 class="arial-8">
	            $_SESSION[addy1]<br>
EOF;

	            if ($_SESSION[addy2]) {echo "$_SESSION[addy2]<br>";}

	print <<< EOF2
	            $_SESSION[city], $_SESSION[state]  $_SESSION[zip]
	          </TD>

	        <TR bgcolor="#FFFFFF">
	          <TD height="10" colspan="3" class="arial-8"><b>E-mail Address: </b>$_SESSION[email]</TD>

	        <TR bgcolor="#F0F4CC">
	          <TD height="10" colspan="3" class="arial-8"><b>Church Home: </b>
EOF2;

	          if ($_SESSION[churchyn] == "Yes") { echo "$_SESSION[church]";} else { echo "None";}

	   print "</TD></tr></TABLE></DIV> <!-- END table 4 -->\n";

	   $message .= "\nIf you have any questions or would like to change the information submitted, please reply to this email.\n\n";
	   $message .= "$eventdirector\n$directortitle\n\n";

	   mail ("$_SESSION[email]", "$eventname Registration", $message, $headers) or print "<br><h2>Failed to send email.</h2>\n";

	}
?>

<br />          </td>
        </tr>
      </table>

      <span class="style2">
      </table>
      
      <?php
      if (empty($missing)) {
         echo "<a href=" . $website . ">Click here to return to the main site.</a>\n";
      } 
      ?>
      
      </span></div>
      
  <!-- END Content 2  -->
</div> <!-- END Content 1 -->

<div style="clear:both"></div>  <!-- uncomment to fix draw problem on rounded footer box in Safari-->
<div id="footer">
	<div id="footer_inner">
		<p>&copy; EkklesiaSoft</p>
	</div>
</div>
</div>
</body>
</html>
