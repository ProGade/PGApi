<?php
require('data.php');
$sHtml = '';
$sHtml .= '<a href="documentation.php" target="_self">Documentation</a>';
echo $oPGWebsite->build(array('xTemplate' => $sHtml));
?>