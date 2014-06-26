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
				'system/objects.php',
				'system/strings.php',
				'system/functions.php',
				'system/urls.php',
				'system/browser.php',
				'system/random.php',
				'system/curl.php',
				'system/date.php',
				'system/sessionvars.php',
				'system/registervars.php',
				'system/eventmanager.php',
				
				'css/css.php',
				
				'website/template.php',

				'xml/xmlwrite.php',
				'xml/xmlread.php',
				'xml/rss.php',
				
				'network/websockets.php',
				'network/network.php',

				'database/mssql.php',
				'database/mysql.php',
				'database/mysqlstatements.php',
				'database/mongo.php',
				'database/database.php',
				'database/databaseupdate.php',

				'user/login.php',
				'user/rights.php',
				'user/users.php',
				'user/usergroups.php',
				
				'graphics/gfx.php',
				'graphics/canvas.php',
				'graphics/sprite.php',
				'graphics/sprites.php',
				'graphics/captcha.php',

				'controls/breadcrumb.php',
				'controls/button.php',
				'controls/calendarsheet.php',
				'controls/checkbox.php',
				'controls/codeeditor.php',
				'controls/colorpicker.php',
				'controls/controls.php',
				'controls/draganddrop.php',
				'controls/dragelement.php',
				'controls/droparea.php',
				'controls/form.php',
				'controls/frame.php',
				'controls/frameset.php',
				'controls/infobubble.php',
				'controls/inputfield.php',
				'controls/menu.php',
				'controls/pagecontrol.php',
				'controls/popup.php',
				'controls/progressbar.php',
				'controls/slider.php',
				'controls/tabs.php',
				'controls/textarea.php',
				'controls/videoplayer.php',
				'controls/wysiwyg.php',
				
				'cryption/cryption.php',
				
				'debug/debugconsole.php',
				'debug/logs.php',
				'debug/useractionlog.php',
				
				'documentation/documentation.php',
				'documentation/docuparser.php',
				
				'filesystem/download.php',
				'filesystem/filesystem.php',
				'filesystem/folderupdate.php',
				'filesystem/upload.php',
				
				'html/divs.php',
				'html/imgs.php',
				
				/*
				'interfaces/calendar/icalendar.php',
				'interfaces/delicious/deliciousshare.php',
				'interfaces/facebook/facebook.php',
				'interfaces/facebook/facebookfanbox.php',
				'interfaces/facebook/facebooklike.php',
				'interfaces/facebook/facebooklogin.php',
				'interfaces/facebook/facebookmeta.php',
				'interfaces/facebook/facebookshare.php',
				'interfaces/google/google.php',
				'interfaces/google/googlelogin.php',
				'interfaces/google/googlepluslike.php',
				'interfaces/linkedin/linkedinshare.php',
				'interfaces/myspace/myspaceshare.php',
				'interfaces/twitter/twittershare.php',
				'interfaces/vz/vzshare.php',
				'interfaces/youtube/youtubeplayer.php',
				*/
				
				'mail/mail.php',
				'mail/mailshare.php',
				'mail/mailupload.php',
				'mail/imap.php',
				
				/*
				'modules/codeconverter/codeconverter.php',
				'modules/faq/faq.php',
				'modules/gallery/gallery.php',
				'modules/messages/privatemessages.php',
				'modules/share/share.php',
				*/
				
				'parse/codeparser.php',
				
				'php/phpini.php',
				
				// 'payment/paypal/paypalexpresscheckout.php',
				
				'update/update.php',
				
				'website/meta.php',
				'website/opengraph.php',
				'website/website.php'
			)
		)
	);
}

if (isset($oPGJsLoader))
{
	$oPGJsLoader->useIncludes(array('bUse' => true));
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
				'system/date.js',
				'system/objects.js',
				'system/eventmanager.js',
				'system/selection.js',

				'css/css.js',
				'css/cssloader.js',
				
				'graphics/gfx.js',
				'graphics/canvas.js',
				'graphics/sprite.js',
				'graphics/sprites.js',
				'graphics/captcha.js',

				'network/ajax.js',
				'network/network.js',
				'network/websockets.js',
				
				'controls/breadcrumb.js',
				'controls/button.js',
				'controls/calendarsheet.js',
				'controls/checkbox.js',
				'controls/codeeditor.js',
				'controls/colorpicker.js',
				'controls/contextmenu.js',
				'controls/controls.js',
				'controls/draganddrop.js',
				'controls/dragelement.js',
				'controls/droparea.js',
				'controls/form.js',
				'controls/frame.js',
				'controls/frameset.js',
				'controls/infobubble.js',
				'controls/inputfield.js',
				'controls/popup.js',
				'controls/progressbar.js',
				'controls/slider.js',
				'controls/tabs.js',
				'controls/textarea.js',
				'controls/videoplayer.js',
				'controls/wysiwyg.js',
				
				'database/databaseupdate.js',
				
				'user/login.js',
				
				'debug/debugconsole.js',
				'debug/vardebug.js',
				
				'documentation/documentation.js',
				'documentation/docuparser.js',
				
				'filesystem/folderupdate.js',
				'filesystem/upload.js',			
				
				'html/divs.js',
				'html/imgs.js',
				
				'input/input.js',
				'input/keyhandler.js',
				'input/mouse.js',
				'input/touchhandler.js',
				
				'parse/codehighlighter.js',
				'parse/codeparser.js',

				/*
				'interfaces/facebook/facebook.js',
				'interfaces/facebook/facebooklogin.js',
				'interfaces/google/google.js',
				'interfaces/myspace/myspaceshare.js',
				
				'modules/faq/faq.js',
				'modules/gallery/gallery.js',
				'modules/messages/privatemessages.js',
				*/
				
				'update/update.js',
				
				'xml/xmlwrite.js',
				'xml/xmlread.js',

				'prototype/prototypes.js',
				/*'prototype/arrayprototypes.js',
				'prototype/functionprototypes.js',
				'prototype/numberprototypes.js',
				'prototype/objectprototypes.js',
				'prototype/stringprototypes.js'*/
			)
		)
	);
}
?>