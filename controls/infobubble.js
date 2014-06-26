function classPG_InfoBubble()
{
	this.show = function(_sInfoBubbleID)
	{
		_sInfoBubbleID = this.getRealParameter({'oParameters': _sInfoBubbleID, 'sName': 'sInfoBubbleID', 'xParameter': _sInfoBubbleID});

		var _oInfoBubble = this.oDocument.getElementById(_sInfoBubbleID);
		var _oInfoBubbleAnchor = this.oDocument.getElementById(_sInfoBubbleID+'Anchor');
		if ((_oInfoBubble) && (_oInfoBubbleAnchor))
		{
			_oInfoBubble.style.display = 'inline-block';
			
			var _iBubbleAnchorPosX = oPGBrowser.getDocumentOffsetX({'xElement': _oInfoBubbleAnchor});
			var _iBubbleAnchorPosY = oPGBrowser.getDocumentOffsetY({'xElement': _oInfoBubbleAnchor});
			var _iBubbleAnchorSizeX = oPGBrowser.getSizeX({'xElement': _oInfoBubbleAnchor});
			var _iBubbleAnchorSizeY = oPGBrowser.getSizeY({'xElement': _oInfoBubbleAnchor});
			var _iBubbleSizeX = oPGBrowser.getSizeX({'xElement': _oInfoBubble});
			var _iBubbleSizeY = oPGBrowser.getSizeY({'xElement': _oInfoBubble});
			
			_oInfoBubble.style.left = Math.min(Math.max((_iBubbleAnchorPosX+Math.round(_iBubbleAnchorSizeX-_iBubbleSizeX)/2), 0), oPGBrowser.getScreenSizeX())+'px';
			_oInfoBubble.style.top = ((_iBubbleAnchorPosY-_iBubbleSizeY-2 > 0) ? (_iBubbleAnchorPosY-_iBubbleSizeY-2) : (_iBubbleAnchorPosY+_iBubbleAnchorSizeY+2))+'px';
		}
	}
	
	this.hide = function(_sInfoBubbleID)
	{
		_sInfoBubbleID = this.getRealParameter({'oParameters': _sInfoBubbleID, 'sName': 'sInfoBubbleID', 'xParameter': _sInfoBubbleID});

		var _oInfoBubble = this.oDocument.getElementById(_sInfoBubbleID);
		if (_oInfoBubble) {_oInfoBubble.style.display = 'none';}
	}
}
classPG_InfoBubble.prototype = new classPG_ClassBasics();
var oPGInfoBubble = new classPG_InfoBubble();