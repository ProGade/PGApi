<?php
	include('../../../system/data.php');

	$oPGCssLoader->putHeader();
	
	$sBaseColorNormal = '#AAAAAA';
	if (isset($_GET['sColor'])) {$sBaseColorNormal = $_GET['sColor'];}
	if (isset($_GET['sColorNormal'])) {$sBaseColorNormal = $_GET['sColorNormal'];}
	$sStartColor1Normal = $oPGCss->addColorsToHex(array('xColor1' => $sBaseColorNormal, 'xColor2' => '#444444'));
	$sEndColor1Normal = $sBaseColorNormal;
	$sStartColor2Normal = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorNormal, 'xColor2' => '#222222'));
	$sEndColor2Normal = $sBaseColorNormal;
	
	$sBaseColorNormalHover = $sBaseColorNormal;
	if (isset($_GET['sColorNormalHover'])) {$sBaseColorNormalHover = $_GET['sColorNormalHover'];}
	$sStartColor1NormalHover = $oPGCss->addColorsToHex(array('xColor1' => $sBaseColorNormalHover, 'xColor2' => '#444444'));
	$sEndColor1NormalHover = $sBaseColorNormalHover;
	$sStartColor2NormalHover = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorNormalHover, 'xColor2' => '#222222'));
	$sEndColor2NormalHover = $sBaseColorNormalHover;

	$sBaseColorDown = $sBaseColorNormal;
	if (isset($_GET['sColorDown'])) {$sBaseColorDown = $_GET['sColorDown'];}
	else {$sBaseColorDown = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorDown, 'xColor2' => '#222222'));}
	$sStartColor1Down = $oPGCss->addColorsToHex(array('xColor1' => $sBaseColorDown, 'xColor2' => '#444444'));
	$sEndColor1Down = $sBaseColorDown;
	$sStartColor2Down = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorDown, 'xColor2' => '#222222'));
	$sEndColor2Down = $sBaseColorDown;
	
	$sBaseColorDownHover = $sBaseColorDown;
	if (isset($_GET['sColorDownHover'])) {$sBaseColorDownHover = $_GET['sColorDownHover'];}
	$sStartColor1DownHover = $oPGCss->addColorsToHex(array('xColor1' => $sBaseColorDownHover, 'xColor2' => '#444444'));
	$sEndColor1DownHover = $sBaseColorDownHover;
	$sStartColor2DownHover = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorDownHover, 'xColor2' => '#222222'));
	$sEndColor2DownHover = $sBaseColorDownHover;

	// Normal Buttons...
	echo '.pg_button_normal ';
	echo '{';
		echo 'background-color:'.$sBaseColorNormal.'; ';
		
		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColor1Normal)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColor2Normal)).'\'); ';
		echo 'background-image:-webkit-gradient(linear, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColor1Normal)).'), to('.$oPGCss->getHexColor(array('xColor' => $sStartColor2Normal)).')); ';
		echo 'background-image:-webkit-linear-gradient(top, '.$sStartColor1Normal.' 0, '.$sEndColor1Normal.' 50%, '.$sStartColor2Normal.' 50%, '.$sEndColor2Normal.' 100%); ';
		echo 'background-image:-moz-linear-gradient(top, '.$sStartColor1Normal.' 0, '.$sEndColor1Normal.' 50%, '.$sStartColor2Normal.' 50%, '.$sEndColor2Normal.' 100%); ';
		echo 'background-image:-ms-linear-gradient(top, '.$sStartColor1Normal.' 0, '.$sEndColor1Normal.' 50%, '.$sStartColor2Normal.' 50%, '.$sEndColor2Normal.' 100%); ';
		echo 'background-image:-o-linear-gradient(top, '.$sStartColor1Normal.' 0, '.$sEndColor1Normal.' 50%, '.$sStartColor2Normal.' 50%, '.$sEndColor2Normal.' 100%); ';
		echo 'background-image:linear-gradient(to bottom, '.$sStartColor1Normal.' 0, '.$sEndColor1Normal.' 50%, '.$sStartColor2Normal.' 50%, '.$sEndColor2Normal.' 100%); ';

		echo '-moz-box-shadow:0px 1px 3px rgba(0,0,0,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo '-webkit-box-shadow:0px 1px 3px rgba(0,0,0,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo 'box-shadow:0px 1px 3px rgba(0,0,0,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';

		echo 'border-radius:5px; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-shadow: 0 0 5px #ffffff, 0 0 5px #ffffff; '; 
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';

	echo '.pg_button_normal:hover ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorNormalHover.'; ';
		
		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColor1NormalHover)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColor2NormalHover)).'\'); ';
		echo 'background-image:-webkit-gradient(linear, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColor1NormalHover)).'), to('.$oPGCss->getHexColor(array('xColor' => $sStartColor2NormalHover)).')); ';
		echo 'background-image:-webkit-linear-gradient(top, '.$sStartColor1NormalHover.' 0, '.$sEndColor1NormalHover.' 50%, '.$sStartColor2NormalHover.' 50%, '.$sEndColor2NormalHover.' 100%); ';
		echo 'background-image:-moz-linear-gradient(top, '.$sStartColor1NormalHover.' 0, '.$sEndColor1NormalHover.' 50%, '.$sStartColor2NormalHover.' 50%, '.$sEndColor2NormalHover.' 100%); ';
		echo 'background-image:-ms-linear-gradient(top, '.$sStartColor1NormalHover.' 0, '.$sEndColor1NormalHover.' 50%, '.$sStartColor2NormalHover.' 50%, '.$sEndColor2NormalHover.' 100%); ';
		echo 'background-image:-o-linear-gradient(top, '.$sStartColor1NormalHover.' 0, '.$sEndColor1NormalHover.' 50%, '.$sStartColor2NormalHover.' 50%, '.$sEndColor2NormalHover.' 100%); ';
		echo 'background-image:linear-gradient(to bottom, '.$sStartColor1NormalHover.' 0, '.$sEndColor1NormalHover.' 50%, '.$sStartColor2NormalHover.' 50%, '.$sEndColor2NormalHover.' 100%); ';
		
		echo '-moz-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo '-webkit-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo 'box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';
		
		echo 'border-radius:5px; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-shadow: 0 0 5px #ffffff, 0 0 5px #ffffff; '; 
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';

	echo '.pg_button_down ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorDown.'; ';

		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColor1Down)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColor2Down)).'\'); ';
		echo 'background-image:-webkit-gradient(linear, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColor1Down)).'), to('.$oPGCss->getHexColor(array('xColor' => $sStartColor2Down)).')); ';
		echo 'background-image:-webkit-linear-gradient(top, '.$sStartColor1Down.' 0, '.$sEndColor1Down.' 50%, '.$sStartColor2Down.' 50%, '.$sEndColor2Down.' 100%); ';
		echo 'background-image:-moz-linear-gradient(top, '.$sStartColor1Down.' 0, '.$sEndColor1Down.' 50%, '.$sStartColor2Down.' 50%, '.$sEndColor2Down.' 100%); ';
		echo 'background-image:-ms-linear-gradient(top, '.$sStartColor1Down.' 0, '.$sEndColor1Down.' 50%, '.$sStartColor2Down.' 50%, '.$sEndColor2Down.' 100%); ';
		echo 'background-image:-o-linear-gradient(top, '.$sStartColor1Down.' 0, '.$sEndColor1Down.' 50%, '.$sStartColor2Down.' 50%, '.$sEndColor2Down.' 100%); ';
		echo 'background-image:linear-gradient(to bottom, '.$sStartColor1Down.' 0, '.$sEndColor1Down.' 50%, '.$sStartColor2Down.' 50%, '.$sEndColor2Down.' 100%); ';
		
		echo '-moz-box-shadow:inset 0px 0px 4px rgba(0,0,0,1); ';
		echo '-webkit-box-shadow:inset 0px 0px 4px rgba(0,0,0,1); ';
		echo 'box-shadow:inset 0px 0px 4px rgba(0,0,0,1); ';
		
		echo 'border-radius:5px; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-shadow: 0 0 5px #ffffff, 0 0 5px #ffffff; '; 
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';

	echo '.pg_button_down:hover ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorDownHover.'; ';

		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColor1DownHover)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColor2DownHover)).'\'); ';
		echo 'background-image:-webkit-gradient(linear, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColor1DownHover)).'), to('.$oPGCss->getHexColor(array('xColor' => $sStartColor2DownHover)).')); ';
		echo 'background-image:-webkit-linear-gradient(top, '.$sStartColor1DownHover.' 0, '.$sEndColor1DownHover.'); ';
		echo 'background-image:-moz-linear-gradient(top, '.$sStartColor1DownHover.' 0, '.$sEndColor1DownHover.' 50%, '.$sStartColor2DownHover.' 50%, '.$sEndColor2DownHover.' 100%); ';
		echo 'background-image:-ms-linear-gradient(top, '.$sStartColor1DownHover.' 0, '.$sEndColor1DownHover.' 50%, '.$sStartColor2DownHover.' 50%, '.$sEndColor2DownHover.' 100%); ';
		echo 'background-image:-o-linear-gradient(top, '.$sStartColor1DownHover.' 0, '.$sEndColor1DownHover.' 50%, '.$sStartColor2DownHover.' 50%, '.$sEndColor2DownHover.' 100%); ';
		echo 'background-image:linear-gradient(to bottom, '.$sStartColor1DownHover.' 0, '.$sEndColor1DownHover.' 50%, '.$sStartColor2DownHover.' 50%, '.$sEndColor2DownHover.' 100%); ';
		
		echo '-moz-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		echo '-webkit-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		echo 'box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		
		echo 'border-radius:5px; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-shadow: 0 0 5px #ffffff, 0 0 5px #ffffff; '; 
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
	
	// Rounded Buttons...
	echo '.pg_button_rounded_normal ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorNormal.'; ';
		
		echo 'background-image:-webkit-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo '-webkit-radial-gradient(50% 90%, circle cover, '.$sStartColor1Normal.', '.$sStartColor2Normal.'); ';

		echo 'background-image:-moz-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo '-moz-radial-gradient(50% 90%, circle cover, '.$sStartColor1Normal.', '.$sStartColor2Normal.'); ';

		echo 'background-image:-ms-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo '-ms-radial-gradient(50% 90%, circle cover, '.$sStartColor1Normal.', '.$sStartColor2Normal.'); ';

		echo 'background-image:-o-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo '-o-radial-gradient(50% 90%, circle cover, '.$sStartColor1Normal.', '.$sStartColor2Normal.'); ';

		echo 'background-image:radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo 'radial-gradient(50% 90%, circle cover, '.$sStartColor1Normal.', '.$sStartColor2Normal.'); ';

		echo '-moz-box-shadow:0px 1px 3px rgba(0,0,0,0.5), inset 0px 0px 3px rgba(0,0,0,1); ';
		echo '-webkit-box-shadow:0px 1px 3px rgba(0,0,0,0.5), inset 0px 0px 3px rgba(0,0,0,1); ';
		echo 'box-shadow:0px 1px 3px rgba(0,0,0,0.5), inset 0px 0px 3px rgba(0,0,0,1); ';
		
		echo 'border-radius:50%; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-shadow: 0 0 5px #ffffff, 0 0 5px #ffffff; '; 
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
	
	echo '.pg_button_rounded_normal:hover ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorNormalHover.'; ';
		
		echo 'background-image:-webkit-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo '-webkit-radial-gradient(50% 90%, circle cover, '.$sStartColor1NormalHover.', '.$sStartColor2NormalHover.'); ';

		echo 'background-image:-moz-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo '-moz-radial-gradient(50% 90%, circle cover, '.$sStartColor1NormalHover.', '.$sStartColor2NormalHover.'); ';

		echo 'background-image:-ms-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo '-ms-radial-gradient(50% 90%, circle cover, '.$sStartColor1NormalHover.', '.$sStartColor2NormalHover.'); ';

		echo 'background-image:-o-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo '-o-radial-gradient(50% 90%, circle cover, '.$sStartColor1NormalHover.', '.$sStartColor2NormalHover.'); ';

		echo 'background-image:radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,1.0) 0, rgba(255,255,255,0.5) 70%, rgba(0,0,0,0) 70%), ';
		echo 'radial-gradient(50% 90%, circle cover, '.$sStartColor1NormalHover.', '.$sStartColor2NormalHover.'); ';

		echo '-moz-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		echo '-webkit-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		echo 'box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		
		echo 'border-radius:50%; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-shadow: 0 0 5px #ffffff, 0 0 5px #ffffff; '; 
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
	
	echo '.pg_button_rounded_down ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorDown.'; ';
		
		echo 'background-image:-webkit-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo '-webkit-radial-gradient(50% 90%, circle cover, '.$sStartColor1Down.', '.$sStartColor2Down.'); ';

		echo 'background-image:-moz-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo '-moz-radial-gradient(50% 90%, circle cover, '.$sStartColor1Down.', '.$sStartColor2Down.'); ';

		echo 'background-image:-ms-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo '-ms-radial-gradient(50% 90%, circle cover, '.$sStartColor1Down.', '.$sStartColor2Down.'); ';

		echo 'background-image:-o-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo '-o-radial-gradient(50% 90%, circle cover, '.$sStartColor1Down.', '.$sStartColor2Down.'); ';

		echo 'background-image:radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo 'radial-gradient(50% 90%, circle cover, '.$sStartColor1Down.', '.$sStartColor2Down.'); ';

		echo '-moz-box-shadow:inset 0px 0px 4px rgba(0,0,0,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		echo '-webkit-box-shadow:inset 0px 0px 4px rgba(0,0,0,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		echo 'box-shadow:inset 0px 0px 4px rgba(0,0,0,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		
		echo 'border-radius:50%; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-shadow: 0 0 5px #ffffff, 0 0 5px #ffffff; '; 
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
	
	echo '.pg_button_rounded_down:hover ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorDownHover.'; ';
		
		echo 'background-image:-webkit-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo '-webkit-radial-gradient(50% 90%, circle cover, '.$sStartColor1DownHover.', '.$sStartColor2DownHover.'); ';

		echo 'background-image:-moz-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo '-moz-radial-gradient(50% 90%, circle cover, '.$sStartColor1DownHover.', '.$sStartColor2DownHover.'); ';

		echo 'background-image:-ms-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo '-ms-radial-gradient(50% 90%, circle cover, '.$sStartColor1DownHover.', '.$sStartColor2DownHover.'); ';

		echo 'background-image:-o-radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo '-o-radial-gradient(50% 90%, circle cover, '.$sStartColor1DownHover.', '.$sStartColor2DownHover.'); ';

		echo 'background-image:radial-gradient(50% 25%, ellipse contain, rgba(255,255,255,0.6) 0, rgba(255,255,255,0.3) 70%, rgba(0,0,0,0) 70%), ';
		echo 'radial-gradient(50% 90%, circle cover, '.$sStartColor1DownHover.', '.$sStartColor2DownHover.'); ';

		echo '-moz-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		echo '-webkit-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		echo 'box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(0,0,0,1), inset 0px 0px 4px rgba(0,0,0,1); ';
		
		echo 'border-radius:50%; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-shadow: 0 0 5px #ffffff, 0 0 5px #ffffff; '; 
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
?>