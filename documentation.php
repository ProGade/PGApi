<?php
include('data.php');

$oPGGfx->setGfxBasePath(array('sPath' => 'resources/gfx/default/'));
$oPGGfx->setGfxPath(array('sPath' => 'resources/gfx/glossy/'));

$oPGWebsite->setCssFiles(
	array(
		'asFiles' => array(
			'main.css',
			'documentation.css',
			'debugconsole.css',
			'button.css'
		)
	)
);

$oPGWebsite->setJavaScriptPath(array('sPath' => ''));
$oPGWebsite->setJavaScriptFiles(
	array(
		'asFiles' => array(
			'documentation.js'
		)
	)
);
if ($sLanguage != '')
{
	$oPGWebsite->setJavaScriptCode(array('sCode' => 'oPGDocumentation.setLanguage({"sLanguage": "'.$sLanguage.'"});'));
}

$oPGDocumentation->useDatabase(array('bUse' => false));
$oPGDocumentation->addMenuPoint(array('sName' => 'Start', 'sFile' => 'start.php', 'sType' => 'file', 'axSubMenu' => NULL));

$axSubMenu = array();
$axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Quickstart', 'sFile' => 'quickstart.php', 'sType' => 'file', 'axSubMenu' => NULL));
$axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Basics', 'sFile' => 'basics.php', 'sType' => 'file', 'axSubMenu' => NULL));
$axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Controls', 'sFile' => 'controls.php', 'sType' => 'file', 'axSubMenu' => NULL));
// $axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Templates', 'sFile' => 'templates.php', 'sType' => 'file', 'axSubMenu' => NULL));
// $axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Frameset', 'sFile' => 'frameset.php', 'sType' => 'file', 'axSubMenu' => NULL));
$axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Login System', 'sFile' => 'login_system.php', 'sType' => 'file', 'axSubMenu' => NULL));
// $axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Rights', 'sFile' => 'rights.php', 'sType' => 'file', 'axSubMenu' => NULL));
// $axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Network', 'sFile' => 'network.php', 'sType' => 'file', 'axSubMenu' => NULL));
// $axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Update', 'sFile' => 'update.php', 'sType' => 'file', 'axSubMenu' => NULL));
// $axSubMenu[] = $oPGDocumentation->buildSubMenuPointStructure(array('sName' => 'Database', 'sFile' => 'database.php', 'sType' => 'file', 'axSubMenu' => NULL));
$oPGDocumentation->addMenuPoint(array('sName' => 'Getting Started', 'sFile' => 'getting_started.php', 'sType' => 'folder', 'axSubMenu' => $axSubMenu));

// $axSubMenu = array();
// $oPGDocumentation->addMenuPoint(array('sName' => 'User Manual', 'sType' => 'folder', 'axSubMenu' => $axSubMenu));

$sTemplate = $oPGDocumentation->build(array('sPath' => PG_API_PATH_PHP));
echo $oPGWebsite->build(array('xTemplate' => $sTemplate));
?>