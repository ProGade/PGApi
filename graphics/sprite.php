<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 16 2012
*/
define('PG_SPRITE_ANIMATION_INDEX_ID', 0);
define('PG_SPRITE_ANIMATION_INDEX_STARTPOS_X', 1);
define('PG_SPRITE_ANIMATION_INDEX_STARTPOS_Y', 2);
define('PG_SPRITE_ANIMATION_INDEX_STEPSIZE_X', 3);
define('PG_SPRITE_ANIMATION_INDEX_STEPSIZE_Y', 4);
define('PG_SPRITE_ANIMATION_INDEX_STEPS_X', 5);
define('PG_SPRITE_ANIMATION_INDEX_STEPS_Y', 6);
define('PG_SPRITE_ANIMATION_INDEX_SPEEDTIMEOUT',7);

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Sprite extends classPG_ClassBasics
{
	// Declarations...
	private $sFile = '';
	private $iFileSizeX = 256;
	private $iFileSizeY = 256;
	private $dScale = 1.0;
	private $sCssPosition = 'relative';

	private $sCurrentAnimationName = '';
	private $iCurrentAnimationStepX = 0;
	private $iCurrentAnimationStepY = 0;

	private $axAnimations = array();

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PG_Sprite'));
	}
	
	// Methods...
	/*
	@start method
	
	@param sAnimationName [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCurrentAnimationName($_sAnimationName)
	{
		$_sAnimationName = $this->getRealParameter(array('oParameters' => $_sAnimationName, 'sName' => 'sAnimationName', 'xParameter' => $_sAnimationName));
		$this->sCurrentAnimationName = $_sAnimationName;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sAnimationName [type]string[/type]
	[en]...[/en]
	*/
	public function getCurrentAnimationName() {return $this->sCurrentAnimationName;}
	/* @end method */

	/* @start method */
	public function resetCurrentAnimationSteps()
	{
		$this->iCurrentAnimationStepX = 0;
		$this->iCurrentAnimationStepY = 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@param iStepX [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setCurrentAnimationStepX($_iStepX)
	{
		$_iStepX = $this->getRealParameter(array('oParameters' => $_iStepX, 'sName' => 'iStepX', 'xParameter' => $_iStepX));
		$this->iCurrentAnimationStepX = $_iStepX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iStepX [type]int[/type]
	[en]...[/en]
	*/
	public function getCurrentAnimationStepX() {return $this->iCurrentAnimationStepX;}
	/* @end method */
	
	/*
	@start method
	
	@param iStepY [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setCurrentAnimationStepY($_iStepY)
	{
		$_iStepY = $this->getRealParameter(array('oParameters' => $_iStepY, 'sName' => 'iStepY', 'xParameter' => $_iStepY));
		$this->iCurrentAnimationStepY = $_iStepY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iStepY [type]int[/type]
	[en]...[/en]
	*/
	public function getCurrentAnimationStepY() {return $this->iCurrentAnimationStepY;}
	/* @end method */
	
	/*
	@start method
	
	@param dScale [needed][type]double[/type]
	[en]...[/en]
	*/
	public function setScale($_dScale)
	{
		$_dScale = $this->getRealParameter(array('oParameters' => $_dScale, 'sName' => 'dScale', 'xParameter' => $_dScale));
		$this->dScale = $_dScale;
	}
	/* @end method */
	
	/*
	@start method
	
	@return dScale [type]double[/type]
	[en]...[/en]
	*/
	public function getScale() {return $this->dScale;}
	/* @end method */
	
	/*
	@start method
	
	@param sCssPosition [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCssPosition($_sCssPosition)
	{
		$_sCssPosition = $this->getRealParameter(array('oParameters' => $_sCssPosition, 'sName' => 'sCssPosition', 'xParameter' => $_sCssPosition));
		if ($_sCssPosition != 'absolute') {$_sCssPosition = 'relative';}
		$this->sCssPosition = $_sCssPosition;
	}
	/* @end method */
	
	/* @start method */
	public function getCssPosition() {return $this->sCssPosition;}
	/* @end method */
	
	/*
	@start method
	
	@return iAnimationsIndex [type]int[/type]
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
	public function addAnimation($_sAnimationID, $_iStartPosX = NULL, $_iStartPosY = NULL, $_iStepSizeX = NULL, $_iStepSizeY = NULL, $_iStepsX = NULL, $_iStepsY = NULL, $_iSpeedTimeout = NULL)
	{
		$_iStartPosX = $this->getRealParameter(array('oParameters' => $_sAnimationID, 'sName' => 'iStartPosX', 'xParameter' => $_iStartPosX));
		$_iStartPosY = $this->getRealParameter(array('oParameters' => $_sAnimationID, 'sName' => 'iStartPosY', 'xParameter' => $_iStartPosY));
		$_iStepSizeX = $this->getRealParameter(array('oParameters' => $_sAnimationID, 'sName' => 'iStepSizeX', 'xParameter' => $_iStepSizeX));
		$_iStepSizeY = $this->getRealParameter(array('oParameters' => $_sAnimationID, 'sName' => 'iStepSizeY', 'xParameter' => $_iStepSizeY));
		$_iStepsX = $this->getRealParameter(array('oParameters' => $_sAnimationID, 'sName' => 'iStepsX', 'xParameter' => $_iStepsX));
		$_iStepsY = $this->getRealParameter(array('oParameters' => $_sAnimationID, 'sName' => 'iStepsY', 'xParameter' => $_iStepsY));
		$_iSpeedTimeout = $this->getRealParameter(array('oParameters' => $_sAnimationID, 'sName' => 'iSpeedTimeout', 'xParameter' => $_iSpeedTimeout));
		$_sAnimationID = $this->getRealParameter(array('oParameters' => $_sAnimationID, 'sName' => 'sAnimationID', 'xParameter' => $_sAnimationID));

		if ($_iStepsX === NULL) {$_iStepsX = 1;}
		if ($_iStepsY === NULL) {$_iStepsY = 1;}
		if ($_iSpeedTimeout === NULL) {$_iSpeedTimeout = 200;}
		$this->axAnimations[] = array($_sAnimationID, $_iStartPosX, $_iStartPosY, $_iStepSizeX, $_iStepSizeY, $_iStepsX, $_iStepsY, $_iSpeedTimeout);
		return count($this->axAnimations)-1;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sSpriteHtml [type]string[/type]
	[en]...[/en]
	
	@param xAnimation [type]mixed[/type]
	[en]...[/en]
	*/
	public function animate($_xAnimation = NULL)
	{
		$_xAnimation = $this->getRealParameter(array('oParameters' => $_xAnimation, 'sName' => 'xAnimation', 'xParameter' => $_xAnimation));

		$_bAnimationDone = false;
		if ((($_xAnimation === NULL) || ($_xAnimation === '')) && ($this->sCurrentAnimationName != ''))
		{
			$_xAnimation = $this->sCurrentAnimationName;
		}
		if ($_xAnimation !== NULL)
		{
			$_iIndex = $this->getAnimationIndex(array('xAnimation' => $_xAnimation));
			if (($_iIndex >= 0) && ($_iIndex < count($this->axAnimations)))
			{
				if ($this->sCurrentAnimationName != $this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_ID])
				{
					$this->sCurrentAnimationName = $this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_ID];
					$this->iCurrentAnimationStepX = 0;
					$this->iCurrentAnimationStepY = 0;
				}
				
				$_iStepSizeX = ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_X]*$this->dScale);
				$_iStepSizeY = ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_Y]*$this->dScale);
				$_iStepStartPosX = ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STARTPOS_X]*$this->dScale);
				$_iStepStartPosY = ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STARTPOS_Y]*$this->dScale);
				$_iFileSizeX = ceil($this->iFileSizeX*$this->dScale);
				$_iFileSizeY = ceil($this->iFileSizeY*$this->dScale);
	
				$_iNewPosSubX = -($_iStepStartPosX+($this->iCurrentAnimationStepX*$_iStepSizeX));
				$_iNewPosSubY = -($_iStepStartPosY+($this->iCurrentAnimationStepY*$_iStepSizeY));

				$_sHtml = '';
				$_sHtml .= $this->update($_iIndex);
				$this->iCurrentAnimationStepX++;
	
				$_iNewPosX = $_iStepStartPosX+($this->iCurrentAnimationStepX*$_iStepSizeX);
	
				if ($this->iCurrentAnimationStepX > 0)
				{
					if (($_iNewPosX+$_iStepSizeX > $_iFileSizeX) || ($this->iCurrentAnimationStepX >= $this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPS_X]))
					{
						$this->iCurrentAnimationStepX = 0;
						$this->iCurrentAnimationStepY++;
						if ($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPS_X] == 0) {$_bAnimationDone = true;}
					}
				}
	
				$_iNewPosY = $_iStepStartPosY+($this->iCurrentAnimationStepY*$_iStepSizeY);
				if ($this->iCurrentAnimationStepY > 0)
				{
					if (($_iNewPosY+$_iStepSizeY > $_iFileSizeY) || ($this->iCurrentAnimationStepY >= $this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPS_Y]))
					{
						$this->iCurrentAnimationStepX = 0;
						$this->iCurrentAnimationStepY = 0;
						$_bAnimationDone = true;
					}
				}
			}
		}
		// return $_bAnimationDone;
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iAnimationIndex [type]int[/type]
	[en]...[/en]
	
	@param xAnimation [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getAnimationIndex($_xAnimation)
	{
		$_xAnimation = $this->getRealParameter(array('oParameters' => $_xAnimation, 'sName' => 'xAnimation', 'xParameter' => $_xAnimation));

		if (is_int($_xAnimation)) {return $_xAnimation;}
		else if (is_string($_xAnimation))
		{
			for ($i=0; $i<count($this->axAnimations); $i++)
			{
				if ($this->axAnimations[$i][PG_SPRITE_ANIMATION_INDEX_ID] == $_xAnimation) {return $i;}
			}
		}
		return NULL;
	}
	/* @end method */

	/*
	@start method
	
	@param sSpriteID [needed][type]string[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param iFileSizeX [type]int[/type]
	[en]...[/en]
	
	@param iFileSizeY [type]int[/type]
	[en]...[/en]
	*/
	public function init($_sSpriteID, $_sFile = NULL, $_iFileSizeX = NULL, $_iFileSizeY = NULL)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_iFileSizeX = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'iFileSizeX', 'xParameter' => $_iFileSizeX));
		$_iFileSizeY = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'iFileSizeY', 'xParameter' => $_iFileSizeY));
		$_sSpriteID = $this->getRealParameter(array('oParameters' => $_sSpriteID, 'sName' => 'sSpriteID', 'xParameter' => $_sSpriteID));

		$this->setID(array('sID' => $_sSpriteID));
		$this->sFile = $_sFile;
		
		if (($_iFileSizeX === NULL) || ($_iFileSizeY === NULL))
		{
			$_aiSize = getimagesize($this->sFile);
			$this->iFileSizeX = $_aiSize[0];
			$this->iFileSizeY = $_aiSize[1];
		}
		else
		{
			$this->iFileSizeX = $_iFileSizeX;
			$this->iFileSizeY = $_iFileSizeY;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->sFile = $_sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFile [type]string[/type]
	[en]...[/en]
	*/
	public function getFile() {return $this->sFile;}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setFileSizeX($_iSizeX)
	{
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$this->iFileSizeX = $_iSizeX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeX [type]int[/type]
	[en]...[/en]
	*/
	public function getFileSizeX() {return $this->iFileSizeX;}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	*/
	public function setFileSizeY($_iSizeY)
	{
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_iSizeY, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$this->iFileSizeY = $_iSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeY [type]int[/type]
	[en]...[/en]
	*/
	public function getFileSizeY() {return $this->iFileSizeY;}
	/* @end method */
	
	/*
	@start method
	
	@return sSpriteHtml [type]string[/type]
	[en]...[/en]
	
	@param xAnimation [type]mixed[/type]
	[en]...[/en]
	*/
	public function update($_xAnimation = NULL)
	{
		$_xAnimation = $this->getRealParameter(array('oParameters' => $_xAnimation, 'sName' => 'xAnimation', 'xParameter' => $_xAnimation));

		$_sHtml = '';
		$_iNewPosSubX = 0;
		$_iNewPosSubY = 0;
		$_iIndex = 0;
		if ((($_xAnimation === NULL) || ($_xAnimation === '')) && ($this->sCurrentAnimationName != ''))
		{
			$_xAnimation = $this->sCurrentAnimationName;
		}
		if ($_xAnimation !== NULL)
		{
			$_iIndex = $this->getAnimationIndex(array('xAnimation' => $_xAnimation));
			if (($_iIndex >= 0) && ($_iIndex < count($this->axAnimations)))
			{
				$_iStepSizeX = ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_X]*$this->dScale);
				$_iStepSizeY = ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_Y]*$this->dScale);
				$_iStepStartPosX = ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STARTPOS_X]*$this->dScale);
				$_iStepStartPosY = ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STARTPOS_Y]*$this->dScale);
				
				$_iNewPosSubX = -($_iStepStartPosX+($this->iCurrentAnimationStepX*$_iStepSizeX));
				$_iNewPosSubY = -($_iStepStartPosY+($this->iCurrentAnimationStepY*$_iStepSizeY));
			}
		}
		
		$_sHtml .= '<div ';
		if ($this->getID() != '') {$_sHtml .= 'id="'.$this->getID().'" ';}
		$_sHtml .= 'style="';
		$_sHtml .= 'position:'.$this->sCssPosition.'; ';
		$_sHtml .= 'overflow:hidden; ';
		$_sHtml .= 'display:block; ';
		if (count($this->axAnimations) > 0)
		{
			$_sHtml .= 'width:'.ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_X]*$this->dScale).'px; ';
			$_sHtml .= 'height:'.ceil($this->axAnimations[$_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_Y]*$this->dScale).'px; ';
		}
		else
		{
			$_sHtml .= 'width:'.ceil($this->iFileSizeX*$this->dScale).'px; ';
			$_sHtml .= 'height:'.ceil($this->iFileSizeY*$this->dScale).'px; ';
		}
		$_sHtml .= '">';
			$_sHtml .= '<img id="'.$this->getID().'Img" ';
			$_sHtml .= 'src="'.$this->sFile.'" ';
			$_sHtml .= 'style="';
			$_sHtml .= 'position:absolute; ';
			if (count($this->axAnimations) > 0)
			{
				$_sHtml .= 'left:'.$_iNewPosSubX.'px; ';
				$_sHtml .= 'top:'.$_iNewPosSubY.'px; ';
			}
			else
			{
				$_sHtml .= 'left:0px; ';
				$_sHtml .= 'top:0px; ';
			}
			$_sHtml .= 'width:'.ceil($this->iFileSizeX*$this->dScale).'px; ';
			$_sHtml .= 'height:'.ceil($this->iFileSizeY*$this->dScale).'px; ';
			$_sHtml .= 'border-width:0px; ';
			$_sHtml .= '" />';
		$_sHtml .= '</div>';
		
		$this->setID(array('sID' => ''));
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sSpriteHtml [type]string[/type]
	[en]...[/en]
	*/
	public function build()
	{
		$_sHtml = '';
		$_sHtml .= $this->update();
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
?>