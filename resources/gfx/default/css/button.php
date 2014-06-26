<?php
	include('../../../system/data.php');

	$oPGCssLoader->putHeader();
	
	$sBaseColorNormal = '#CCCCCC';
	if (isset($_GET['sColor'])) {$sBaseColorNormal = $_GET['sColor'];}
	if (isset($_GET['sColorNormal'])) {$sBaseColorNormal = $_GET['sColorNormal'];}
	$sStartColorNormal = $oPGCss->addColorsToHex(array('xColor1' => $sBaseColorNormal, 'xColor2' => '#222222'));
	$sEndColorNormal = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorNormal, 'xColor2' => '#222222'));
	
	$sBaseColorNormalHover = $sBaseColorNormal;
	if (isset($_GET['sColorNormalHover'])) {$sBaseColorNormalHover = $_GET['sColorNormalHover'];}
	$sStartColorNormalHover = $oPGCss->addColorsToHex(array('xColor1' => $sBaseColorNormalHover, 'xColor2' => '#222222'));
	$sEndColorNormalHover = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorNormalHover, 'xColor2' => '#222222'));

	$sBaseColorDown = $sBaseColorNormal;
	if (isset($_GET['sColorDown'])) {$sBaseColorDown = $_GET['sColorDown'];}
	else {$sBaseColorDown = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorDown, 'xColor2' => '#222222'));}
	$sStartColorDown = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorDown, 'xColor2' => '#222222'));
	$sEndColorDown = $oPGCss->addColorsToHex(array('xColor1' => $sBaseColorDown, 'xColor2' => '#222222'));
	
	$sBaseColorDownHover = $sBaseColorDown;
	if (isset($_GET['sColorDownHover'])) {$sBaseColorDownHover = $_GET['sColorDownHover'];}
	$sStartColorDownHover = $oPGCss->subColorsToHex(array('xColor1' => $sBaseColorDownHover, 'xColor2' => '#222222'));
	$sEndColorDownHover = $oPGCss->addColorsToHex(array('xColor1' => $sBaseColorDownHover, 'xColor2' => '#222222'));

	echo '.pg_button_normal ';
	echo '{';
		echo 'background-color:'.$sBaseColorNormal.'; ';
		
		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColorNormal)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sEndColorNormal)).'\'); ';
		echo 'background-image:-webkit-gradient(linear, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColorNormal)).'), to('.$oPGCss->getHexColor(array('xColor' => $sEndColorNormal)).')); ';
		echo 'background-image:-webkit-linear-gradient(top, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';
		echo 'background-image:-moz-linear-gradient(top, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';
		echo 'background-image:-ms-linear-gradient(top, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';
		echo 'background-image:-o-linear-gradient(top, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';
		echo 'background-image:linear-gradient(to bottom, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';

		echo '-moz-box-shadow:0px 1px 3px rgba(000,000,000,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo '-webkit-box-shadow:0px 1px 3px rgba(000,000,000,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo 'box-shadow:0px 1px 3px rgba(000,000,000,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';

		echo 'border-radius:5px; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';

	echo '.pg_button_normal:hover ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorNormalHover.'; ';
		
		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColorNormalHover)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sEndColorNormalHover)).'\'); ';
		echo 'background-image:-webkit-gradient(linear, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColorNormalHover)).'), to('.$oPGCss->getHexColor(array('xColor' => $sEndColorNormalHover)).')); ';
		echo 'background-image:-webkit-linear-gradient(top, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		echo 'background-image:-moz-linear-gradient(top, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		echo 'background-image:-ms-linear-gradient(top, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		echo 'background-image:-o-linear-gradient(top, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		echo 'background-image:linear-gradient(to bottom, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		
		echo '-moz-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo '-webkit-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo 'box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';
		
		echo 'border-radius:5px; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';

	echo '.pg_button_down ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorDown.'; ';

		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColorDown)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sEndColorDown)).'\'); ';
		echo 'background-image:-webkit-gradient(linear, left top, left bottom, from('.$sStartColorDown.'), to('.$sEndColorDown.')); ';
		echo 'background-image:-webkit-linear-gradient(top, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		echo 'background-image:-moz-linear-gradient(top, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		echo 'background-image:-ms-linear-gradient(top, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		echo 'background-image:-o-linear-gradient(top, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		echo 'background-image:linear-gradient(to bottom, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		
		echo '-moz-box-shadow:inset 0px 0px 4px rgba(000,000,000,1); ';
		echo '-webkit-box-shadow:inset 0px 0px 4px rgba(000,000,000,1); ';
		echo 'box-shadow:inset 0px 0px 4px rgba(000,000,000,1); ';
		
		echo 'border-radius:5px; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';

	echo '.pg_button_down:hover ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorDownHover.'; ';

		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColorDownHover)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sEndColorDownHover)).'\'); ';
		echo 'background-image:-webkit-gradient(linear, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColorDownHover)).'), to('.$oPGCss->getHexColor(array('xColor' => $sEndColorDownHover)).')); ';
		echo 'background-image:-webkit-linear-gradient(top, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		echo 'background-image:-moz-linear-gradient(top, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		echo 'background-image:-ms-linear-gradient(top, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		echo 'background-image:-o-linear-gradient(top, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		echo 'background-image:linear-gradient(to bottom, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		
		echo '-moz-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(000,000,000,1); ';
		echo '-webkit-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(000,000,000,1); ';
		echo 'box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(000,000,000,1); ';
		
		echo 'border-radius:5px; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
	
	// Rounded Buttons...
	echo '.pg_button_rounded_normal ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorNormal.'; ';

		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColorNormal)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sEndColorNormal)).'\'); ';
		echo 'background-image:-webkit-gradient(radial, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColorNormal)).'), to('.$oPGCss->getHexColor(array('xColor' => $sEndColorNormal)).')); ';
		echo 'background-image:-webkit-radial-gradient(top, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';
		echo 'background-image:-moz-radial-gradient(top, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';
		echo 'background-image:-ms-radial-gradient(top, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';
		echo 'background-image:-o-radial-gradient(top, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';
		echo 'background-image:radial-gradient(to bottom, '.$sStartColorNormal.', '.$sEndColorNormal.'); ';

		echo '-moz-box-shadow:0px 1px 3px rgba(000,000,000,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo '-webkit-box-shadow:0px 1px 3px rgba(000,000,000,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo 'box-shadow:0px 1px 3px rgba(000,000,000,0.5), inset 0px 0px 3px rgba(255,255,255,1); ';

		echo 'border-radius:50%; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
	
	echo '.pg_button_rounded_normal:hover ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorNormalHover.'; ';
		
		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColorNormalHover)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sEndColorNormalHover)).'\'); ';
		echo 'background-image:-webkit-gradient(radial, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColorNormalHover)).'), to('.$oPGCss->getHexColor(array('xColor' => $sEndColorNormalHover)).')); ';
		echo 'background-image:-webkit-radial-gradient(top, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		echo 'background-image:-moz-radial-gradient(top, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		echo 'background-image:-ms-radial-gradient(top, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		echo 'background-image:-o-radial-gradient(top, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		echo 'background-image:radial-gradient(to bottom, '.$sStartColorNormalHover.', '.$sEndColorNormalHover.'); ';
		
		echo '-moz-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo '-webkit-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';
		echo 'box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 3px rgba(255,255,255,1); ';

		echo 'border-radius:50%; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
	
	echo '.pg_button_rounded_down ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorDown.'; ';

		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColorDown)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sEndColorDown)).'\'); ';
		echo 'background-image:-webkit-gradient(radial, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColorDown)).'), to('.$oPGCss->getHexColor(array('xColor' => $sEndColorDown)).')); ';
		echo 'background-image:-webkit-radial-gradient(top, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		echo 'background-image:-moz-radial-gradient(top, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		echo 'background-image:-ms-radial-gradient(top, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		echo 'background-image:-o-radial-gradient(top, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		echo 'background-image:radial-gradient(to bottom, '.$sStartColorDown.', '.$sEndColorDown.'); ';
		
		echo '-moz-box-shadow:inset 0px 0px 4px rgba(000,000,000,1); ';
		echo '-webkit-box-shadow:inset 0px 0px 4px rgba(000,000,000,1); ';
		echo 'box-shadow:inset 0px 0px 4px rgba(000,000,000,1); ';

		echo 'border-radius:50%; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
	
	echo '.pg_button_rounded_down:hover ';
	echo '{ ';
		echo 'background-color:'.$sBaseColorDownHover.'; ';

		echo 'filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sStartColorDownHover)).'\', endColorstr=\''.$oPGCss->getHexColor(array('xColor' => $sEndColorDownHover)).'\'); ';
		echo 'background-image:-webkit-gradient(radial, left top, left bottom, from('.$oPGCss->getHexColor(array('xColor' => $sStartColorDownHover)).'), to('.$oPGCss->getHexColor(array('xColor' => $sEndColorDownHover)).')); ';
		echo 'background-image:-webkit-radial-gradient(top, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		echo 'background-image:-moz-radial-gradient(top, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		echo 'background-image:-ms-radial-gradient(top, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		echo 'background-image:-o-radial-gradient(top, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		echo 'background-image:radial-gradient(to bottom, '.$sStartColorDownHover.', '.$sEndColorDownHover.'); ';
		
		echo '-moz-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(000,000,000,1); ';
		echo '-webkit-box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(000,000,000,1); ';
		echo 'box-shadow:0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), 0px 0px 5px rgba(255,255,255,1), inset 0px 0px 4px rgba(000,000,000,1); ';

		echo 'border-radius:50%; ';
		echo 'border:solid 1px #000000; ';
		
		echo 'text-align:center; ';
		echo 'vertical-align:middle; ';
		echo 'cursor:default; ';
	echo '} ';
?>