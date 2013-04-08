<?php

// Not hooked to anything, access for now by going to:
// localhost/whm_fsts/application/whm/controller/CreateExcel.php

// Functions for creating the excel document

function xlsBOF() //Beginning of File
{ 
    echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);  
    return; 
} 

function xlsEOF()  //End of File
{ 
    echo pack("ss", 0x0A, 0x00); 
    return; 
} 

function xlsWriteNumber($Row, $Col, $Value) //Writing a -NUMBER- to a box
{ 
    echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
    echo pack("d", $Value); 
    return; 
} 

function xlsWriteLabel($Row, $Col, $Value ) //Writing a -LABEL- to a box
{ 
    $L = strlen($Value); 
    echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
    echo $Value; 
	return; 
}

////////////////////////////////////////////

	//Retrieve data here
 
  

	// Send Header
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");;
	header("Content-Disposition: attachment;filename=test.xls "); // Test.xls is temporary, we can put the date and type of report instead
	header("Content-Transfer-Encoding: binary ");

    // XLS Data Cell

	//BEGIN
	xlsBOF();   
	//WRITE DATA
	xlsWriteLabel(1,0,"Test1");
	xlsWriteLabel(2,0,"Test2");
	xlsWriteNumber(2,1,"12");

	 //END
	 xlsEOF();
	 exit();
	 
?>