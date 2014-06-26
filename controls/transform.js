/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Feb 10 2012
*/
var PG_TRANSFORM_GROUPMODE_SIMPLE = 0;
var PG_TRANSFORM_GROUPMODE_GROUPED = 1;

var PG_TRANSFORM_MOVEMODE_NORMAL = 0;
var PG_TRANSFORM_MOVEMODE_SPEEDUP = 1;
var PG_TRANSFORM_MOVEMODE_SLOWDOWN = 2;
var PG_TRANSFORM_MOVEMODE_SYNC = 3;

var PG_TRANSFORM_ENDMODE_NONE = 0;
var PG_TRANSFORM_ENDMODE_BOUNCE = 1;

function classPG_Transform()
{
	// Declarations...
	this.iGridX = 0;
	this.iGridY = 0;
	
	this.iSpeed = 1;
	this.iGroupMode = PG_TRANSFORM_GROUPMODE_SIMPLE;
	this.iMoveMode = PG_TRANSFORM_MOVEMODE_NORMAL;
	
	this.iLastPosX = 0;
	this.iLastPosY = 0;
	this.iOffsetX = 0;
	this.iOffsetY = 0;
	
	this.iBounceDist = 0;
	this.iBounceTimes = 0;
	
	this.axElement = new Array();
	
	// Construct...
	// this.setID({'sID': 'PGTransform'});

	// Methods...
	this.setElements = function(_axElements)
	{
		_axElements = this.getRealParameter({'oParameters': _axElements, 'sName': 'axElements', 'xParameter': _axElements});
		this.axElement = _axElements;
	}
	
	this.addElement = function(_xElement)
	{
		this.axElement.push(_xElement);
		return this.axElement.length-1;
	}
	
	this.removeElement = function(_xElement)
	{
		for (var i=0; i<this.axElement.length; i++)
		{
		}
	}
	
	this.moveTo = function(_iMoveX, _iMoveY)
	{
	}
	
	this.move = function(_iMoveX, _iMoveY)
	{
	}
	
	this.setSize = function(_iSizeX, _iSizeY)
	{
	}
	
	this.addSize = function(_iSizeX, _iSizeY)
	{
	}
	
	this.setPos = function(_iPosX, _iPosY)
	{
	}
	
	this.addPos = function(_iPosX, _iPosY)
	{
	}
}
