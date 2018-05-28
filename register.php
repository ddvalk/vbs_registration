<?php

/*
** EkklesiaSoft | VBS Registration
** http://www.ekklesiasoft.com
** register.php written by Jake Shepherd (jake@ekklesiasoft.com)
** Copyright (c) 2010 EkklesiaSoft, All Rights Reserved

*/

	include('connections.php');
	session_start();

    $debug = 0;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $orginization ?> - <?php echo $eventname ?> Registration</title>
<link href="css/layout.css" media="all" rel="stylesheet" />
<link href="css/color_text.css" media="all" rel="stylesheet" />
<script type="text/javascript"  src="nifty_corners/javascript/niftycube.js"></script>

<script type="text/javascript">
<!--
window.onload=function(){
Nifty('div#nav,div#promo','medium same-height'); //medium rounded corners, same height cols
Nifty('div#main_wrapper,div#content,div#footer','medium');  //medium rounded corners
Nifty('div#header','transparent medium'); // medium rounded corners w/transparency for gradient background image
AddCss ("nifty_corners/css/niftyCorners.css"); // location of Nifty CSS file relative to this page
}
-->
</script>

<SCRIPT language="JavaScript">
function OnSubmitForm() {
  if(document.pressed == 'Submit Registration') {
     document.myform.action ="submit.php";
  } else {
     document.myform.action ="register.php#last_child";
  }
  return true;
}
</SCRIPT>

</head>

<? if ($debug) { print_r ($_POST);  echo "<br><br>";   print_r ($_SESSION); echo "<br><br>\n"; } ?>

<body class="red">
   <div id="main_wrapper">
     <div id="header" width:1000px>
       <div id="header_inner">
   <h1><?php echo $eventname ?> Registration</h1>
                 <h3><?php echo $orginization ?> </h3>
         <div id="logo"></div>
       <!-- end header_nav -->
       </div>
     <!-- end header_inner -->
     </div>
     <!-- end header -->
     <div id="content" width:1000px>
       <div id="content_inner">

         <form name='myform' method='post' onSubmit="return OnSubmitForm();">

         <?php
		  $ipi = getenv("REMOTE_ADDR");
		  $httprefi = getenv ("HTTP_REFERER");
		  $httpagenti = getenv ("HTTP_USER_AGENT");
	     ?>

         <input type="hidden" name="ip" value="<?php echo $ipi ?>" />
         <input type="hidden" name="httpref" value="<?php echo $httprefi ?>" />
         <input type="hidden" name="httpagent" value="<?php echo $httpagenti ?>" />

         <table>

         <?php
            if(isset($_POST["AddChild"])) {
		       foreach (array ('mname', 'mhphone', 'mcphone',
		 	                  'fname', 'fhphone', 'fcphone', 'addy1', 'addy2',
		 	                  'city', 'state', 'zip', 'email', 'churchyn',
		 	                  'church', 'hear', 'hear_txt', 'sibling') as $f) {
		 	     $_SESSION[$f] = $_POST[$f];
		 	  }
		    } elseif (isset($_POST["reset"])) {
			   session_unset();
               session_destroy();
               unset ($_POST["reset"]);
            }
		 ?>


           <tr><td><hr><h2>Family Information</h2>

             <table class="table_border" border="0" cellpadding="4" cellspacing="0">
               <tr bgcolor="#F0F4CC" >
               <td width="33%" height="10" colspan="1" class="arial-8"><b>Father's Full Name: <br>
               </b>
               <?
               echo "<input name='fname' type='text' class='arial-8' size='25' maxlength='50' value='".$_SESSION['fname']."'/>     </td>";
               ?>
               <td width="33%" height="10" colspan="1" class="arial-8"><b>Father's Home Phone:</b><br>
               <?
               echo "<input name='fhphone' type='text' class='arial-8' size='15' maxlength='50' value='".$_SESSION['fhphone']."'/>     </td>";
               ?>
               <td width="33%" height="10" colspan="1" class="arial-8"><b>Father's Cell Phone:</b><br>
               <?
               echo "<input name='fcphone' type='text' class='arial-8' size='15' maxlength='50' value='".$_SESSION['fcphone']."'/>     </td>";
               ?>
               </tr>
               <tr bgcolor="#FFFFFF">
                 <td height="10" colspan="1" width="33%" class="arial-8"><b>Mother's Full Name:</b><br>
                   <?
                   echo "<input name='mname' type='text' class='arial-8' size='25' maxlength='50' value='".$_SESSION['mname']."'/>     </td>";
                   ?>
                 <td height="10" colspan="1" width="33%" class="arial-8"><b>Mother's Home Phone:</b><br>
                   <?
                   echo "<input name='mhphone' type='text' class='arial-8' size='15' maxlength='50' value='".$_SESSION['mhphone']."'/>     </td>";
                   ?>
                 <td height="10" colspan="1" width="33%" class="arial-8"><b>Mother's Cell Phone: </b><br>
                   <?
                   echo "<input name='mcphone' type='text' class='arial-8' size='15' maxlength='50' value='".$_SESSION['mcphone']."'/>     </td>";
                   ?>
               </tr>

               <tr bgcolor="#F0F4CC">
                 <td height="10" colspan="3" class="arial-8">
                   <b>Address 1: </b>
                   <?
                   echo "<input name='addy1' type='text' class='arial-8' size='30' maxlength='50' value='".$_SESSION['addy1']."'/><br>";
                   ?>
                   <b>Address 2: </b>
                   <?
                   echo "<input name='addy2' type='text' class='arial-8' size='30' maxlength='50' value='".$_SESSION['addy2']."'/><br>";
                   ?>
                   <b>City: </b>
                   <?
                   echo "<input name='city' type='text' class='arial-8' size='30' maxlength='50' value='".$_SESSION['city']."'/><br>";
                   ?>
                   <b>State: </b>
                   <?
                   echo "<input name='state' type='text' class='arial-8' size='2' maxlength='2' value='".$_SESSION['state']."'/><br>";
                   ?>
                   <b>Zip: </b>
                   <?
                   echo "<input name='zip' type='text' class='arial-8' size='10' maxlength='10' value='".$_SESSION['zip']."'/><br>";
                   ?>
               <tr bgcolor="#FFFFFF">
                 <td height="10" colspan="3" class="arial-8"><b>E-mail Address: </b>
                   <?
                   echo "<input name='email' type='text' class='arial-8' size='30' maxlength='50' value='".$_SESSION['email']."'/></td>";
                   ?>
               <tr bgcolor="#F0F4CC">
                 <td height="10" colspan="3" class="arial-8"><b>Do you have a Church Home?: </b>
                   <select name="churchyn" class="arial-8" style="width:100px;">
                            <?
                            if ($_SESSION['churchyn'] == "No") {
                            ?>
			  				   <option value="Yes">Yes</option>
			  				   <option selected value="No">No</option>
			  				<?
			  				} else {
			  				?>
			  				   <option selected value="Yes">Yes</option>
			  				   <option value="No">No</option>
			  				<?
			  				}
			  				?>

		           </select><br>
		           <b>Name of Church Home: </b>
                   <?
                   echo "<input name='church' type='text' class='arial-8' size='35' maxlength='75' value='".$_SESSION['church']."'/></td>";
                   ?>
               <tr bgcolor="#FFFFFF" align=left>
                 <td colspan="2" class="arial-8"><b>Siblings NOT Attending</b>
                 <textarea class="arial-8" name="sibling" rows=2 cols=70 onFocus="this.select()">
<?
                 if (!empty($_SESSION['sibling'])) {
                    echo $_SESSION['sibling'];
                 } else {
                    echo "For planning purposes, please enter the names and ages of siblings NOT attending VBS this year.";
                 }
?>
                 </textarea> </td>
                 <td></td> </tr>
              </table>

           <tr><td><hr><h2>Where did you hear about VBS?</h2>

             <table class="table_border" border="0" cellpadding="4" cellspacing="0">
               <tr bgcolor="#F0F4CC"><td align=left>
                 <select name="hear" class="arial-8">
  		          <option value="">Choose one</option>
  		          <option <?if ($_SESSION['hear']=="mail") { echo "selected"; }?> value="mail">Mailer</option>
  		          <option <?if ($_SESSION['hear']=="flyer") { echo "selected"; }?> value="flyer">Neighborhood flyer</option>
  		          <option <?if ($_SESSION['hear']=="friend") { echo "selected"; }?> value="friend">Friend (include name)</option>
  		          <option <?if ($_SESSION['hear']=="school") { echo "selected"; }?> value="school">School or club (include name)</option>
  		          <option <?if ($_SESSION['hear']=="gbc") { echo "selected"; }?> value="gbc">Grace Bible Chapel</option>
  		          <option <?if ($_SESSION['hear']=="hbc") { echo "selected"; }?> value="hbc">Hillview Bible Chapel</option>
  		          <option <?if ($_SESSION['hear']=="club") { echo "selected"; }?> value="club">Boys/Girls Club</option>
		          <option <?if ($_SESSION['hear']=="banner") { echo "selected"; }?> value="banner">Sign in front of church</option>
		          <option <?if ($_SESSION['hear']=="alumni") { echo "selected"; }?> value="alumni">Previous VBS</option>
		          <option <?if ($_SESSION['hear']=="other") { echo "selected"; }?> value="other">Other (include below)</option>
                 </select>
               <tr bgcolor="#F0F4CC"><td align=left>
                <textarea class="arial-8" name="hear_txt" rows=2 cols=70 onFocus="this.select()">
<?
                 if (isset($_SESSION['hear_txt'])) {
                    echo $_SESSION['hear_txt'];
                 } else {
                    echo "Name of friend, club, other information";
                 }
?>
              </textarea>
             </table>


           <tr><td><h2>Child Information</h2>
<?

   if(isset($_POST["AddChild"])) {
      $n = $_SESSION[num_child] ? $_SESSION[num_child] : 0;

    echo "$_SESSION[num_child], $_POST[cfname][$n]";

      if (!empty($_POST["cfname"][$n])) {
         foreach (array (
                        'cfname', 'clname', 'bdmon', 'bdday', 'bdyear',
                        'grade', 'lang', 'school', 'conditionyn', "medfood",
		 	            'medfoodtxt', "medmed", "medmedtxt", "medallother", "medallothertxt",
		 	            "medlac", "medadd", "medaddtxt", "medasthma", "medasthmatxt",
		 	            "medbring", "medbringtxt", "medother", "medothertxt"
                        ) as $f) {
    	   $_SESSION[$f][$n] = $_POST[$f][$n];
         }

         $_SESSION[num_child] += 1;
      }

      unset ($_POST["AddChild"]);
   }

   for ($i = 0; $i <= $_SESSION[num_child]; $i++) {
      if (($i > 0) && isset($_SESSION[cfname][$i-1]) && empty($_SESSION[cfname][$i-1])) {
         $_SESSION[num_child] = $i-1;
         if ($debug) echo "Breaking now!\n";
         break;
      }

?>

	<table class="table_border" border="0" cellpadding="0" cellspacing="4">
    
      <tr bgcolor="#F0F4CC"><td height="10" class="arial-8" colspan=2>
        <b>Child's First Name: </b>
        <?
        echo "<input name='cfname[$i]' id='cfname_$i' type='text' class='arial-8' size='20' maxlength='50' value='".$_SESSION["cfname"][$i]."'>\n";
        ?>
      <tr bgcolor="#F0F4CC"><td height="10" class="arial-8" colspan=2>
        <b>Child's Last Name: </b>
        <?
        echo "<input name='clname[$i]' id='clname_$i' type='text' class='arial-8' size='20' maxlength='50' value='".$_SESSION["clname"][$i]."'>\n";
        ?>
      <tr bgcolor="#F0F4CC"><td height="10" class="arial-8" colspan=2>
      <b>Birthday: </b>
        <?
        echo "<select name=\"bdmon[$i]\" class=\"arial-8\" id=\"bdmon_$i\" value='".$_SESSION["bdmon"][$i]."'>\n";
        ?>
          <option value="" class="arial-8">month</option>
          <option <?if ($_SESSION['bdmon'][$i]=="") { echo "selected"; }?> value="">------</option>
          <option <?if ($_SESSION['bdmon'][$i]=="01") { echo "selected"; }?> value="01">January</option>
          <option <?if ($_SESSION['bdmon'][$i]=="02") { echo "selected"; }?> value="02">February</option>
          <option <?if ($_SESSION['bdmon'][$i]=="03") { echo "selected"; }?> value="03">March</option>
          <option <?if ($_SESSION['bdmon'][$i]=="04") { echo "selected"; }?> value="04">April</option>
          <option <?if ($_SESSION['bdmon'][$i]=="05") { echo "selected"; }?> value="05">May</option>
          <option <?if ($_SESSION['bdmon'][$i]=="06") { echo "selected"; }?> value="06">June</option>
          <option <?if ($_SESSION['bdmon'][$i]=="07") { echo "selected"; }?> value="07">July</option>
          <option <?if ($_SESSION['bdmon'][$i]=="08") { echo "selected"; }?> value="08">August</option>
          <option <?if ($_SESSION['bdmon'][$i]=="09") { echo "selected"; }?> value="09">September</option>
          <option <?if ($_SESSION['bdmon'][$i]=="10") { echo "selected"; }?> value="10">October</option>
          <option <?if ($_SESSION['bdmon'][$i]=="11") { echo "selected"; }?> value="11">November</option>
          <option <?if ($_SESSION['bdmon'][$i]=="12") { echo "selected"; }?> value="12">December</option>
        </select>
        
        <?php
        echo "<select name=\"bdday[$i]\" class=\"arial-8\" id=\"bdday_$i\" value='".$_SESSION["bdday"][$i]."'>\n";
        ?>
          <option <?if ($_SESSION['bdday'][$i]=="") { echo "selected"; }?> value="">day</option>
          <option value="">------</option>
          <?php for ($x = 1; $x <= 31; $x++) {
              echo "<option "; if ($_SESSION['bdday'][$i]==$x) { echo "selected"; } echo " value=\"$x\">$x</option>\n";
          } ?>
        </select>

        <?
        echo "<select name=\"bdyear[$i]\" class=\"arial-8\" id=\"bdyear_$i\" value='".$_SESSION["bdyear"][$i]."'>\n";
        ?>
          <option <?if ($_SESSION['bdyear'][$i]=="") { echo "selected"; }?> value="">year</option>
          <option value="">------</option>
          <?php for ($x = 3; $x <= 13; $x++) {
              $y = date("Y")-$x;
              echo "<option "; if ($_SESSION['bdyear'][$i]==$y) { echo "selected"; } echo " value=\"$y\" >$y</option>\n";
          } ?>
        </select>

      <tr bgcolor="#F0F4CC"><td height="10" class="arial-8" colspan=2>
        <b>Grade (in Fall): </b>
        <?
        echo "<select name=\"grade[$i]\" class=\"arial-8\" id=\"grade_$i\" value='".$_SESSION["grade"][$i]."'>\n";
        ?>
          <option <?if ($_SESSION['grade'][$i]=="") { echo "selected"; }?> value="">Choose one</option>
          <option <?if ($_SESSION['grade'][$i]=="K") { echo "selected"; }?> value="K">K</option>
          <option <?if ($_SESSION['grade'][$i]=="1") { echo "selected"; }?> value="1">1</option>
          <option <?if ($_SESSION['grade'][$i]=="2") { echo "selected"; }?> value="2">2</option>
          <option <?if ($_SESSION['grade'][$i]=="3") { echo "selected"; }?> value="3">3</option>
          <option <?if ($_SESSION['grade'][$i]=="4") { echo "selected"; }?> value="4">4</option>
          <option <?if ($_SESSION['grade'][$i]=="5") { echo "selected"; }?> value="5">5</option>
          <option <?if ($_SESSION['grade'][$i]=="6") { echo "selected"; }?> value="6">6</option>
          <option <?if ($_SESSION['grade'][$i]=="7") { echo "selected"; }?> value="7">7</option>
        </select>
      <tr bgcolor="#F0F4CC"><td height="10" class="arial-8" colspan=2>
      <b>Primary Spoken Language:</b>
        <?
        echo "<input name=\"lang[$i]\" id=\"lang_$i\" type=\"text\" class=\"arial-8\" size=\"15\" maxlength=\"35\" value='".$_SESSION["lang"][$i]."'>\n";
        ?>
      <tr bgcolor="#F0F4CC"><td height="10" class="arial-8" colspan=2>
      <b>School:</b>
        <?
        echo "<input name=\"school[$i]\" id=\"school_$i\" type=\"text\" class=\"arial-8\" size=\"15\" maxlength=\"35\" value='".$_SESSION["school"][$i]."'>\n";
        ?>
    <tr bgcolor="#FFFFFF" align=middle>
      <td class="arial-8" colspan=2><b>Medical/physical information</b>
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10"  class="arial-8">
            <? echo "<select name=\"conditionyn[$i]\" class=\"arial-8\" id=\"conditionyn_$i\" style=\"width:100px;\">\n";
            if (!isset($_SESSION['conditionyn'][$i]) || !$_SESSION['conditionyn'][$i]) { ?>
			    <option selected value="">------</option>
			    <option value="Yes">Yes</option>
			  	<option value="No">No</option>
			<? } elseif ($_SESSION['conditionyn'][$i] == "Yes") { ?>
			  	<option selected value="Yes">Yes</option>
			  	<option value="No">No</option>
			<? } else { ?>
			  	<option value="Yes">Yes</option>
			  	<option selected value="No">No</option>
			<? } ?>
		<td>
<b>REQUIRED!</b> Does your child have any conditions or limitations that might affect his/her participation in Vacation Bible School?
Please include any food allergies, medical conditions, or special instructions. We do our best to keep this information private.
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10" class="arial-8">
            <? echo "<input type=\"checkbox\" id=\"medfood_$i\" name=\"medfood[$i]\" "; if (isset ($_SESSION['medfood'][$i])) echo "checked"; echo ">\n";
            echo "<label for=\"medfood_$i\">Food allergy?</label>\n"; ?>
        <td style="width:3*" height="10">
            <? echo "<textarea class=\"arial-8\" name=\"medfoodtxt[$i]\" id=\"medfoodtxt_$i\" rows=4 cols=80 onFocus=\"this.select()\">\n"; 
            if (isset($_SESSION['medfoodtxt'][$i])) {
                echo $_SESSION['medfoodtxt'][$i];
            } else {
                echo "Please specify food(s):\nWhat happens when this food is ingested (i.e. hives/rash, nausea/vomiting, anaphylaxis)?";
            } ?>
            </textarea>
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10" class="arial-8">
            <? echo "<input type=\"checkbox\" id=\"medmed_$i\" name=\"medmed[$i]\" "; if (isset ($_SESSION["medmed"][$i])) echo "checked"; echo ">\n";
            echo "<label for=\"medmed_$i\">Medication allergy?</label>\n"; ?>
        <td style="width:3*" height="10">
            <? echo "<textarea class=\"arial-8\" name=\"medmedtxt[$i]\" id=\"medmedtxt_$i\" rows=4 cols=80 onFocus=\"this.select()\">\n";
            if (isset($_SESSION["medmedtxt"][$i])) {
                echo $_SESSION["medmedtxt"][$i];
            } else {
                echo "Please specify medication(s):\nWhat happens when this medication is taken?";
            } ?>
            </textarea>
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10" class="arial-8">
            <? echo "<input type=\"checkbox\" id=\"medallother_$i\" name=\"medallother[$i]\" "; if (isset ($_SESSION["medallother"][$i])) echo "checked"; echo ">\n";
            echo "<label for=\"medallother_$i\">Other allergy (i.e. bee stings)?</label>\n"; ?>
        <td style="width:3*" height="10">
            <? echo "<textarea class=\"arial-8\" name=\"medallothertxt[$i]\" id=\"medallothertxt_$i\" rows=4 cols=80 onFocus=\"this.select()\">\n";
            if (isset($_SESSION["medallothertxt"][$i])) {
                echo $_SESSION["medallothertxt"][$i];
            } else {
                echo "Please specify";
            } ?>
            </textarea>
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10" class="arial-8" colspan=2>
            <? echo "<input type=\"checkbox\" id=\"medlac_$i\" name=\"medlac[$i]\" "; if (isset ($_SESSION["medlac"][$i])) echo "checked"; echo ">\n";
            echo "<label for=\"medlac_$i\">Lactose intolerance?</label>\n"; ?>
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10" class="arial-8">
            <? echo "<input type=\"checkbox\" id=\"medadd_$i\" name=\"medadd[$i]\" "; if (isset ($_SESSION["medadd"][$i])) echo "checked"; echo ">\n";
            echo "<label for=\"medadd_$i\">ADD or ADHD?</label>\n"; ?>
        <td style="width:3*" height="10">
            <? echo "<textarea class=\"arial-8\" name=\"medaddtxt[$i]\" id=\"medaddtxt_$i\" rows=4 cols=80 onFocus=\"this.select()\">\n";
            if (isset($_SESSION["medaddtxt"][$i])) {
                echo $_SESSION["medaddtxt"][$i];
            } else {
                echo "Any special instructions?";
            } ?>
            </textarea>
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10" class="arial-8">
            <? echo "<input type=\"checkbox\" id=\"medasthma_$i\" name=\"medasthma[$i]\" "; if (isset ($_SESSION["medasthma"][$i])) echo "checked"; echo ">\n";
            echo "<label for=\"medasthma_$i\">Asthma?</label>\n"; ?>
        <td style="width:3*" height="10">
            <? echo "<textarea class=\"arial-8\" name=\"medasthmatxt[$i]\" id=\"medasthmatxt_$i\" rows=4 cols=80 onFocus=\"this.select()\">\n";
            if (isset($_SESSION["medasthmatxt"][$i])) {
                echo $_SESSION["medasthmatxt"][$i];
            } else {
                echo "Induced by:\nInhaler needed?:";
            } ?>
            </textarea>
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10" class="arial-8">
            <? echo "<input type=\"checkbox\" id=\"medbring_$i\" name=\"medbring[$i]\" "; if (isset ($_SESSION["medbring"][$i])) echo "checked"; echo ">\n";
            echo "<label for=\"medbring_$i\">Any medications that you will be bringing to VBS (i.e. EpiPen, Albuterol inhaler, Lactaid, Benadryl, Neosporin)?</label>\n"; ?>
        <td style="width:3*" height="10">
            <? echo "<textarea class=\"arial-8\" name=\"medbringtxt[$i]\" id=\"medbringtxt_$i\" rows=4 cols=80 onFocus=\"this.select()\">\n";
            if (isset($_SESSION["medbringtxt"][$i])) {
                echo $_SESSION["medbringtxt"][$i];
            } else {
                echo "Please list:\nAll medications will need to be brought to the health table in a sealable plastic bag- clearly labeled with name and instructions including indications for use.";
            } ?>
            </textarea>
    <tr bgcolor="#F0F4CC">
        <td style="width:1*" height="10" class="arial-8">
            <? echo "<input type=\"checkbox\" id=\"medother_$i\" name=\"medother[$i]\" "; if (isset ($_SESSION["medother"][$i])) echo "checked"; echo ">\n";
            echo "<label for=\"medother_$i\">Other concerns or comments?</label>\n"; ?>
        <td style="width:3*" height="10">
            <? echo "<textarea class=\"arial-8\" name=\"medothertxt[$i]\" id=\"medothertxt_$i\" rows=4 cols=80 onFocus=\"this.select()\">\n";
            if (isset($_SESSION["medothertxt"][$i])) {
                echo $_SESSION["medothertxt"][$i];
            } else {
                echo "Enter concerns";
            } ?>
            </textarea>
   </table>
<?
   }
?>
   <a name="last_child">

           <center>
           <hr width=50%><p>
           <p><INPUT TYPE="SUBMIT" name="AddChild" onClick="document.pressed=this.value" VALUE="Add Child">
           </center>

           <tr>
             <td align=center colspan=2><hr><p><p>
               <p><input type="SUBMIT" name="submit" onClick="document.pressed=this.value" value="Submit Registration"/>
               <p><input type="SUBMIT" name="reset" onClick="document.pressed=this.value" value="Reset Form"/>
           </tr>
         </table>
         </form>
       </div>
     </div>

       <!--div style="clear:both"></div-->   <!-- uncomment to fix draw problem on rounded footer box in Safari-->
     <div id="footer" width:1000px>
      <div id="footer_inner">
	     <p>&copy; EkklesiaSoft</p>
	 </div>
   </div>
</body>
</html>
