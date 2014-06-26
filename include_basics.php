<?php
if (isset($oPGPhpLoader))
{
	if (!defined('PG_API_PATH_PHP')) {define(PG_API_PATH_PHP, '');}
	$oPGPhpLoader->setFilesPath(array('sPath' => PG_API_PATH_PHP));
	$oPGPhpLoader->setFiles(
		array('asFiles' =>
			array(
				'system/api.php',
				'system/vars.php',
				'system/arrays.php',
				'system/strings.php',
				'system/browser.php',
				'system/random.php',

				'css/css.php'
			)
		)
	);
}

if (isset($oPGJsLoader))
{
	$oPGJsLoader->useIncludes(true);
	if (defined('PG_API_PATH_JS')) {$oPGJsLoader->setFilesPath(array('sPath' => PG_API_PATH_JS));}
	$oPGJsLoader->addFiles(
		array('asFiles' => 
			array(
				'system/classbasics.js',
				'system/api.js',
				'system/vars.js',
				'system/arrays.js',
				'system/strings.js',
				'system/nodes.js',	
				'system/browser.js',
				'system/random.js',
				'system/objects.js',
				
				'css/css.js',

				'prototype/prototypes.js'
			)
		)
	);
}
?>