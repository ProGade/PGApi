<?php
/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 06 2014
*/
define('PG_SPRITES_INDEX_ID', 0);
define('PG_SPRITES_INDEX_OBJECT', 1);
define('PG_SPRITES_ANIMATE_LOOP', -1);

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Sprites extends classPG_ClassBasics
{
	// Declarations...
	private $axSprites = array();

	// Construct...
	public function __construct()
	{
	}
	
	// Methods...
	/*
	@start method
	
	@return iSpriteIndex [type]int[/type]
	[en]...[/en]
	
	@param sSpriteID [needed][type]string[/type]
	[en]...[/en]
	
	@param oSprite [needed][type]object[/type]
	[en]...[/en]
	*/
	public function registerSprite($_sSpriteID, $_oSprite = NULL)
	{
		$_oSprite = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'oSprite', 'xParameter' => $_oSprite));
		$_sSpriteID = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'sSpriteID', 'xParameter' => $_sSpriteID));

		$this->axSprites[] = array($_sSpriteID, $_oSprite);
		return count($this->axSprites)-1;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSpriteIndex [type]int[/type]
	[en]...[/en]
	
	@param sSpriteID [needed][type]string[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param iFileSizeX [type]int[/type]
	[en]...[/en]
	
	@param iFileSizeY [type]int[/type]
	[en]...[/en]
	*/
	public function createSprite($_sSpriteID, $_sFile, $_iFileSizeX = NULL, $_iFileSizeY = NULL)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_iFileSizeX = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'iFileSizeX', 'xParameter' => $_iFileSizeX));
		$_iFileSizeY = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'iFileSizeY', 'xParameter' => $_iFileSizeY));
		$_sSpriteID = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'sSpriteID', 'xParameter' => $_sSpriteID));

		$_oSprite = new classPG_Sprite();
		$_oSprite->init(array('sSpriteID' => $_sSpriteID, 'sFile' => $_sFile, 'iFileSizeX' => $_iFileSizeX, 'iFileSizeY' => $_iFileSizeY));
		return $this->registerSprite(array('sSpriteID' => $_sSpriteID, 'oSprite' => $_oSprite));
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSpriteIndex [type]int[/type]
	[en]...[/en]
	
	@param sNewSpriteID [needed][type]string[/type]
	[en]...[/en]
	
	@param xCopyOfSprite [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function createSpriteCopy($_sNewSpriteID, $_xCopyOfSprite = NULL)
	{
		$_xCopyOfSprite = $this->getRealParameter(array('oParameters' => $_sNewSpriteID, 'sName' => 'xCopyOfSprite', 'xParameter' => $_xCopyOfSprite));
		$_sNewSpriteID = $this->getRealParameter(array('oParameters' => $_sNewSpriteID, 'sName' => 'sNewSpriteID', 'xParameter' => $_sNewSpriteID));

		$_iCopySpriteIndex = $this->getSpriteIndex(array('xSprite' =>$_xCopyOfSprite));
		if (($_iCopySpriteIndex >= 0) && ($_iCopySpriteIndex < count($this->axSprites)))
		{
			$_oCopySprite = $this->axSprites[$_iCopySpriteIndex][PG_SPRITES_INDEX_OBJECT];
			if ($_oCopySprite)
			{
				$_oSprite = new classPG_Sprite();
				$_oSprite->init(array('sSpriteID' => $_sNewSpriteID, 'sFile' => $_oCopySprite->getFile(), 'iFileSizeX' => $_oCopySprite->getFileSizeX(), 'iFileSizeY' => $_oCopySprite->getFileSizeY()));
				return $this->registerSprite(array('sSpriteID' => $_sNewSpriteID, 'oSprite' => $_oSprite));
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sSpriteHtml [type]string[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function buildSprite($_xSprite)
	{
		$_xSprite = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'xSprite', 'xParameter' => $_xSprite));

		$_iIndex = $this->getSpriteIndex(array('xSprite' => $_xSprite));
		if (($_iIndex >= 0) && ($_iIndex < count($this->axSprites)))
		{
			$_oSprite = $this->axSprites[$_iIndex][PG_SPRITES_INDEX_OBJECT];
			if ($_oSprite)
			{
				$_sHtml = $_oSprite->build();
				return $_sHtml;
			}
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sSpritesHtml [type]string[/type]
	[en]...[/en]
	*/
	public function buildAllSprites()
	{
		$_sHtml = '';
		$_oSprite = NULL;
		for ($i=0; $i<$this->axSprites; $i++)
		{
			if ($this->axSprites[$i] != NULL)
			{
				$_oSprite = $this->axSprites[$i][PG_SPRITES_INDEX_OBJECT];
				if ($_oSprite != NULL) {$_sHtml .= $_oSprite->build();}
			}
		}
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSpriteIndex [type]int[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getSpriteIndex($_xSprite)
	{
		$_xSprite = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'xSprite', 'xParameter' => $_xSprite));

		if (is_int($_xSprite)) {return $_xSprite;}
		else if (is_string($_xSprite))
		{
			for ($i=0; $i<count($this->axSprites); $i++)
			{
				if ($this->axSprites[$i][PG_SPRITES_INDEX_ID] == $_xSprite) {return $i;}
			}
		}
		else if (is_object($_xSprite))
		{
			for ($i=0; $i<count($this->axSprites); $i++)
			{
				if ($this->axSprites[$i][PG_SPRITES_INDEX_OBJECT] == $_xSprite) {return $i;}
			}
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return oSprite [type]object[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getSprite($_xSprite)
	{
		$_xSprite = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'xSprite', 'xParameter' => $_xSprite));

		if (is_object($_xSprite)) {return $_xSprite;}
		else if (is_string($_xSprite))
		{
			for ($i=0; i<count($this->axSprites); $i++)
			{
				if ($this->axSprites[$i][PG_SPRITES_INDEX_ID] == $_xSprite) {return $this->axSprites[$i][PG_SPRITES_INDEX_OBJECT];}
			}
		}
		else if (is_int($_xSprite))
		{
			if (($_xSprite >= 0) && ($_xSprite < count($this->axSprites)))
			{
				return $this->axSprites[$_xSprite][PG_SPRITES_INDEX_OBJECT];
			}
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iAnimationIndex [type]int[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sAnimationID [needed][type]string[/type]
	[en]...[/en]
	
	@param iStartPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iStartPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param iStepSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iStepSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param iStepsX [type]int[/type]
	[en]...[/en]
	
	@param iStepsY [type]int[/type]
	[en]...[/en]
	
	@param iSpeedTimeout [type]int[/type]
	[en]...[/en]
	*/
	public function addAnimation($_xSprite, $_sAnimationID = NULL, $_iStartPosX = NULL, $_iStartPosY = NULL, $_iStepSizeX = NULL, $_iStepSizeY = NULL, $_iStepsX = NULL, $_iStepsY = NULL, $_iSpeedTimeout = NULL)
	{
		$_sAnimationID = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'sAnimationID', 'xParameter' => $_sAnimationID));
		$_iStartPosX = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'iStartPosX', 'xParameter' => $_iStartPosX));
		$_iStartPosY = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'iStartPosY', 'xParameter' => $_iStartPosY));
		$_iStepSizeX = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'iStepSizeX', 'xParameter' => $_iStepSizeX));
		$_iStepSizeY = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'iStepSizeY', 'xParameter' => $_iStepSizeY));
		$_iStepsX = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'iStepsX', 'xParameter' => $_iStepsX));
		$_iStepsY = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'iStepsY', 'xParameter' => $_iStepsY));
		$_iSpeedTimeout = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'iSpeedTimeout', 'xParameter' => $_iSpeedTimeout));
		$_xSprite = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'xSprite', 'xParameter' => $_xSprite));

		if ($_iStepsX === NULL) {$_iStepsX = 1;}
		if ($_iStepsY === NULL) {$_iStepsY = 1;}
		if ($_iSpeedTimeout === NULL) {$_iSpeedTimeout = 200;}
		
		$_oSprite = $this->getSprite(array('xSprite' => $_xSprite));
		if ($_oSprite) {return $_oSprite->addAnimation(array('sAnimationID' => $_sAnimationID, 'iStartPosX' => $_iStartPosX, 'iStartPosY' => $_iStartPosY, 'iStepSizeX' => $_iStepSizeX, 'iStepSizeY' => $_iStepSizeY, 'iStepsX' => $_iStepsX, 'iStepsY' => $_iStepsY, 'iSpeedTimeout' => $_iSpeedTimeout));}
		return NULL;
	}
	/* @end method */

	/*
	@start method
	
	@return sSpriteHtml [type]string[/type]
	[en]...[/en]
	
	@param xSprite [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xAnimation [needed][type]mixed[/type]
	[en]...[/en]
	
	@param iTimes [type]int[/type]
	[en]...[/en]
	*/
	public function animate($_xSprite, $_xAnimation = NULL, $_iTimes = NULL) // , $_iSpeedTimeout = NULL)
	{
		$_xAnimation = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'xAnimation', 'xParameter' => $_xAnimation));
		$_iTimes = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'iTimes', 'xParameter' => $_iTimes));
		$_xSprite = $this->getRealParameter(array('oParameters' => $_xSprite, 'sName' => 'xSprite', 'xParameter' => $_xSprite));

		if ($_iTimes == NULL) {$_iTimes = 1;}
		
		$_sHtml = '';
		$_oSprite = $this->getSprite(array('xSprite' => $_xSprite));
		$_iSpriteIndex = $this->getSpriteIndex(array('xSprite' => $_xSprite));

		if ($_oSprite)
		{
			// if ($_iSpeedTimeout == NULL) {$_iSpeedTimeout = $_oSprite->getAnimationTimeout($_xAnimation);}
			if (($_iTimes > 0) || ($_iTimes < 0)) // && ($_iSpeedTimeout > 0))
			{
				if ($_sHtml .= $_oSprite->animate(array('xAnimation' => $_xAnimation))) {if ($_iTimes > 0) {$_iTimes--;}}
				return $_sHtml;
			}
		}
		return NULL;
	}
	/* @end method */
}
/* @end class */
$oPGSprites = new classPG_Sprites();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGSprites', 'xValue' => $oPGSprites));}
?>