<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Sep 05 2012
*/

// http://www.php.net/manual/de/configuration.changes.modes.php
if (!defined('PHP_INI_USER')) {if (defined('INI_USER')) {define('PHP_INI_USER', INI_USER);} else {define('PHP_INI_USER', 1);}}
if (!defined('PHP_INI_PERDIR')) {if (defined('INI_PERDIR')) {define('PHP_INI_PERDIR', INI_PERDIR);} else {define('PHP_INI_PERDIR', 2);}}
if (!defined('PHP_INI_SYSTEM')) {if (defined('INI_SYSTEM')) {define('PHP_INI_SYSTEM', INI_SYSTEM);} else {define('PHP_INI_SYSTEM', 4);}}
if (!defined('PHP_INI_ALL')) {if (defined('INI_ALL')) {define('PHP_INI_ALL', INI_ALL);} else {define('PHP_INI_ALL', 7);}}

if (defined('INI_USER')) {define('PG_PHP_INI_RIGHTS_USER', INI_USER);} else {define('PG_PHP_INI_RIGHTS_USER', PHP_INI_USER);}
if (defined('INI_PERDIR')) {define('PG_PHP_INI_RIGHTS_PERDIR', INI_PERDIR);} else {define('PG_PHP_INI_RIGHTS_PERDIR', PHP_INI_PERDIR);}
if (defined('INI_SYSTEM')) {define('PG_PHP_INI_RIGHTS_SYSTEM', INI_SYSTEM);} else {define('PG_PHP_INI_RIGHTS_SYSTEM', PHP_INI_SYSTEM);}
if ((defined('INI_PERDIR')) && (defined('INI_SYSTEM'))) {define('PG_PHP_INI_RIGHTS_SYSTEM_AND_PERDIR', INI_PERDIR+INI_SYSTEM);}
else {define('PG_PHP_INI_RIGHTS_SYSTEM_AND_PERDIR', PHP_INI_PERDIR+PHP_INI_SYSTEM);}
if (defined('INI_ALL')) {define('PG_PHP_INI_RIGHTS_ALL', INI_ALL);} else {define('PG_PHP_INI_RIGHTS_ALL', PHP_INI_ALL);}

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_PhpIni extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	// ini_get(); // http://www.php.net/manual/de/function.ini-get.php
	// ini_set(); // http://www.php.net/manual/de/function.ini-set.php
	// ini_restore(); // http://www.php.net/manual/de/function.ini-restore.php
	// get_cfg_var(); // http://www.php.net/manual/de/function.get-cfg-var.php
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	public function buildRightsTables()
	{
		$_asHtml = array();
		$_asHtml['access'.PG_PHP_INI_RIGHTS_USER] = '';
		$_asHtml['access'.PG_PHP_INI_RIGHTS_PERDIR] = '';
		$_asHtml['access'.PG_PHP_INI_RIGHTS_SYSTEM] = '';
		$_asHtml['access'.PG_PHP_INI_RIGHTS_ALL] = '';
		$_asHtml['access'.PG_PHP_INI_RIGHTS_SYSTEM_AND_PERDIR] = '';
	
		$_asSettings = ini_get_all(null, true);
		foreach ($_asSettings as $_sName => $_axVariables)
		{
			$_asHtml['access'.$_axVariables['access']] .= '<tr>';
				$_asHtml['access'.$_axVariables['access']] .= '<td><b>'.$_sName.'</b></td>';
				$_asHtml['access'.$_axVariables['access']] .= '<td><b>Global</b></td><td>'.$_axVariables['global_value'].'</td>';
				$_asHtml['access'.$_axVariables['access']] .= '<td><b>Local</b></td><td>'.$_axVariables['local_value'].'</td>';
				// $_asHtml['access'.$_axVariables['access']] .= $_axVariables['access'];
			$_asHtml['access'.$_axVariables['access']] .= '</tr>';
		}
		
		$_sHtml = '';
		
		$_sHtml .= '<h2>&Uuml;berall setzbar</h2>';
		$_sHtml .= '<h3>(PG_PHP_INI_RIGHTS_ALL = '.PG_PHP_INI_RIGHTS_ALL.')</h3>';
		// $_sHtml .= '<i>Entry can be set global in php.ini or httpd.conf</i><br />';
		// $_sHtml .= '<i>Entry can be set per dir in php.ini, .htaccess or httpd.conf</i><br />';
		// $_sHtml .= '<i>Entry can be set in user scripts (like with ini_set()) or in the Windows registry</i><br />';
		$_sHtml .= '<i>Eintrag kann in der php.ini oder httpd.conf gesetzt werden</i><br />';
		$_sHtml .= '<i>Eintrag kann in der php.ini, .htaccess oder httpd.conf gesetzt werden</i><br />';
		$_sHtml .= '<i>Eintrag kann in Benutzerskripten (z.B. mittels ini_set()) oder in der Windows-Registry gesetzt werden</i><br />';
		$_sHtml .= '<table>'.$_asHtml['access'.PG_PHP_INI_RIGHTS_ALL].'</table>';
		
		$_sHtml .= '<h2>Per Script setzbar</h2>';
		$_sHtml .= '<h3>(PG_PHP_INI_RIGHTS_USER = '.PG_PHP_INI_RIGHTS_USER.')</h3>';
		// $_sHtml .= '<i>Entry can be set in user scripts (like with ini_set()) or in the Windows registry</i><br />';
		$_sHtml .= '<i>Eintrag kann in Benutzerskripten (z.B. mittels ini_set()) oder in der Windows-Registry gesetzt werden</i><br />';
		$_sHtml .= '<table>'.$_asHtml['access'.PG_PHP_INI_RIGHTS_USER].'</table>';
		
		$_sHtml .= '<h2>Global im System und per Verzeichnis setzbar</h2>';
		$_sHtml .= '<h3>(PG_PHP_INI_RIGHTS_PERDIR+PG_PHP_INI_RIGHTS_SYSTEM = '.PG_PHP_INI_RIGHTS_SYSTEM_AND_PERDIR.')</h3>';
		// $_sHtml .= '<i>Entry can be set per dir in php.ini, .htaccess or httpd.conf</i><br />';
		$_sHtml .= '<i>Eintrag kann in der php.ini, .htaccess oder httpd.conf gesetzt werden</i><br />';
		$_sHtml .= '<table>'.$_asHtml['access'.PG_PHP_INI_RIGHTS_SYSTEM_AND_PERDIR].'</table>';
		
		$_sHtml .= '<h2>In Verzeichnis setzbar</h2>';
		$_sHtml .= '<h3>(PG_PHP_INI_RIGHTS_PERDIR = '.PG_PHP_INI_RIGHTS_PERDIR.')</h3>';
		// $_sHtml .= '<i>Entry can be set per dir in php.ini, .htaccess or httpd.conf</i><br />';
		$_sHtml .= '<i>Eintrag kann in der php.ini, .htaccess oder httpd.conf gesetzt werden</i><br />';
		$_sHtml .= '<table>'.$_asHtml['access'.PG_PHP_INI_RIGHTS_PERDIR].'</table>';
		
		$_sHtml .= '<h2>Global im System setzbar</h2>';
		$_sHtml .= '<h3>(PG_PHP_INI_RIGHTS_SYSTEM = '.PG_PHP_INI_RIGHTS_SYSTEM.')</h3>';
		// $_sHtml .= '<i>Entry can be set global in php.ini or httpd.conf</i><br />';
		$_sHtml .= '<i>Eintrag kann in der php.ini oder httpd.conf gesetzt werden</i><br />';
		$_sHtml .= '<table>'.$_asHtml['access'.PG_PHP_INI_RIGHTS_SYSTEM].'</table>';
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGPhpIni = new classPG_PhpIni();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGPhpIni', 'xValue' => $oPGPhpIni));}
?>