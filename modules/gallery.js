/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* Dual licensed under the MIT or GPL Version 2 licenses.
* http://api.progade.de/license/
*
* Last changes of this file: Feb 10 2012
*/
var PG_GALLERY_DETAIL_AJAX_REQUEST_TYPE = 'PG_GalleryDetailRequest';

var PG_GALLERY_PREVIEW_LAYOUT_SIMPLE_LIST = 0;
var PG_GALLERY_PREVIEW_LAYOUT_DETAIL_LIST = 1;
var PG_GALLERY_PREVIEW_LAYOUT_COMPACT = 2;
var PG_GALLERY_PREVIEW_LAYOUT_DETAIL = 3;
var PG_GALLERY_PREVIEW_LAYOUT_SCROLLING_HORIZONTAL = 4;	// TODO
var PG_GALLERY_PREVIEW_LAYOUT_SCROLLING_VERTICAL = 5;	// TODO
var PG_GALLERY_PREVIEW_LAYOUT_FILMSTRIP_HORIZONTAL = 6;	// TODO
var PG_GALLERY_PREVIEW_LAYOUT_FILMSTRIP_VERTICAL = 7;	// TODO

var PG_GALLERY_DETAIL_LAYOUT_POPUP = 0;
var PG_GALLERY_DETAIL_LAYOUT_SELF = 1;
var PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE = 2;
var PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION = 3;
var PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_HORIZONTAL = 4;	// TODO
var PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_VERTICAL = 5;	// TODO
var PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_3D = 6;			// TODO

function classPG_Gallery()
{
	// Declarations...
	this.sContainerID = '';

	this.iPreviewLayout = PG_GALLERY_PREVIEW_LAYOUT_COMPACT;
	this.iDetailLayout = PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE;
	
	this.iScreenSizeX = 0;
	this.iScreenSizeY = 0;

	this.iContainerPosX = 0;
	this.iContainerPosY = 0;
	this.iContainerSizeX = 0;
	this.iContainerSizeY = 0;
	
	this.iDetailZIndex = 999999;
	this.iDetailFilesScrollCount = 3;
	this.iDetailFilesScrollSpeedDist = 10;
	this.iDetailFilesScrollSpeedTimeout = 100;
	this.iDetailFilesCurrentScrollSpeedX = 0;
	this.iDetailFilesCurrentScrollSpeedY = 0;
	
	this.iDetailBackgroundOpacityMax = 70;
	this.iDetailBackgroundOpacity = 0;
	this.iDetailBackgroundFadeOpacity = 20;
	this.iDetailBackgroundFadeTimeout = 100;
	
	this.asDetailGalleryFiles = new Array();
	this.iDetailsGalleryFilesIndex = 0;
	this.iDetailsGalleryFilesCatIndex = 0;
	
	//this.bFoldersAreCategories = false;
	this.bDetailFileInfoDisplay = false;
	
	this.sDetailNavigationImagePath = '';
	this.sDetailNavigationImageNameNext = 'detail_next.png';
	this.sDetailNavigationImageNamePrevious = 'detail_previous.png';
	// this.sDetailFileUrl = '';
	
	// Construct...
	this.setID('PGGallery');
	this.initClassBasics();
	this.setText();
	
	// Methods...
	this.setDetailFileInfoDisplay = function(_bDisplay) {this.bDetailFileInfoDisplay = _bDisplay;}
	this.getDetailFileInfoDisplay = function() {return this.bDetailFileInfoDisplay;}
	
	//this.setFoldersToCategories = function(_bCategories) {this.bFoldersAreCategories = _bCategories;}
	//this.isFoldersToCategories = function() {return this.bFoldersAreCategories;}
	
	this.setDetailZIndex = function(_iZIndex)
	{
		this.iDetailZIndex = _iZIndex;
		
		var _oGalleryDetailBackground = this.oDocument.getElementById('PG_GalleryDetailBackground');
		if (_oGalleryDetailBackground) {_oGalleryDetailBackground.style.zIndex = this.iDetailZIndex;}
		
		var _oGalleryDetailImage = this.oDocument.getElementById('PG_GalleryDetailImage');
		if (_oGalleryDetailImage) {_oGalleryDetailImage.style.zIndex = this.iDetailZIndex+1;}
		
		var _oGalleryDetailNavigationLeftOverlay = this.oDocument.getElementById('PG_GalleryDetailNavigationLeftOverlay');
		if (_oGalleryDetailNavigationLeftOverlay) {_oGalleryDetailNavigationLeftOverlay.style.zIndex = this.iDetailZIndex+2;}
		
		var _oGalleryDetailNavigationRightOverlay = this.oDocument.getElementById('PG_GalleryDetailNavigationRightOverlay');
		if (_oGalleryDetailNavigationRightOverlay) {_oGalleryDetailNavigationRightOverlay.style.zIndex = this.iDetailZIndex+2;}
		
		var _oGalleryDetailNavigationLeftImage = this.oDocument.getElementById('PG_GalleryDetailNavigationLeftImage');
		if (_oGalleryDetailNavigationLeftImage) {_oGalleryDetailNavigationLeftImage.style.zIndex = this.iDetailZIndex+3;}
		
		var _oGalleryDetailNavigationRightImage = this.oDocument.getElementById('PG_GalleryDetailNavigationRightImage');
		if (_oGalleryDetailNavigationRightImage) {_oGalleryDetailNavigationRightImage.style.zIndex = this.iDetailZIndex+3;}
	}
	this.getDetailZIndex = function() {return this.iDetailZIndex;}

	this.setDetailNavigationImageNameNext = function(_sImage) {this.sDetailNavigationImageNameNext = _sImage;}
	this.getDetailNavigationImageNameNext = function() {return this.sDetailNavigationImageNameNext;}
	this.setDetailNavigationImageNamePrevious = function(_sImage) {this.sDetailNavigationImageNamePrevious = _sImage;}
	this.getDetailNavigationImageNamePrevious = function() {return this.sDetailNavigationImageNamePrevious;}

	this.setDetailNavigationImagePath = function(_sPath) {this.sDetailNavigationImagePath = _sPath;}
	this.getDetailNavigationImagePath = function() {return this.sDetailNavigationImagePath;}
	
	this.setDetailFilesScrollCount = function(_iCount) {this.iDetailFilesScrollCount = _iCount;}
	this.getDetailFilesScrollCount = function() {return this.iDetailFilesScrollCount;}
	this.setDetailFilesScrollSpeedDist = function(_iDist) {this.iDetailFilesScrollSpeedDist = _iDist;}
	this.getDetailFilesScrollSpeedDist = function() {return this.iDetailFilesScrollSpeedDist;}
	this.setDetailFilesScrollSpeedTimeout = function(_iMilliseconds) {this.iDetailFilesScrollSpeedTimeout = _iMilliseconds;}
	this.getDetailFilesScrollSpeedTimeout = function() {return this.iDetailFilesScrollSpeedTimeout;}
	
	this.setDetailBackgroundOpacity = function(_iPercent) {this.iDetailBackgroundOpacityMax = _iPercent;}
	this.setDetailBackgroundFadeOpacity = function(_iPercentPerStep) {this.iDetailBackgroundFadeOpacity = _iPercentPerStep;}
	this.setDetailBackgroundFadeTimeout = function(_iMilliseconds) {this.iDetailBackgroundFadeTimeout = _iMilliseconds;}
	
	this.setPreviewLayout = function(_iPreviewLayout) {this.iPreviewLayout = _iPreviewLayout;}
	this.getPreviewLayout = function() {return this.iPreviewLayout;}
	this.setDetailLayout = function(_iDetailLayout) {this.iDetailLayout = _iDetailLayout;}
	this.getDetailLayout = function() {return this.iDetailLayout;}
	
	this.setDetailFiles = function(_asFiles) {this.asDetailGalleryFiles = _asFiles;}
	this.addDetailFiles = function(_iCategorieIndex, _asFiles)
	{
		if ((this.asDetailGalleryFiles.length > _iCategorieIndex) && (_iCategorieIndex >= 0)) {this.asDetailGalleryFiles[_iCategorieIndex] = this.asDetailGalleryFiles[_iCategorieIndex].concat(_asFiles);}
		else {alert('Categorie ('+_iCategorieIndex+') for files out of index range');}
	}
	this.addDetailFile = function(_iCategorieIndex, _sFile)
	{
		if ((this.asDetailGalleryFiles.length > _iCategorieIndex) && (_iCategorieIndex >= 0)) {this.asDetailGalleryFiles[_iCategorieIndex].push(_sFile);}
		else {alert('Categorie ('+_iCategorieIndex+') for files out of index range');}
	}
	this.getDetailFiles = function() {return this.asDetailGalleryFiles;}
	
	this.addDetailFilesKategorie = function()
	{
		this.asDetailGalleryFiles.push(new Array());
		return this.asDetailGalleryFiles.length-1;
	}
	
	this.init = function(_sContainerID)
	{
		var _oContainer = null;
		if (_sContainerID != null)
		{
			this.sContainerID = _sContainerID;
			_oContainer = this.oDocument.getElementById(this.sContainerID);
		}
		else {_oContainer = this.oDocument.body;}
		var _sHTML = '<div id="PG_GalleryDetailBackground" style="position:fixed; z-index:'+this.iDetailZIndex+'; top:0px; left:0px; display:none; background-color:#000000;" onclick="oPGGallery.hideDetail();"></div>';
		if ((this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_HORIZONTAL)
		|| (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_VERTICAL))
		{
			if (this.asDetailGalleryFiles.length > 0)
			{
				for (var i=0; i<this.asDetailGalleryFiles[0].length; i++)
				{
					_sHTML += '<img src="PG_GalleryDetailImage'+i+'" src="'+this.asDetailGalleryFiles[0][i]+'" ';
					_sHTML += 'style="position:fixed; z-index:'+(this.iDetailZIndex+1)+'; top:0px; left:0px; display:none; border-width:0px;" ';
					_sHTML += 'onclick="oPGGallery.hideDetail();" />';
				}
			}
		}
		else
		{
			_sHTML += '<img id="PG_GalleryDetailImage" src="#" style="position:fixed; z-index:'+(this.iDetailZIndex+1)+'; top:0px; left:0px; display:none; border-width:0px;" onclick="';
			if (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE) {_sHTML += 'oPGGallery.hideDetail(); ';}
			else if (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION) {_sHTML += 'oPGGallery.clickDetailNavigation(); ';}
			_sHTML += '" />';
			_sHTML += '<div id="PG_GalleryDetailFileInfoOverlay" style="position:fixed; z-index:'+(this.iDetailZIndex+4)+'; top:0px; left:0px; display:none; background-color:#ffffff;"></div>';
			_sHTML += '<div id="PG_GalleryDetailNavigationLeftOverlay" src="'+this.sDetailNavigationImagePath+this.sDetailNavigationImageNamePrevious+'" style="position:fixed; z-index:'+(this.iDetailZIndex+2)+'; top:0px; left:0px; display:none; background-color:#ffffff;" onclick="oPGGallery.clickDetailNavigation();"></div>';
			_sHTML += '<div id="PG_GalleryDetailNavigationRightOverlay" src="'+this.sDetailNavigationImagePath+this.sDetailNavigationImageNameNext+'" style="position:fixed; z-index:'+(this.iDetailZIndex+2)+'; top:0px; left:0px; display:none; background-color:#ffffff;" onclick="oPGGallery.clickDetailNavigation();"></div>';
			_sHTML += '<img id="PG_GalleryDetailNavigationLeftImage" src="'+this.sDetailNavigationImagePath+this.sDetailNavigationImageNamePrevious+'" style="position:fixed; z-index:'+(this.iDetailZIndex+3)+'; top:0px; left:0px; display:none; border-width:0px;" onclick="oPGGallery.clickDetailNavigation();" />';
			_sHTML += '<img id="PG_GalleryDetailNavigationRightImage" src="'+this.sDetailNavigationImagePath+this.sDetailNavigationImageNameNext+'" style="position:fixed; z-index:'+(this.iDetailZIndex+3)+'; top:0px; left:0px; display:none; border-width:0px;" onclick="oPGGallery.clickDetailNavigation();" />';
		}
		if (_oContainer) {_oContainer.innerHTML += _sHTML;}
		else {alert('ERROR: Can\'t init gallery!');}
	}
	
	this.checkDetailNavigation = function()
	{
		if (typeof(oPGMouse) != 'undefined')
		{
			var _oImg = this.oDocument.getElementById('PG_GalleryDetailImage');
			if (_oImg)
			{
				var _iMousePosX = oPGMouse.getViewPosX();
				var _iMousePosY = oPGMouse.getViewPosY();
				
				var _iImgPosX = parseInt(_oImg.style.left);
				var _iImgPosY = parseInt(_oImg.style.top);
				var _iImgSizeX = parseInt(_oImg.style.width);
				var _iImgSizeY = parseInt(_oImg.style.height);
				
				if ((_iMousePosX >= _iImgPosX) && (_iMousePosY >= _iImgPosY)
				&& (_iMousePosX <= _iImgPosX+Math.floor(_iImgSizeX/2))
				&& (_iMousePosY <= _iImgPosY+_iImgSizeY))
				{
					return 'left';
				}
				else if ((_iMousePosX >= _iImgPosX+Math.floor(_iImgSizeX/2))
				&& (_iMousePosY >= _iImgPosY)
				&& (_iMousePosX <= _iImgPosX+_iImgSizeX)
				&& (_iMousePosY <= _iImgPosY+_iImgSizeY))
				{
					return 'right';
				}
			}
		}
		return false;
	}
	
	this.checkDetailFileMouseOver = function()
	{
		if (typeof(oPGMouse) != 'undefined')
		{
			var _oImg = this.oDocument.getElementById('PG_GalleryDetailImage');
			if (_oImg)
			{
				var _iMousePosX = oPGMouse.getViewPosX();
				var _iMousePosY = oPGMouse.getViewPosY();
				
				var _iImgPosX = parseInt(_oImg.style.left);
				var _iImgPosY = parseInt(_oImg.style.top);
				var _iImgSizeX = parseInt(_oImg.style.width);
				var _iImgSizeY = parseInt(_oImg.style.height);
				
				if ((_iMousePosX >= _iImgPosX) && (_iMousePosY >= _iImgPosY)
				&& (_iMousePosX <= _iImgPosX+_iImgSizeX)
				&& (_iMousePosY <= _iImgPosY+_iImgSizeY))
				{
					return true;
				}
			}
		}
		return false;
	}
	
	this.runDetailFileInfo = function()
	{
		if (this.bDetailFileInfoDisplay == true)
		{
			var _oFileInfoOverlay = this.oDocument.getElementById('PG_GalleryDetailFileInfoOverlay');
			if (_oFileInfoOverlay)
			{
				if (this.checkDetailFileMouseOver()) {_oFileInfoOverlay.style.display = 'block';}
				else {_oFileInfoOverlay.style.display = 'none';}
			}
		}
	}
	
	this.runDetailScrolling = function()
	{
		if (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_HORIZONTAL)
		{
			var _oGalleryDetailImage = null;
			if (this.asDetailGalleryFiles.length > 0)
			{
				for (var i=0; i<this.asDetailGalleryFiles[0].length; i++)
				{
					_oGalleryDetailImage = this.oDocument.getElementById('PG_GalleryDetailImage'+i);
					if (_oGalleryDetailImage)
					{
						var _iPercentX = 100/this.iContainerSizeX*(_iMousePosX-this.iContainerPosX);
	
						_oGalleryDetailImage.style.left = (parseInt(_oGalleryDetailImage.style.left)+this.iDetailFilesCurrentScrollSpeedX)+'px';
						this.calculateDetailImageSize('PG_GalleryDetailImage'+i);
					}
				}
			}
		}
		else if (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_VERTICAL)
		{
			if (this.asDetailGalleryFiles.length > 0)
			{
				for (var i=0; i<this.asDetailGalleryFiles[0].length; i++)
				{
					_oGalleryDetailImage = this.oDocument.getElementById('PG_GalleryDetailImage'+i);
					if (_oGalleryDetailImage)
					{
						var _iPercentY = 100/this.iContainerSizeY*(_iMousePosY-this.iContainerPosY);
	
						_oGalleryDetailImage.style.top = (parseInt(_oGalleryDetailImage.style.top)+this.iDetailFilesCurrentScrollSpeedY)+'px';
						this.calculateDetailImageSize('PG_GalleryDetailImage'+i);
					}
				}
			}
		}
		window.setTimeout("oPGGallery.runDetailScrolling();", this.iDetailFilesScrollSpeedTimeout);
	}
	
	this.setDetailCurrentScrollSpeed = function(_iSpeedX, _iSpeedY)
	{
		if (_iSpeedX != null) {this.iDetailFilesCurrentScrollSpeedX = _iSpeedX;}
		if (_iSpeedY != null) {this.iDetailFilesCurrentScrollSpeedY = _iSpeedY;}
	}
	
	this.onMouseMove = function(_eEvent)
	{
		if (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION)
		{
			var _oGalleryDetailImage = this.oDocument.getElementById('PG_GalleryDetailImage');
			if (_oGalleryDetailImage)
			{
				if (_oGalleryDetailImage.style.display == 'block')
				{
					this.runDetailNavigation();
					this.runDetailFileInfo();
				}
			}
		}
		else if ((this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_HORIZONTAL)
		|| (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_VERTICAL))
		{
			var _oGalleryDetailImage = this.oDocument.getElementById('PG_GalleryDetailImage0');
			if (_oGalleryDetailImage)
			{
				if (_oGalleryDetailImage.style.display == 'block')
				{
					var _iMousePosX = oPGMouse.getPosX();
					var _iMousePosY = oPGMouse.getPosY();
					
					var _iPercentX = 100/this.iContainerSizeX*(_iMousePosX-this.iContainerPosX);
					var _iPercentY = 100/this.iContainerSizeY*(_iMousePosY-this.iContainerPosY);
					
					var _iSpeedX = 0;
					var _iSpeedY = 0;
					if ((_iPercentX < 40) || (_iPercentX > 60)) {_iSpeedX = Math.floor((_iPercentX-50)*this.iDetailFilesScrollSpeedDist/100);}
					if ((_iPercentY < 40) || (_iPercentY > 60)) {_iSpeedY = Math.floor((_iPercentY-50)*this.iDetailFilesScrollSpeedDist/100);}
					
					this.setDetailCurrentScrollSpeed(_iSpeedX, _iSpeedY);
				}
			}
		}
	}
	
	this.runDetailNavigation = function()
	{
		var _sClickedSide = this.checkDetailNavigation();
		var _oDetailNavigationLeftOverlay = this.oDocument.getElementById('PG_GalleryDetailNavigationLeftOverlay');
		var _oDetailNavigationRightOverlay = this.oDocument.getElementById('PG_GalleryDetailNavigationRightOverlay');
		var _oDetailNavigationLeftImage = this.oDocument.getElementById('PG_GalleryDetailNavigationLeftImage');
		var _oDetailNavigationRightImage = this.oDocument.getElementById('PG_GalleryDetailNavigationRightImage');
		if (_sClickedSide)
		{
			if ((_sClickedSide == 'left') && (this.iDetailsGalleryFilesIndex > 0))
			{
				if (_oDetailNavigationLeftOverlay) {_oDetailNavigationLeftOverlay.style.display = 'block'}
				if (_oDetailNavigationRightOverlay) {_oDetailNavigationRightOverlay.style.display = 'none'}
				if (_oDetailNavigationLeftImage) {_oDetailNavigationLeftImage.style.display = 'block'}
				if (_oDetailNavigationRightImage) {_oDetailNavigationRightImage.style.display = 'none'}
			}
			else if ((_sClickedSide == 'right') && (this.asDetailGalleryFiles[this.iDetailsGalleryFilesCatIndex].length > this.iDetailsGalleryFilesIndex+1))
			{
				if (_oDetailNavigationLeftOverlay) {_oDetailNavigationLeftOverlay.style.display = 'none'}
				if (_oDetailNavigationRightOverlay) {_oDetailNavigationRightOverlay.style.display = 'block'}
				if (_oDetailNavigationLeftImage) {_oDetailNavigationLeftImage.style.display = 'none'}
				if (_oDetailNavigationRightImage) {_oDetailNavigationRightImage.style.display = 'block'}
			}
			else
			{
				if (_oDetailNavigationLeftOverlay) {_oDetailNavigationLeftOverlay.style.display = 'none'}
				if (_oDetailNavigationRightOverlay) {_oDetailNavigationRightOverlay.style.display = 'none'}
				if (_oDetailNavigationLeftImage) {_oDetailNavigationLeftImage.style.display = 'none'}
				if (_oDetailNavigationRightImage) {_oDetailNavigationRightImage.style.display = 'none'}
			}
		}
		else
		{
			if (_oDetailNavigationLeftOverlay) {_oDetailNavigationLeftOverlay.style.display = 'none'}
			if (_oDetailNavigationRightOverlay) {_oDetailNavigationRightOverlay.style.display = 'none'}
			if (_oDetailNavigationLeftImage) {_oDetailNavigationLeftImage.style.display = 'none'}
			if (_oDetailNavigationRightImage) {_oDetailNavigationRightImage.style.display = 'none'}
		}
	}
	
	this.clickDetailNavigation = function()
	{
		var _sClickedSide = this.checkDetailNavigation();
		if (_sClickedSide)
		{
			if ((_sClickedSide == 'left') && (this.iDetailsGalleryFilesIndex > 0))
			{
				this.showDetail(this.iDetailsGalleryFilesCatIndex, this.iDetailsGalleryFilesIndex-1, this.asDetailGalleryFiles[this.iDetailsGalleryFilesCatIndex][this.iDetailsGalleryFilesIndex-1]);
			}
			else if ((_sClickedSide == 'right') && (this.asDetailGalleryFiles[this.iDetailsGalleryFilesCatIndex].length > this.iDetailsGalleryFilesIndex+1))
			{
				this.showDetail(this.iDetailsGalleryFilesCatIndex, this.iDetailsGalleryFilesIndex+1, this.asDetailGalleryFiles[this.iDetailsGalleryFilesCatIndex][this.iDetailsGalleryFilesIndex+1]);
			}
		}
		if (typeof(oPGBrowser) != 'undefined') {oPGBrowser.disableSelect();}
		return false;
	}
	
	this.hideDetail = function()
	{
		var _oBackground = this.oDocument.getElementById('PG_GalleryDetailBackground');
		if (_oBackground) {_oBackground.style.display = 'none';}
		
		var _oImg = this.oDocument.getElementById('PG_GalleryDetailImage');
		if (_oImg) {_oImg.style.display = 'none';}

		var _oFileInfoOverlay = this.oDocument.getElementById('PG_GalleryDetailFileInfoOverlay');
		if (_oFileInfoOverlay) {_oFileInfoOverlay.style.display = 'none';}

		var _oDetailNavigationLeftOverlay = this.oDocument.getElementById('PG_GalleryDetailNavigationLeftOverlay');
		var _oDetailNavigationRightOverlay = this.oDocument.getElementById('PG_GalleryDetailNavigationRightOverlay');
		var _oDetailNavigationLeftImage = this.oDocument.getElementById('PG_GalleryDetailNavigationLeftImage');
		var _oDetailNavigationRightImage = this.oDocument.getElementById('PG_GalleryDetailNavigationRightImage');
		if (_oDetailNavigationLeftOverlay) {_oDetailNavigationLeftOverlay.style.display = 'none'}
		if (_oDetailNavigationRightOverlay) {_oDetailNavigationRightOverlay.style.display = 'none'}
		if (_oDetailNavigationLeftImage) {_oDetailNavigationLeftImage.style.display = 'none'}
		if (_oDetailNavigationRightImage) {_oDetailNavigationRightImage.style.display = 'none'}
	}
	
	this.showDetail = function(_iCategorieID, _iFileID, _sURL)
	{
		this.iDetailsGalleryFilesCatIndex = _iCategorieID;
		this.iDetailsGalleryFilesIndex = _iFileID;
		var _oContainer = null;
		var _oImg = this.oDocument.getElementById('PG_GalleryDetailImage');
		if (_oImg) {_oImg.style.display = 'none';}

		var _oBackground = this.oDocument.getElementById('PG_GalleryDetailBackground');
		if (_oBackground)
		{
			// _oBackground.style.display = 'none';
			if (typeof(oPGGfx) != 'undefined')
			{
				if (_oBackground.style.display == 'none')
				{
					if (this.iDetailBackgroundFadeOpacity > 0)
					{
						this.iDetailBackgroundOpacity = 0;
						oPGGfx.setElementOpacity(_oBackground, 1);
					}
					else
					{
						this.iDetailBackgroundOpacity = this.iDetailBackgroundOpacityMax;
						oPGGfx.setElementOpacity(_oBackground, this.iDetailBackgroundOpacityMax);
					}
				}
			}
			
			if (this.sContainerID != '')
			{
				_oContainer = this.oDocument.getElementById(this.sContainerID);
				if (_oContainer)
				{
					this.iContainerPosX = oPGBrowser.getDocumentOffsetX(_oContainer);
					this.iContainerPosY = oPGBrowser.getDocumentOffsetY(_oContainer);
					this.iContainerSizeX = parseInt(_oContainer.offsetWidth);
					this.iContainerSizeY = parseInt(_oContainer.offsetHeight);
				}
			}
			else
			{
				_oContainer = this.oDocument.body;
				if (_oContainer)
				{
					this.iContainerPosX = 0;
					this.iContainerPosY = 0;
					var _oScreenSize = oPGBrowser.getScreenSize();
					if (_oScreenSize)
					{
						this.iContainerSizeX = _oScreenSize.x;
						this.iContainerSizeY = _oScreenSize.y;
					}
				}
			}

			_oBackground.style.left = this.iContainerPosX+'px';
			_oBackground.style.top = this.iContainerPosY+'px';
			if (this.sContainerID != '')
			{
				_oBackground.style.width = this.iContainerSizeX+'px';
				_oBackground.style.height = this.iContainerSizeY+'px';
			}
			else
			{
				_oContainer = this.oDocument.body;
				if (_oContainer)
				{
					_oBackground.style.width = '100%';
					_oBackground.style.height = '100%';
				}
			}
			_oBackground.style.display = 'block';
		}

		// if (_oImg) {_oImg.src = _sURL;}
		if (_oImg)
		{
			var _oFileInfoOverlay = this.oDocument.getElementById('PG_GalleryDetailFileInfoOverlay');
			if (_oFileInfoOverlay) {_oFileInfoOverlay.innerHTML = _sURL;}
			var _sHTML = '<img id="PG_GalleryDetailImage" src="'+_sURL+'" style="position:fixed; z-index:'+(this.iDetailZIndex+1)+'; top:0px; left:0px; display:none; border-width:0px;" onclick="';
			if (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE) {_sHTML += 'oPGGallery.hideDetail(); ';}
			else if (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION) {_sHTML += 'oPGGallery.clickDetailNavigation(); ';}
			_sHTML += '" />';
			_oImg.outerHTML = _sHTML;
		}
		if (this.iDetailBackgroundFadeOpacity > 0)
		{
			window.setTimeout("oPGGallery.runDetailBackgroundOpacityFade()", this.iDetailBackgroundFadeTimeout);
		}
		else {this.showDetailImage();}
	}
	
	this.showDetailImage = function()
	{
		if ((this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION)
		|| (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE))
		{
			var _oImg = this.oDocument.getElementById('PG_GalleryDetailImage');
			if (_oImg)
			{
				if (_oImg.complete == true)
				{
					_oImg.style.display = 'block';
					this.calculateDetailImageSize('PG_GalleryDetailImage');
					this.runDetailNavigation();
				}
				else {window.setTimeout("oPGGallery.showDetailImage()", 100);}
			}
		}
		else if ((this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_HORIZONTAL)
		|| (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_VERTICAL))
		{
			if (this.asDetailGalleryFiles.length > 0)
			{
				for (var i=0; i<this.asDetailGalleryFiles[0].length; i++)
				{
					var _oImg = this.oDocument.getElementById('PG_GalleryDetailImage'+i);
					if (_oImg) {_oImg.style.display = 'block';}
					this.calculateDetailImageSize('PG_GalleryDetailImage'+i);
				}
			}
		}
	}
	
	this.calculateDetailImageSize = function(_sImageID)
	{
		if (this.sContainerID == '')
		{
			_oContainer = this.oDocument.body;
			if (_oContainer)
			{
				this.iContainerPosX = 0;
				this.iContainerPosY = 0;
				var _oScreenSize = oPGBrowser.getScreenSize();
				if (_oScreenSize)
				{
					this.iContainerSizeX = _oScreenSize.x;
					this.iContainerSizeY = _oScreenSize.y;
				}
			}
			
			var _oImg = this.oDocument.getElementById(_sImageID);
			if (_oImg)
			{
				if (_oImg.style.display == 'block')
				{
					if (typeof(_oImg.style.removeAttribute) != 'undefined')
					{
						_oImg.style.removeAttribute('width', false);
						_oImg.style.removeAttribute('height', false);
					}
					else
					{
						_oImg.style.width = '';
						_oImg.style.height = '';
					}
					
					var _iOriginSizeX = parseInt(_oImg.offsetWidth);
					var _iOriginSizeY = parseInt(_oImg.offsetHeight);
					
					if ((parseInt(_oImg.offsetWidth) > this.iContainerSizeX-50) && (parseInt(_oImg.offsetHeight) <= this.iContainerSizeY-50))
					{
						_oImg.style.width = Math.max((this.iContainerSizeX-50), 5)+'px';
						_oImg.style.height = Math.floor(_iOriginSizeY/_iOriginSizeX*(this.iContainerSizeX-50))+'px';
					}
					else if ((parseInt(_oImg.offsetHeight) > this.iContainerSizeY-50) && (parseInt(_oImg.offsetWidth) <= this.iContainerSizeX-50))
					{
						_oImg.style.height = Math.max((this.iContainerSizeY-50), 5)+'px';
						_oImg.style.width = Math.floor(_iOriginSizeX/_iOriginSizeY*(this.iContainerSizeY-50))+'px';
					}
					else if ((parseInt(_oImg.offsetWidth) > this.iContainerSizeX-50) && (parseInt(_oImg.offsetHeight) > this.iContainerSizeY-50))
					{
						var _iDiffX = parseInt(_oImg.offsetWidth) - (this.iContainerSizeX-50);
						var _iDiffY = parseInt(_oImg.offsetHeight) - (this.iContainerSizeY-50);
						if (_iDiffX >= _iDiffY)
						{
							_oImg.style.width = Math.max((this.iContainerSizeX-50), 5)+'px';
							_oImg.style.height = Math.floor(_iOriginSizeY/_iOriginSizeX*(this.iContainerSizeX-50))+'px';
						}
						else
						{
							_oImg.style.height = Math.max((this.iContainerSizeY-50), 5)+'px';
							_oImg.style.width = Math.floor(_iOriginSizeX/_iOriginSizeY*(this.iContainerSizeY-50))+'px';
						}
					}
					else
					{
						_oImg.style.width = parseInt(_oImg.offsetWidth)+'px';
						_oImg.style.height = parseInt(_oImg.offsetHeight)+'px';
					}
										
					_oImg.style.left = Math.floor((this.iContainerSizeX-parseInt(_oImg.offsetWidth))/2)+'px';
					_oImg.style.top = Math.floor((this.iContainerSizeY-parseInt(_oImg.offsetHeight))/2)+'px';

					if (this.bDetailFileInfoDisplay == true)
					{
						var _oFileInfoOverlay = this.oDocument.getElementById('PG_GalleryDetailFileInfoOverlay');
						if (_oFileInfoOverlay)
						{
							_oFileInfoOverlay.style.display = 'block';
							// _oFileInfoOverlay.style.left = Math.floor((parseInt(_oImg.style.left)+parseInt(_oImg.style.width)-parseInt(_oFileInfoOverlay.offsetWidth))/2)+'px';
							_oFileInfoOverlay.style.left = parseInt(_oImg.style.left)+'px';
							_oFileInfoOverlay.style.top = parseInt(_oImg.style.top)+'px';
						}
					}
						
					if (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION)
					{
						var _oDetailNavigationLeftOverlay = this.oDocument.getElementById('PG_GalleryDetailNavigationLeftOverlay');
						if (_oDetailNavigationLeftOverlay)
						{
							if (typeof(oPGGfx) != 'undefined') {oPGGfx.setElementOpacity(_oDetailNavigationLeftOverlay, 20);}
							else {_oDetailNavigationLeftOverlay.style.backgroundColor = 'transparent';}
							_oDetailNavigationLeftOverlay.style.display = 'block';
							_oDetailNavigationLeftOverlay.style.left = parseInt(_oImg.style.left)+'px';
							_oDetailNavigationLeftOverlay.style.top = parseInt(_oImg.style.top)+'px';
							_oDetailNavigationLeftOverlay.style.width = Math.floor(parseInt(_oImg.style.width)/2)+'px';
							_oDetailNavigationLeftOverlay.style.height = parseInt(_oImg.style.height)+'px';
							_oDetailNavigationLeftOverlay.style.display = 'none';
						}
						
						var _oDetailNavigationRightOverlay = this.oDocument.getElementById('PG_GalleryDetailNavigationRightOverlay');
						if (_oDetailNavigationRightOverlay)
						{
							if (typeof(oPGGfx) != 'undefined') {oPGGfx.setElementOpacity(_oDetailNavigationRightOverlay, 20);}
							else {_oDetailNavigationRightOverlay.style.backgroundColor = 'transparent';}
							_oDetailNavigationRightOverlay.style.display = 'block';
							_oDetailNavigationRightOverlay.style.left = (parseInt(_oImg.style.left)+Math.floor(parseInt(_oImg.style.width)/2))+'px';
							_oDetailNavigationRightOverlay.style.top = parseInt(_oImg.style.top)+'px';
							_oDetailNavigationRightOverlay.style.width = Math.floor(parseInt(_oImg.style.width)/2)+'px';
							_oDetailNavigationRightOverlay.style.height = parseInt(_oImg.style.height)+'px';
							
							_oDetailNavigationRightOverlay.style.display = 'none';
						}
	
						var _oDetailNavigationLeftImage = this.oDocument.getElementById('PG_GalleryDetailNavigationLeftImage');
						if (_oDetailNavigationLeftImage)
						{
							_oDetailNavigationLeftImage.style.display = 'block';
							_oDetailNavigationLeftImage.style.left = (parseInt(_oImg.style.left)+5)+'px';
							_oDetailNavigationLeftImage.style.top = (parseInt(_oImg.style.top)+Math.floor((parseInt(_oImg.style.height)-parseInt(_oDetailNavigationLeftImage.offsetHeight))/2))+'px';
							_oDetailNavigationLeftImage.style.display = 'none';
						}
						
						var _oDetailNavigationRightImage = this.oDocument.getElementById('PG_GalleryDetailNavigationRightImage');
						if (_oDetailNavigationRightImage)
						{
							_oDetailNavigationRightImage.style.display = 'block';
							_oDetailNavigationRightImage.style.left = (parseInt(_oImg.style.left)+parseInt(_oImg.style.width)-parseInt(_oDetailNavigationRightImage.offsetWidth)-5)+'px';
							_oDetailNavigationRightImage.style.top = (parseInt(_oImg.style.top)+Math.floor((parseInt(_oImg.style.height)-parseInt(_oDetailNavigationRightImage.offsetHeight))/2))+'px';
							_oDetailNavigationRightImage.style.display = 'none';
						}
					}
				}
			}
		}
	}
	
	this.onResize = function()
	{
		if (typeof(oPGBrowser) != 'undefined')
		{
			var _iCurrentScreenSizeX = oPGBrowser.getScreenSizeX();
			var _iCurrentScreenSizeY = oPGBrowser.getScreenSizeY();
			if ((this.iScreenSizeX != _iCurrentScreenSizeX) || (this.iScreenSizeY != _iCurrentScreenSizeY))
			{
				this.iScreenSizeX = _iCurrentScreenSizeX;
				this.iScreenSizeY = _iCurrentScreenSizeY;
				if ((this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_NAVIGATION)
				|| (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SIMPLE))
				{
					this.calculateDetailImageSize('PG_GalleryDetailImage');
				}
				else if ((this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_HORIZONTAL)
				|| (this.iDetailLayout == PG_GALLERY_DETAIL_LAYOUT_OVERLAY_SCROLLING_VERTICAL))
				{
					if (this.asDetailGalleryFiles.length > 0)
					{
						for (var i=0; i<this.asDetailGalleryFiles[0].length; i++)
						{
							this.calculateDetailImageSize('PG_GalleryDetailImage'+i);
						}
					}
				}
			}
		}
	}
	
	this.runDetailBackgroundOpacityFade = function()
	{
		if (typeof(oPGGfx) != 'undefined')
		{
			if (this.iDetailBackgroundOpacity < this.iDetailBackgroundOpacityMax)
			{
				if (this.iDetailBackgroundFadeOpacity > 0) {this.iDetailBackgroundOpacity += this.iDetailBackgroundFadeOpacity;}
				else {this.iDetailBackgroundOpacity = this.iDetailBackgroundOpacityMax;}
				
				if (this.iDetailBackgroundOpacity >= this.iDetailBackgroundOpacityMax)
				{
					this.iDetailBackgroundOpacity = this.iDetailBackgroundOpacityMax;
					this.showDetailImage();
				}
				
				var _oBackground = this.oDocument.getElementById('PG_GalleryDetailBackground');
				if (_oBackground) {oPGGfx.setElementOpacity(_oBackground, this.iDetailBackgroundOpacity);}
				
				if (this.iDetailBackgroundOpacity < this.iDetailBackgroundOpacityMax)
				{
					window.setTimeout("oPGGallery.runDetailBackgroundOpacityFade()", this.iDetailBackgroundFadeTimeout);
				}
			}
			else {this.showDetailImage();}
		}
	}
}
classPG_Gallery.prototype = new classPG_ClassBasics();

var oPGGallery = new classPG_Gallery();
