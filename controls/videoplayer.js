function classPG_VideoPlayer()
{
	this.toggle = function(_sVideoID, _sVideoUrl, _sImage)
	{
		var _oVideo = this.oDocument.getElementById(_sVideoID);
		if (_oVideo)
		{
			if (_oVideo.tag == 'img') {this.play({'sVideoID': _sVideoID, 'sVideoUrl': _sVideoUrl});}
			else {this.stop({'sVideoID': _sVideoID, 'sVideoUrl': _sVideoUrl, 'sImage': _sImage});}
		}
	}

	this.play = function(_sVideoID, _sVideoUrl)
	{
		var _oVideo = this.oDocument.getElementById(_sVideoID);
		if (_oVideo)
		{
			var _sHtml = '';
			_sHtml += '<object id="'+_sVideoID+'" data="'+_sVideoUrl+'" style="width:'+_oVideo.style.width+'; height:'+_oVideo.style.height+';">';
				_sHtml += '<embed src="'+_sVideoUrl+'" style="width:'+_oVideo.style.width+'; height:'+_oVideo.style.height+';" />';
			_sHtml += '</object>';
			oPGBrowser.setOuterHtml({'xElement': _oVideo, 'sHtml': _sHtml});
		}
	}
	
	this.stop = function(_sVideoID, _sVideoUrl, _sImage)
	{
		var _oVideo = this.oDocument.getElementById(_sVideoID);
		if (_oVideo)
		{
			var _sHtml = '';
			_sHtml += '<img id="'+_sVideoID+'" src="'+_sImage+'" onclick="';
				_sHtml += 'oPGVideoPlayer.play({\'sVideoID\': \''+_sVideoID+'\', \'sVideoUrl\': \''+_sVideoUrl+'\'}); ';
			_sHtml += '" />';
			oPGBrowser.setOuterHtml({'xElement': _oVideo, 'sHtml': _sHtml});
		}
	}
}
classPG_VideoPlayer.prototype = new classPG_ClassBasics();
var oPGVideoPlayer = new classPG_VideoPlayer();