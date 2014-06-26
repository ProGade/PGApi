<?php
include('data.php');
ini_set('pcre.backtrack_limit', 10000000);
ini_set('pcre.recursion_limit', 10000000);
$oPGDocumentation->setNetworkMainData(array('sPath' => PG_API_PATH_PHP, 'sSubPathManualFiles' => 'resources/documentation/', 'sLanguage' => $_POST['sLanguage']));
echo $oPGDocumentation->networkSend();
?>