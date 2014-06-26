<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 20 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Zip extends classPG_ClassBasics
{
	// TODO
	/* @start method */
	public function build()
	{
		$oZip = new ZipArchive();
		$filename = "./test112.zip";
		
		if ($oZip->open($filename, ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		
		$oZip->addFromString("testfilephp.txt" . time(), "#1 This is a test string added as testfilephp.txt.\n");
		$oZip->addFromString("testfilephp2.txt" . time(), "#2 This is a test string added as testfilephp2.txt.\n");
		$oZip->addFile($thisdir . "/too.php","/testfromfile.php");
		echo "numfiles: " . $oZip->numFiles . "\n";
		echo "status:" . $oZip->status . "\n";
		$oZip->close();
	}
	/* @end method */
}
/* @end class */
$oPGZip = new classPG_Zip();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGZip', 'xValue' => $oPGZip));}
?>