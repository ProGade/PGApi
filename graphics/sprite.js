/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
var PG_SPRITE_ANIMATION_INDEX_ID = 0;
var PG_SPRITE_ANIMATION_INDEX_STARTPOS_X = 1;
var PG_SPRITE_ANIMATION_INDEX_STARTPOS_Y = 2;
var PG_SPRITE_ANIMATION_INDEX_STEPSIZE_X = 3;
var PG_SPRITE_ANIMATION_INDEX_STEPSIZE_Y = 4;
var PG_SPRITE_ANIMATION_INDEX_STEPS_X = 5;
var PG_SPRITE_ANIMATION_INDEX_STEPS_Y = 6;
var PG_SPRITE_ANIMATION_INDEX_SPEEDTIMEOUT = 7;

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Sprite()
{
	// Declarations...
	this.iOffsetX = 0;
	this.iOffsetY = 0;
	this.iPosX = 0;
	this.iPosY = 0;

	this.sFile = '';
	this.iFileSizeX = 256;
	this.iFileSizeY = 256;
	this.dScale = 1.0;
	this.dScaleTo = 1.0;
	this.dLastScale = 1.0;
	this.sCssPosition = 'relative';
	
	this.sCurrentAnimationName = '';
	this.iCurrentAnimationStepX = 0;
	this.iCurrentAnimationStepY = 0;
	
	this.oAnimationTimeout = null;
	this.oScaleTimeout = null;
	
	this.axAnimations = new Array();
	
	// Construct...
	this.setID('PGSprite');
	
	// Methods...
	/*
	@start method
	
	@param sAnimationName [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCurrentAnimationName = function(_sAnimationName)
	{
		_sAnimationName = this.getRealParameter({'oParameters': _sAnimationName, 'sName': 'sAnimationName', 'xParameter': _sAnimationName});
		this.sCurrentAnimationName = _sAnimationName;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sAnimationName [type]string[/type]
	[en]...[/en]
	*/
	this.getCurrentAnimationName = function() {return this.sCurrentAnimationName;}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setPosX = function(_iPosX)
	{
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		this.iPosX = _iPosX;
		this.update();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setPosY = function(_iPosY)
	{
		_iPosY = this.getRealParameter({'oParameters': _iPosY, 'sName': 'iPosY', 'xParameter': _iPosY});
		this.iPosY = _iPosY;
		this.update();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	*/
	this.setPos = function(_iPosX, _iPosY)
	{
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}
		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		if (_iPosX != null) {this.iPosX = _iPosX;}
		if (_iPosY != null) {this.iPosY = _iPosY;}
		this.update();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iOffsetX [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setOffsetX = function(_iOffsetX)
	{
		_iOffsetX = this.getRealParameter({'oParameters': _iOffsetX, 'sName': 'iOffsetX', 'xParameter': _iOffsetX});
		this.iOffsetX = _iOffsetX;
		this.update();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iOffsetY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setOffsetY = function(_iOffsetY)
	{
		_iOffsetY = this.getRealParameter({'oParameters': _iOffsetY, 'sName': 'iOffsetY', 'xParameter': _iOffsetY});
		this.iOffsetY = _iOffsetY;
		this.update();
	}
	/* @end method */
	
	/*
	@start method
	
	@param iOffsetX [type]int[/type]
	[en]...[/en]
	
	@param iOffsetY [type]int[/type]
	[en]...[/en]
	*/
	this.setOffset = function(_iOffsetX, _iOffsetY)
	{
		if (typeof(_iOffsetY) == 'undefined') {var _iOffsetY = null;}
		_iOffsetY = this.getRealParameter({'oParameters': _iOffsetX, 'sName': 'iOffsetY', 'xParameter': _iOffsetY});
		_iOffsetX = this.getRealParameter({'oParameters': _iOffsetX, 'sName': 'iOffsetX', 'xParameter': _iOffsetX});
		if (_iOffsetX != null) {this.iOffsetX = _iOffsetX;}
		if (_iOffsetY != null) {this.iOffsetY = _iOffsetY;}
		this.update();
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeX [type]int[/type]
	[en]...[/en]
	*/
	this.getSizeX = function()
	{
		var _oDiv = this.oDocument.getElementById(this.getID());
		if (_oDiv)
		{
			var _iSizeX = parseInt(_oDiv.offsetWidth);
			if (!isNaN(_iSizeX)) {return _iSizeX;}
		}
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeY [type]int[/type]
	[en]...[/en]
	*/
	this.getSizeY = function()
	{
		var _oDiv = this.oDocument.getElementById(this.getID());
		if (_oDiv)
		{
			var _iSizeY = parseInt(_oDiv.offsetHeight);
			if (!isNaN(_iSizeY)) {return _iSizeY;}
		}
		return 0;
	}
	/* @end method */
	
	/*
	@start method
	
	@param dScale [needed][type]double[/type]
	[en]...[/en]
	*/
	this.setLastScale = function(_dScale)
	{
		_dScale = this.getRealParameter({'oParameters': _dScale, 'sName': 'dScale', 'xParameter': _dScale});
		this.dLastScale = _dScale;
	}
	/* @end method */
	
	/*
	@start method
	
	@return dLastScale [type]double[/type]
	[en]...[/en]
	*/
	this.getLastScale = function() {return this.dLastScale;}
	/* @end method */

	/*
	@start method
	
	@param dScale [needed][type]double[/type]
	[en]...[/en]
	
	@param bUpdateLastScale [type]bool[/type]
	[en]...[/en]
	*/
	this.setScale = function(_dScale, _bUpdateLastScale)
	{
		if (typeof(_bUpdateLastScale) == 'undefined') {var _bUpdateLastScale = null;}

		_bUpdateLastScale = this.getRealParameter({'oParameters': _dScale, 'sName': 'bUpdateLastScale', 'xParameter': _bUpdateLastScale});
		_dScale = this.getRealParameter({'oParameters': _dScale, 'sName': 'dScale', 'xParameter': _dScale});

		if (_bUpdateLastScale == null) {_bUpdateLastScale = true;}
		
		this.dScale = _dScale;
		// this.stopScaling();
		this.update();
		if (_bUpdateLastScale == true) {this.dLastScale = this.dScale;}
	}
	/* @end method */
	
	/*
	@start method
	
	@return dScale [type]double[/type]
	[en]...[/en]
	*/
	this.getScale = function() {return this.dScale;}
	/* @end method */
	
	/*
	@start method
	
	@param oTimeout [needed][type]object[/type]
	[en]...[/en]
	*/
	this.startScaling = function(_oTimeout)
	{
		_oTimeout = this.getRealParameter({'oParameters': _oTimeout, 'sName': 'oInterval', 'xParameter': _oTimeout, 'bNotNull': true});
		// this.stopScaling(null);
		this.oScaleTimeout = _oTimeout;
	}
	/* @end method */
	
	/*
	@start method
	
	@param dScaleTo [needed][type]double[/type]
	[en]...[/en]
	*/
	this.stopScaling = function(_dScaleTo)
	{
		_dScaleTo = this.getRealParameter({'oParameters': _dScaleTo, 'sName': 'dScaleTo', 'xParameter': _dScaleTo});
		if ((this.oScaleTimeout != null) && ((this.dScaleTo == _dScaleTo) || (_dScaleTo == null)))
		{
			this.oWindow.clearTimeout(this.oScaleTimeout);
			this.oScaleTimeout = null;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@param sCssPosition [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setCssPosition = function(_sCssPosition)
	{
		_sCssPosition = this.getRealParameter({'oParameters': _sCssPosition, 'sName': 'sCssPosition', 'xParameter': _sCssPosition});
		this.sCssPosition = _sCssPosition;
		var _oDiv = this.oDocument.getElementById(this.getID());
		if (_oDiv) {_oDiv.style.position = this.sCssPosition;}
	}
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
	this.addAnimation = function(_sAnimationID, _iStartPosX, _iStartPosY, _iStepSizeX, _iStepSizeY, _iStepsX, _iStepsY, _iSpeedTimeout)
	{
		if (typeof(_iStartPosX) == 'undefined') {var _iStartPosX = null;}
		if (typeof(_iStartPosY) == 'undefined') {var _iStartPosY = null;}
		if (typeof(_iStepSizeX) == 'undefined') {var _iStepSizeX = null;}
		if (typeof(_iStepSizeY) == 'undefined') {var _iStepSizeY = null;}
		if (typeof(_iStepsX) == 'undefined') {var _iStepsX = null;}
		if (typeof(_iStepsY) == 'undefined') {var _iStepsY = null;}
		if (typeof(_iSpeedTimeout) == 'undefined') {var _iSpeedTimeout = null;}
		
		_iStartPosX = this.getRealParameter({'oParameters': _sAnimationID, 'sName': 'iStartPosX', 'xParameter': _iStartPosX});
		_iStartPosY = this.getRealParameter({'oParameters': _sAnimationID, 'sName': 'iStartPosY', 'xParameter': _iStartPosY});
		_iStepSizeX = this.getRealParameter({'oParameters': _sAnimationID, 'sName': 'iStepSizeX', 'xParameter': _iStepSizeX});
		_iStepSizeY = this.getRealParameter({'oParameters': _sAnimationID, 'sName': 'iStepSizeY', 'xParameter': _iStepSizeY});
		_iStepsX = this.getRealParameter({'oParameters': _sAnimationID, 'sName': 'iStepsX', 'xParameter': _iStepsX});
		_iStepsY = this.getRealParameter({'oParameters': _sAnimationID, 'sName': 'iStepsY', 'xParameter': _iStepsY});
		_iSpeedTimeout = this.getRealParameter({'oParameters': _sAnimationID, 'sName': 'iSpeedTimeout', 'xParameter': _iSpeedTimeout});
		_sAnimationID = this.getRealParameter({'oParameters': _sAnimationID, 'sName': 'sAnimationID', 'xParameter': _sAnimationID});
		
		if (_iStepsX == null) {_iStepsX = 1;}
		if (_iStepsY == null) {_iStepsY = 1;}
		if (_iSpeedTimeout == null) {_iSpeedTimeout = 200;}
		
		this.axAnimations.push(new Array(_sAnimationID, _iStartPosX, _iStartPosY, _iStepSizeX, _iStepSizeY, _iStepsX, _iStepsY, _iSpeedTimeout));
		return this.axAnimations.length-1;
	}
	/* @end method */

	/*
	@start method
	
	@return iTimeout [type]int[/type]
	[en]...[/en]
	
	@param xAnimation [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getAnimationTimeout = function(_xAnimation)
	{
		_xAnimation = this.getRealParameter({'oParameters': _xAnimation, 'sName': 'xAnimation', 'xParameter': _xAnimation});
		var _iIndex = this.getAnimationIndex({'xAnimation': _xAnimation});
		if ((_iIndex >= 0) && (_iIndex < this.axAnimations.length)) {return this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_SPEEDTIMEOUT];}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bAnimationDone [type]bool[/type]
	[en]...[/en]
	
	@param xAnimation [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.animate = function(_xAnimation)
	{
		_xAnimation = this.getRealParameter({'oParameters': _xAnimation, 'sName': 'xAnimation', 'xParameter': _xAnimation});

		var _bAnimationDone = false;
		var _iIndex = this.getAnimationIndex({'xAnimation': _xAnimation});
		if ((_iIndex >= 0) && (_iIndex < this.axAnimations.length))
		{
			this.stopAnimation();
			
			if (this.sCurrentAnimationName != this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_ID])
			{
				this.sCurrentAnimationName = this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_ID];
				this.iCurrentAnimationStepX = 0;
				this.iCurrentAnimationStepY = 0;
			}
			
			var _iStepSizeX = Math.ceil(this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_X]*this.dScale);
			var _iStepSizeY = Math.ceil(this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_Y]*this.dScale);
			var _iStepStartPosX = Math.ceil(this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STARTPOS_X]*this.dScale);
			var _iStepStartPosY = Math.ceil(this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STARTPOS_Y]*this.dScale);
			var _iFileSizeX = Math.ceil(this.iFileSizeX*this.dScale);
			var _iFileSizeY = Math.ceil(this.iFileSizeY*this.dScale);

			this.update({'xAnimation': _xAnimation});
			this.iCurrentAnimationStepX++;

			var _iNewPosX = _iStepStartPosX+(this.iCurrentAnimationStepX*_iStepSizeX);

			if (this.iCurrentAnimationStepX > 0)
			{
				if ((_iNewPosX+_iStepSizeX > _iFileSizeX) || (this.iCurrentAnimationStepX >= this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPS_X]))
				{
					this.iCurrentAnimationStepX = 0;
					this.iCurrentAnimationStepY++;
					if (this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPS_X] == 0) {_bAnimationDone = true;}
				}
			}

			var _iNewPosY = _iStepStartPosY+(this.iCurrentAnimationStepY*_iStepSizeY);
			if (this.iCurrentAnimationStepY > 0)
			{
				if ((_iNewPosY+_iStepSizeY > _iFileSizeY) || (this.iCurrentAnimationStepY >= this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPS_Y]))
				{
					this.iCurrentAnimationStepX = 0;
					this.iCurrentAnimationStepY = 0;
					_bAnimationDone = true;
				}
			}
		}
		return _bAnimationDone;
	}
	/* @end method */
	
	/*
	@start method
	
	@param oTimeout [needed][type]object[/type]
	[en]...[/en]
	*/
	this.startAnimation = function(_oTimeout)
	{
		_oTimeout = this.getRealParameter({'oParameters': _oTimeout, 'sName': 'oTimeout', 'xParameter': _oTimeout, 'bNotNull': true});
		this.oAnimationTimeout = _oTimeout;
	}
	/* @end method */
	
	/* @start method */
	this.stopAnimation = function()
	{
		if (this.oAnimationTimeout != null)
		{
			this.oWindow.clearTimeout(this.oAnimationTimeout);
			this.oAnimationTimeout = null;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return iAnimationIndex [type]int[/type]
	[en]...[/en]
	
	@param xAnimation [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getAnimationIndex = function(_xAnimation)
	{
		_xAnimation = this.getRealParameter({'oParameters': _xAnimation, 'sName': 'xAnimation', 'xParameter': _xAnimation});

		if (typeof(_xAnimation) == 'number') {return _xAnimation;}
		else if (typeof(_xAnimation) == 'string')
		{
			for (var i=0; i<this.axAnimations.length; i++)
			{
				if (this.axAnimations[i][PG_SPRITE_ANIMATION_INDEX_ID] == _xAnimation) {return i;}
			}
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sSpriteID [needed][type]string[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param iFileSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iFileSizeY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.init = function(_sSpriteID, _sFile, _iFileSizeX, _iFileSizeY)
	{
		if (typeof(_sFile) == 'undefined') {var _sFile = null;}
		if (typeof(_iFileSizeX) == 'undefined') {var _iFileSizeX = null;}
		if (typeof(_iFileSizeY) == 'undefined') {var _iFileSizeY = null;}

		_sFile = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'sFile', 'xParameter': _sFile});
		_iFileSizeX = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'iFileSizeX', 'xParameter': _iFileSizeX});
		_iFileSizeY = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'iFileSizeY', 'xParameter': _iFileSizeY});
		_sSpriteID = this.getRealParameter({'oParameters': _sSpriteID, 'sName': 'sSpriteID', 'xParameter': _sSpriteID});

		this.setID({'sID': _sSpriteID});
		this.sFile = _sFile;
		this.iFileSizeX = _iFileSizeX;
		this.iFileSizeY = _iFileSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setFile = function(_sFile)
	{
		_sFile = this.getRealParameter({'oParameters': _sFile, 'sName': 'sFile', 'xParameter': _sFile});
		this.sFile = _sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFile [type]string[/type]
	[en]...[/en]
	*/
	this.getFile = function() {return this.sFile;}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setFileSizeX = function(_iSizeX)
	{
		_iSizeX = this.getRealParameter({'oParameters': _iSizeX, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		this.iFileSizeX = _iSizeX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeX [type]int[/type]
	[en]...[/en]
	*/
	this.getFileSizeX = function() {return this.iFileSizeX;}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	*/
	this.setFileSizeY = function(_iSizeY)
	{
		_iSizeY = this.getRealParameter({'oParameters': _iSizeY, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		this.iFileSizeY = _iSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeY [type]int[/type]
	[en]...[/en]
	*/
	this.getFileSizeY = function() {return this.iFileSizeY;}
	/* @end method */
	
	/*
	@start method
	
	@param xAnimation [type]mixed[/type]
	[en]...[/en]
	*/
	this.update = function(_xAnimation)
	{
		if (typeof(_xAnimation) == 'undefined') {var _xAnimation = null;}

		_xAnimation = this.getRealParameter({'oParameters': _xAnimation, 'sName': 'xAnimation', 'xParameter': _xAnimation});

		if ((this.sCurrentAnimationName != '') && (_xAnimation == null)) {_xAnimation = this.sCurrentAnimationName;}
		if (_xAnimation == null)
		{
			_xAnimation = -1;
			if (this.axAnimations.length > 0)
			{
				this.sCurrentAnimationName = this.axAnimations[0][PG_SPRITE_ANIMATION_INDEX_ID];
				_xAnimation = this.getAnimationIndex(this.sCurrentAnimationName);
			}
		}
		
		
		var _oDiv = this.oDocument.getElementById(this.getID());
		var _oImg = this.oDocument.getElementById(this.getID()+'Img');
		if ((_oDiv) && (_oImg))
		{
			var _iFullSizeX = Math.ceil(this.iFileSizeX*this.dScale);
			var _iFullSizeY = Math.ceil(this.iFileSizeY*this.dScale);
			var _iIndex = this.getAnimationIndex({'xAnimation': _xAnimation});
			if ((_iIndex >= 0) && (_iIndex < this.axAnimations.length))
			{
				var _iStepSizeX = Math.ceil(this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_X]*this.dScale);
				var _iStepSizeY = Math.ceil(this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_Y]*this.dScale);
				var _iStepStartPosX = Math.ceil(this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STARTPOS_X]*this.dScale);
				var _iStepStartPosY = Math.ceil(this.axAnimations[_iIndex][PG_SPRITE_ANIMATION_INDEX_STARTPOS_Y]*this.dScale);
	
				var _iNewPosSubX = -(_iStepStartPosX+(this.iCurrentAnimationStepX*_iStepSizeX));
				var _iNewPosSubY = -(_iStepStartPosY+(this.iCurrentAnimationStepY*_iStepSizeY));

				_oDiv.style.width = _iStepSizeX+'px';
				_oDiv.style.height = _iStepSizeY+'px';
			
				_oImg.style.left = _iNewPosSubX+'px';
				_oImg.style.top = _iNewPosSubY+'px';
			}
			else
			{
				_oDiv.style.width = _iFullSizeX+'px';
				_oDiv.style.height = _iFullSizeY+'px';
				
				_oImg.style.left = '0px';
				_oImg.style.top = '0px';
			}
			_oDiv.style.left = (this.iPosX-(this.iOffsetX*this.dScale)+this.iOffsetX)+'px';
			_oDiv.style.top = (this.iPosY-(this.iOffsetY*this.dScale)+this.iOffsetY)+'px';

			_oImg.style.width = _iFullSizeX+'px';
			_oImg.style.height = _iFullSizeY+'px';
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@return oSpriteDiv [type]object[/type]
	[en]...[/en]
	*/
	this.build = function()
	{
		var _oDiv = this.oDocument.createElement('div');
		if (_oDiv)
		{
			_oDiv.id = this.getID();
			_oDiv.style.position = this.sCssPosition;
			_oDiv.style.overflow = 'hidden';
			_oDiv.style.display = 'block';
			if (this.axAnimations.length > 0)
			{
				this.sCurrentAnimationName = this.axAnimations[0][PG_SPRITE_ANIMATION_INDEX_ID];
				_oDiv.style.width = Math.ceil(this.axAnimations[0][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_X]*this.dScale)+'px';
				_oDiv.style.height = Math.ceil(this.axAnimations[0][PG_SPRITE_ANIMATION_INDEX_STEPSIZE_Y]*this.dScale)+'px';
			}
			else
			{
				_oDiv.style.width = Math.ceil(this.iFileSizeX*this.dScale)+'px';
				_oDiv.style.height = Math.ceil(this.iFileSizeY*this.dScale)+'px';
			}
			
			var _oImg = this.oDocument.createElement('img');
			if (_oImg)
			{
				_oImg.id = this.getID()+'Img';
				_oImg.src = this.sFile;
				_oImg.style.position = 'relative';
				if (this.axAnimations.length > 0)
				{
					_oImg.style.left = -Math.ceil(this.axAnimations[0][PG_SPRITE_ANIMATION_INDEX_STARTPOS_X]*this.dScale)+'px';
					_oImg.style.top = -Math.ceil(this.axAnimations[0][PG_SPRITE_ANIMATION_INDEX_STARTPOS_Y]*this.dScale)+'px';
				}
				else
				{
					_oImg.style.left = '0px';
					_oImg.style.top = '0px';
				}
				_oImg.style.width = Math.ceil(this.iFileSizeX*this.dScale)+'px';
				_oImg.style.height = Math.ceil(this.iFileSizeY*this.dScale)+'px';
				_oImg.style.borderWidth = '0px';
				_oDiv.appendChild(_oImg);
			}
		}
		return _oDiv;
	}
	/* @end method */
}
/* @end class */
classPG_Sprite.prototype = new classPG_ClassBasics();
