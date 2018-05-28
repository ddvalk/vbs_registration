<?php
include ("../connections.php");

// Connect database.
$connection = @mysql_connect($hostname, $dbusername,$dbpassword) or die(mysql_error());
$db = @mysql_select_db($db_name,$connection) or die(mysql_error());

// Get data records from table.
$result=mysql_query("select * from $table_name order by id asc");



// Functions for export to excel.
function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}
function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}
function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}
function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=EkklesiaSoft.xls ");
header("Content-Transfer-Encoding: binary ");

xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"EkklesiaSoft VBS Registration");

// Make column labels. (at line 3)
xlsWriteLabel(2,0,"ID #");
xlsWriteLabel(2,1,"CF Name");
xlsWriteLabel(2,2,"CL Name");
xlsWriteLabel(2,3,"BDayM");
xlsWriteLabel(2,4,"BDayD");
xlsWriteLabel(2,5,"BDayY");
xlsWriteLabel(2,6,"Grade");
xlsWriteLabel(2,7,"School");
xlsWriteLabel(2,8,"Lang");
xlsWriteLabel(2,9,"MName");
xlsWriteLabel(2,10,"MHPhone");
xlsWriteLabel(2,11,"MCPhone");
xlsWriteLabel(2,12,"FName");
xlsWriteLabel(2,13,"FHPhone");
xlsWriteLabel(2,14,"FCPhone");
xlsWriteLabel(2,15,"Addy1");
xlsWriteLabel(2,16,"Addy2");
xlsWriteLabel(2,17,"City");
xlsWriteLabel(2,18,"State");
xlsWriteLabel(2,19,"Zip");
xlsWriteLabel(2,20,"E-Mail");
xlsWriteLabel(2,21,"ChurchYN");
xlsWriteLabel(2,22,"Church");
xlsWriteLabel(2,23,"Hear");
xlsWriteLabel(2,24,"Meds");
xlsWriteLabel(2,25,"Com");
xlsWriteLabel(2,26,"HearTxt");
xlsWriteLabel(2,27,"Siblings");
xlsWriteLabel(2,28,"Group");
xlsWriteLabel(2,29,"Age");


$xlsRow = 4;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){

xlsWriteNumber($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,1,$row['cfname']);
xlsWriteLabel($xlsRow,2,$row['clname']);
xlsWriteLabel($xlsRow,3,$row['bdmon']);
xlsWriteLabel($xlsRow,4,$row['bdday']);
xlsWriteLabel($xlsRow,5,$row['bdyear']);
xlsWriteLabel($xlsRow,6,$row['grade']);
xlsWriteLabel($xlsRow,7,$row['school']);
xlsWriteLabel($xlsRow,8,$row['lang']);
xlsWriteLabel($xlsRow,9,$row['mname']);
xlsWriteLabel($xlsRow,10,$row['mhphone']);
xlsWriteLabel($xlsRow,11,$row['mcphone']);
xlsWriteLabel($xlsRow,12,$row['fname']);
xlsWriteLabel($xlsRow,13,$row['fhphone']);
xlsWriteLabel($xlsRow,14,$row['fcphone']);
xlsWriteLabel($xlsRow,15,$row['addy1']);
xlsWriteLabel($xlsRow,16,$row['addy2']);
xlsWriteLabel($xlsRow,17,$row['city']);
xlsWriteLabel($xlsRow,18,$row['state']);
xlsWriteLabel($xlsRow,19,$row['zip']);
xlsWriteLabel($xlsRow,20,$row['email']);
xlsWriteLabel($xlsRow,21,$row['churchyn']);
xlsWriteLabel($xlsRow,22,$row['church']);
xlsWriteLabel($xlsRow,23,$row['hear']);
xlsWriteLabel($xlsRow,24,$row['med']);
xlsWriteLabel($xlsRow,25,$row['com']);
xlsWriteLabel($xlsRow,26,$row['hear_txt']);
xlsWriteLabel($xlsRow,27,$row['sibling']);
xlsWriteLabel($xlsRow,28,$row['group']);

date_default_timezone_set('America/Los_Angeles');
$birthtime = strtotime( "$row[bdmon]"."/"."$row[bdday]"."/"."$row[bdyear]" );
$age = floor ( (time() - $birthtime) / (60*60*24*365.25));

xlsWriteLabel($xlsRow,29,$age);

$xlsRow++;
}
xlsEOF();
exit();
?>