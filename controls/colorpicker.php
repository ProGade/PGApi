<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
define('PG_COLORPICKER_TYPE_SIMPLE', 'SimpleColorBars');
define('PG_COLORPICKER_TYPE_SINGLECOLOR', 'SingleColorRect');
define('PG_COLORPICKER_TYPE_MULTICOLOR', 'MultiColorRect');

class classPG_ColorPicker extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGColorPicker'));
	}
	
	// Methods...
	public function calculateColor($_iColor, $_iStep, $_dMultiply) {return min((int)(($_iStep*$_dMultiply)+$_iColor), 255);}
	
	public function calculateColors($_aiColor, $_iStep, $_dMultiply)
	{
		return array(
			'iRed' => $this->calculateColor($_iColor = $_aiColor['iRed'], $_iStep, $_dMultiply),
			'iGreen' => $this->calculateColor($_iColor = $_aiColor['iGreen'], $_iStep, $_dMultiply),
			'iBlue' => $this->calculateColor($_iColor = $_aiColor['iBlue'], $_iStep, $_dMultiply)
		);
	}
	
	public function buildColor($_sPickerID, $_iRed = NULL, $_iGreen = NULL, $_iBlue = NULL, $_iSizeX = NULL, $_iSizeY = NULL)
	{
		global $oPGGfx;

		$_iRed = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iRed', 'xParameter' => $_iRed));
		$_iGreen = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iGreen', 'xParameter' => $_iGreen));
		$_iBlue = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iBlue', 'xParameter' => $_iBlue));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_sPickerID = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sPickerID', 'xParameter' => $_sPickerID));

		$_sHtml = '';
		$_sHtml .= '<div style="background-color:'.$oPGGfx->rgbToHex(array('iRed' => $_iRed, 'iGreen' => $_iGreen, 'iBlue' => $_iBlue)).'; width:'.$_iSizeX.'px; height:'.$_iSizeY.'px;" ';
		$_sHtml .= 'onmousedown="return false;" ';
		$_sHtml .= 'onmouseup="oPGColorPicker.onColorRelease({\'sPickerID\': \''.$_sPickerID.'\', \'iRed\': '.$_iRed.', \'iGreen\': '.$_iGreen.', \'iBlue\': '.$_iBlue.'});" ';
		$_sHtml .= '></div>';
		return $_sHtml;
	}

	public function buildColorBar($_sPickerID, $_iRed = NULL, $_iGreen = NULL, $_iBlue = NULL, $_iSizeX = NULL, $_iSizeY = NULL, $_iSteps = NULL, $_bReverse = NULL)
	{
		global $oPGGfx;

		$_iRed = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iRed', 'xParameter' => $_iRed));
		$_iGreen = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iGreen', 'xParameter' => $_iGreen));
		$_iBlue = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iBlue', 'xParameter' => $_iBlue));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_iSteps = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSteps', 'xParameter' => $_iSteps));
		$_bReverse = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'bReverse', 'xParameter' => $_bReverse));
		$_sPickerID = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sPickerID', 'xParameter' => $_sPickerID));
		
		$_iMax = max($_iRed, max($_iGreen, $_iBlue));
		$_iMin = min($_iRed, min($_iGreen, $_iBlue));
		$_dMultiply = (255-$_iMin)/$_iSteps;
		$_iStepHeight = floor($_iSizeY/$_iSteps);
		$_iHeightDiff = $_iSizeY-($_iStepHeight*$_iSteps);
		
		if ($_bReverse == NULL) {$_bReverse = false;}
	
		$_sHtml = '';
		
		$_sHtml .= '<div style="float:left;">';
		if ($_bReverse == true)
		{
			for ($_iStep=$_iSteps-1; $_iStep>=0; $_iStep--)
			{
				$_aiColor = $this->calculateColors(array('iRed' => $_iRed, 'iGreen' => $_iGreen, 'iBlue' => $_iBlue), $_iStep, $_dMultiply);
				$_sHtml .= $this->buildColor(array('sPickerID' => $_sPickerID, 'iRed' => $_aiColor['iRed'], 'iGreen' => $_aiColor['iGreen'], 'iBlue' => $_aiColor['iBlue'], 'iSizeX' => $_iSizeX, 'iSizeY' => $_iStepHeight));
			}
		}
		else
		{
			for ($_iStep=0; $_iStep<$_iSteps; $_iStep++)
			{
				$_aiColor = $this->calculateColors(array('iRed' => $_iRed, 'iGreen' => $_iGreen, 'iBlue' => $_iBlue), $_iStep, $_dMultiply);
				$_sHtml .= $this->buildColor(array('sPickerID' => $_sPickerID, 'iRed' => $_aiColor['iRed'], 'iGreen' => $_aiColor['iGreen'], 'iBlue' => $_aiColor['iBlue'], 'iSizeX' => $_iSizeX, 'iSizeY' => $_iStepHeight));
			}
		}
		$_sHtml .= '</div>';
		
		return $_sHtml;
	}

	public function buildSimpleColorBars($_sPickerID, $_iSizeX = NULL, $_iSizeY = NULL, $_bDisplay = NULL)
	{
		global $oPGGfx;

		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_bDisplay = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'bDisplay', 'xParameter' => $_bDisplay));
		$_sPickerID = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sPickerID', 'xParameter' => $_sPickerID));

		$_iColorSizeX = $_iSizeX/11;
		$_iColorSizeY = $_iSizeY/6;
		
		$_bReverse = true;
		if ($_bDisplay === NULL) {$_bDisplay = true;}
		
		$_axPredefinedColors = array(
			array('iRed' => 0, 'iGreen' => 0, 'iBlue' => 0),
			array('iRed' => 255, 'iGreen' => 255, 'iBlue' => 255),
			array('iRed' => 255, 'iGreen' => 0, 'iBlue' => 0),
			array('iRed' => 0, 'iGreen' => 255, 'iBlue' => 0),
			array('iRed' => 0, 'iGreen' => 0, 'iBlue' => 255),
			array('iRed' => 255, 'iGreen' => 255, 'iBlue' => 0)
		);
		
		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sPickerID.PG_COLORPICKER_TYPE_SIMPLE.'" style="border:solid 1px #000000; ';
		if ($_bDisplay == true) {$_sHtml .= 'display:inline-block; ';} else {$_sHtml .= 'display:none; ';}
		$_sHtml .= 'vertical-align:top;">';
		
			$_sHtml .= '<div style="float:left;">';
				for ($i=0; $i<count($_axPredefinedColors); $i++)
				{
					$_aiColor = $_axPredefinedColors[$i];
					$_sHtml .= $this->buildColor(array('sPickerID' => $_sPickerID, 'iRed' => $_aiColor['iRed'], 'iGreen' => $_aiColor['iGreen'], 'iBlue' => $_aiColor['iBlue'], 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iColorSizeY));
				}
			$_sHtml .= '</div>';
		
			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 50, 'iGreen' => 20, 'iBlue' => 100, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));		// purple
			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 100, 'iGreen' => 0, 'iBlue' => 0, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));		// red
			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 80, 'iGreen' => 0, 'iBlue' => 100, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));		// pink

			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 120, 'iGreen' => 50, 'iBlue' => 0, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));		// orange
			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 100, 'iGreen' => 90, 'iBlue' => 0, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));		// yellow
			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 40, 'iGreen' => 100, 'iBlue' => 40, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));		// green

			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 20, 'iGreen' => 80, 'iBlue' => 100, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));		// turquoise
			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 10, 'iGreen' => 40, 'iBlue' => 120, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));		// blue
			
			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 0, 'iGreen' => 0, 'iBlue' => 0, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse));  		// grey dark
			$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 100, 'iGreen' => 100, 'iBlue' => 100, 'iSizeX' => $_iColorSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => 6, 'bReverse' => $_bReverse)); 	// grey
		$_sHtml .= '</div>';
		return $_sHtml;
	}
	
	public function buildSingleColorRect($_sPickerID, $_iSizeX = NULL, $_iSizeY = NULL, $_bDisplay = NULL, $_iDetailLevel = NULL)
	{
		global $oPGGfx;
	
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_bDisplay = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'bDisplay', 'xParameter' => $_bDisplay));
		$_iDetailLevel = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iDetailLevel', 'xParameter' => $_iDetailLevel));
		$_sPickerID = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sPickerID', 'xParameter' => $_sPickerID));

		if ($_bDisplay === NULL) {$_bDisplay = true;}

		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sPickerID.PG_COLORPICKER_TYPE_SINGLECOLOR.'" style="border:solid 1px #000000; ';
		if ($_bDisplay == true) {$_sHtml .= 'display:inline-block; ';} else {$_sHtml .= 'display:none; ';}
		$_sHtml .= 'vertical-align:top;">';
			for ($_iBrightnessLevel=127; $_iBrightnessLevel>=0; $_iBrightnessLevel--)
			{
				$_sHtml .= '<div style="float:left;">';
				for ($_iColorLevel=0; $_iColorLevel<128; $_iColorLevel++)
				{
					// TODO...
					// $_sHtml .= '<div style="background-color:#;"></div>';
				}
				$_sHtml .= '</div>';
			}
		$_sHtml .= '</div>';
		return $_sHtml;
	}
	
	public function buildMultiColorRect($_sPickerID, $_iSizeX = NULL, $_iSizeY = NULL, $_sOnColorAccept = NULL, $_bDisplay = NULL, $_iDetailLevel = NULL)
	{
		global $oPGGfx;

		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_sOnColorAccept = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sOnColorAccept', 'xParameter' => $_sOnColorAccept));
		$_bDisplay = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'bDisplay', 'xParameter' => $_bDisplay));
		$_iDetailLevel = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iDetailLevel', 'xParameter' => $_iDetailLevel));
		$_sPickerID = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sPickerID', 'xParameter' => $_sPickerID));
		
		if ($_bDisplay === NULL) {$_bDisplay = true;}
		if ($_iDetailLevel === NULL) {$_iDetailLevel = 1;}
		
		if ($_iSizeX >= 512) {$_iColorSteps = 16*$_iDetailLevel;}
		else if ($_iSizeX >= 256) {$_iColorSteps = 8*$_iDetailLevel;}
		else if ($_iSizeX >= 128) {$_iColorSteps = 4*$_iDetailLevel;}
		else if ($_iSizeX >= 64) {$_iColorSteps = 2*$_iDetailLevel;}
		else {$_iColorSteps = 1;}
		
		if ($_iSizeY >= 512) {$_iColorBarSteps = ($_iSizeY/16)*$_iDetailLevel;}
		else if ($_iSizeY >= 256) {$_iColorBarSteps = ($_iSizeY/8)*$_iDetailLevel;}
		else if ($_iSizeY >= 128) {$_iColorBarSteps = ($_iSizeY/4)*$_iDetailLevel;}
		else if ($_iSizeY >= 64) {$_iColorBarSteps = ($_iSizeY/2)*$_iDetailLevel;}
		else {$_iColorBarSteps = $_iSizeY;}

		$_iColorMax = 150;
		$_dColorMultiply = $_iColorMax/$_iColorSteps;
		$_iColorBarSizeX = floor($_iSizeX/($_iColorSteps*6));
		
		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sPickerID.PG_COLORPICKER_TYPE_MULTICOLOR.'" style="border:solid 1px #000000; ';
		if ($_bDisplay == true) {$_sHtml .= 'display:inline-block; ';} else {$_sHtml .= 'display:none; ';}
		$_sHtml .= 'vertical-align:top;">';
			for ($_iStep=0; $_iStep<$_iColorSteps; $_iStep++)
			{
				$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => $_iColorMax, 'iGreen' => round($_iStep*$_dColorMultiply), 'iBlue' => 0, 'iSizeX' => $_iColorBarSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => $_iColorBarSteps));
			}
			for ($_iStep=0; $_iStep<$_iColorSteps; $_iStep++)
			{
				$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => $_iColorMax-round($_iStep*$_dColorMultiply), 'iGreen' => $_iColorMax, 'iBlue' => $_iColorBarSizeX, 'iSizeX' => 5, 'iSizeY' => $_iSizeY, 'iSteps' => $_iColorBarSteps));
			}
			for ($_iStep=0; $_iStep<$_iColorSteps; $_iStep++)
			{
				$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 0, 'iGreen' => $_iColorMax, 'iBlue' => round($_iStep*$_dColorMultiply), 'iSizeX' => $_iColorBarSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => $_iColorBarSteps));
			}
			for ($_iStep=0; $_iStep<$_iColorSteps; $_iStep++)
			{
				$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => 0, 'iGreen' => $_iColorMax-round($_iStep*$_dColorMultiply), 'iBlue' => $_iColorMax, 'iSizeX' => $_iColorBarSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => $_iColorBarSteps));
			}
			for ($_iStep=0; $_iStep<$_iColorSteps; $_iStep++)
			{
				$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => round($_iStep*$_dColorMultiply), 'iGreen' => 0, 'iBlue' => $_iColorMax, 'iSizeX' => $_iColorBarSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => $_iColorBarSteps));
			}
			for ($_iStep=0; $_iStep<$_iColorSteps; $_iStep++)
			{
				$_sHtml .= $this->buildColorBar(array('sPickerID' => $_sPickerID, 'iRed' => $_iColorMax, 'iGreen' => 0, 'iBlue' => $_iColorMax-round($_iStep*$_dColorMultiply), 'iSizeX' => $_iColorBarSizeX, 'iSizeY' => $_iSizeY, 'iSteps' => $_iColorBarSteps));
			}
		$_sHtml .= '</div>';
		return $_sHtml;
	}
	
	public function build($_sPickerID = NULL, $_iSizeX = NULL, $_iSizeY = NULL, $_sOnColorAccept = NULL, $_sOnColorAbort = NULL, $_bDisplay = NULL, $_iDetailLevel = NULL, $_sCssClass = NULL, $_sCssStyle = NULL)
	{
		global $oPGButton;
	
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_sOnColorAccept = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sOnColorAccept', 'xParameter' => $_sOnColorAccept));
		$_sOnColorAbort = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sOnColorAbort', 'xParameter' => $_sOnColorAbort));
		$_bDisplay = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'bDisplay', 'xParameter' => $_bDisplay));
		$_iDetailLevel = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'iDetailLevel', 'xParameter' => $_iDetailLevel));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sPickerID = $this->getRealParameter(array('oParameters' => $_sPickerID, 'sName' => 'sPickerID', 'xParameter' => $_sPickerID));
		
		if ($_sPickerID === NULL) {$_sPickerID = $this->getNextID();}
		if ($_iSizeX === NULL) {$_iSizeX = 300;}
		if ($_iSizeY === NULL) {$_iSizeY = 200;}
		if ($_bDisplay === NULL) {$_bDisplay = true;}
		
		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sPickerID.'" style="';
		if ($_bDisplay == true) {$_sHtml .= 'display:inline-block; ';} else {$_sHtml .= 'display:none; ';}
		if ($_sCssStyle != NULL) {$_sHtml .= $_sCssStyle;}
		$_sHtml .= '" ';
		if ($_sCssClass != NULL) {$_sHtml .= 'class="'.$_sCssClass.'" ';}
		$_sHtml .= '>';
			
			$_sHtml .= '<a href="javascript:;" onclick="oPGColorPicker.show({\'sPickerID\': \''.$_sPickerID.'\', \'sType\': \''.PG_COLORPICKER_TYPE_SIMPLE.'\'});">simple</a> ';
			$_sHtml .= '<a href="javascript:;" onclick="oPGColorPicker.show({\'sPickerID\': \''.$_sPickerID.'\', \'sType\': \''.PG_COLORPICKER_TYPE_SINGLECOLOR.'\'});">singlecolor</a> ';
			$_sHtml .= '<a href="javascript:;" onclick="oPGColorPicker.show({\'sPickerID\': \''.$_sPickerID.'\', \'sType\': \''.PG_COLORPICKER_TYPE_MULTICOLOR.'\'});">multicolor</a>';
			$_sHtml .= '<br />';
			
			$_sHtml .= $this->buildSimpleColorBars(array('sPickerID' => $_sPickerID, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY, 'sOnColorAccept' => $_sOnColorAccept, 'bDisplay' => true));
			$_sHtml .= $this->buildSingleColorRect(array('sPickerID' => $_sPickerID, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY, 'sOnColorAccept' => $_sOnColorAccept, 'bDisplay' => false, 'iDetailLevel' => $_iDetailLevel));
			$_sHtml .= $this->buildMultiColorRect(array('sPickerID' => $_sPickerID, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY, 'sOnColorAccept' => $_sOnColorAccept, 'bDisplay' => false, 'iDetailLevel' => $_iDetailLevel));
			$_sHtml .= '<br />';
			
			$_sHtml .= '<div style="background-color:#cccccc; height:24px; line-height:24px; border:solid 1px #000000; display:inline-block; vertical-align:top; cursor:pointer;" ';
			$_sHtml .= 'onmouseup="alert(\'todo\')" ';
			$_sHtml .= '>&nbsp; No Color &nbsp;</div>';
			
			$_sHtml .= '<div id="'.$_sPickerID.'CurrentColor" style="width:32px; height:24px; border:solid 1px #000000; display:inline-block; vertical-align:top;"></div>';
			
			if ($_sOnColorAccept != NULL)
			{
				if (isset($oPGButton)) {$_sHtml .= $oPGButton->build(array('sButtonID' => $_sPickerID.'ButtonAccept', 'sText' => 'accept', 'sOnClick' => $_sOnColorAccept, 'sSizeX' => '50px', 'sSizeY' => '24px'));}
				else {$_sHtml .= '<input type="button" id="'.$_sPickerID.'ButtonAccept" onclick="'.$_sOnColorAccept.'" value="accept" />';}
			}
			if ($_sOnColorAbort != NULL)
			{
				if (isset($oPGButton)) {$_sHtml .= $oPGButton->build(array('sButtonID' => $_sPickerID.'ButtonAbort', 'sText' => 'abort', 'sOnClick' => $_sOnColorAbort, 'sSizeX' => '50px', 'sSizeY' => '24px'));}
				else {$_sHtml .= '<input type="button" id="'.$_sPickerID.'ButtonAbort" onclick="'.$_sOnColorAbort.'" value="abort" />';}
			}
		$_sHtml .= '</div>';
		return $_sHtml;
	}
}
$oPGColorPicker = new classPG_ColorPicker();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGColorPicker', 'xValue' => $oPGColorPicker));}
?>