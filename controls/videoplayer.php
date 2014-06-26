<?php
class classPG_VideoPlayer extends classPG_ClassBasics
{
	private $asExtensions = array('mp4' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm', 'swf' => 'application/x-shockwave-flash', 'flv' => 'video/x-flv');
	private $sFlvPlayerTemplate = '';
	private $sSizeX = '320px';
	private $sSizeY = '240px';
	
	public function setFlvPlayerTemplate($_sTemplate)
	{
		$_sTemplate = $this->getRealParameter(array('oParameters' => $_sTemplate, 'sName' => 'sTemplate', 'xParameter' => $_sTemplate));
		$this->sFlvPlayerTemplate = $_sTemplate;
	}
	
	public function getFlvPlayerTemplate()
	{
		return $this->sFlvPlayerTemplate;
	}
	
	public function setSizeX($_sSizeX)
	{
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sSizeX, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$this->sSizeX = $_sSizeX;
	}

	public function setSizeY($_sSizeY)
	{
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sSizeY, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$this->sSizeY = $_sSizeY;
	}
	
	public function setSize($_sSizeX, $_sSizeY = NULL)
	{
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sSizeX, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sSizeX, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		
		if ($_sSizeX !== NULL) {$this->sSizeX = $_sSizeX;}
		if ($_sSizeY !== NULL) {$this->sSizeY = $_sSizeY;}
	}
	
	public function getUrlWithFileExtension($_xUrl, $_sExtension = NULL)
	{
		global $oPGStrings;
	
		$_sExtension = $this->getRealParameter(array('oParameters' => $_xUrl, 'sName' => 'sExtension', 'xParameter' => $_sExtension));
		$_xUrl = $this->getRealParameter(array('oParameters' => $_xUrl, 'sName' => 'xUrl', 'xParameter' => $_xUrl, 'bNotNull' => true));
		
		if (is_string($_xUrl))
		{
			$_sFileWithoutExtension = $oPGStrings->stripFileExtension(array('sString' => $_xUrl));
			if (file_exists($_sFileWithoutExtension.'.'.$_sExtension)){return $_sFileWithoutExtension.'.'.$_sExtension;}
		}
		else if (is_array($_xUrl))
		{
			foreach ($this->asExtensions as $_sExtension2 => $_sMimeType)
			{
				if (isset($_xUrl[$_sExtension2]))
				{
					$_sFileWithoutExtension = $oPGStrings->stripFileExtension(array('sString' => $_xUrl[$_sExtension2]));
					if (file_exists($_sFileWithoutExtension.'.'.$_sExtension)) {$_sFileWithoutExtension.'.'.$_sExtension;}
				}
			}
		}
		return '';
	}
	
	public function buildHtmlPlayer($_xUrl, $_sSizeX = NULL, $_sSizeY = NULL)
	{
		global $oPGStrings;
		
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_xUrl, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_xUrl, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_xUrl = $this->getRealParameter(array('oParameters' => $_xUrl, 'sName' => 'xUrl', 'xParameter' => $_xUrl, 'bNotNull' => true));

		if ($_sSizeX === NULL) {$_sSizeX = $this->sSizeX;}
		if ($_sSizeY === NULL) {$_sSizeY = $this->sSizeY;}
		
		$_bUseHtml5 = false;
		
		foreach ($this->asExtensions as $_sExtension => $_sMimeType)
		{
			$$_sExtension = '';
			if (is_array($_xUrl))
			{
				if (isset($_xUrl[$_sExtension])) {$$_sExtension = $_xUrl[$_sExtension];}
			}
			if ($$_sExtension == '') {$$_sExtension = $this->getUrlWithFileExtension(array('xUrl' => $_xUrl, 'sExtension' => $_sExtension));}
			if (($$_sExtension != '') && ($_sExtension != 'flv')) {$_bUseHtml5 = true;}
		}
		
		$_sObject = '';
		$_sObjectMimeType = '';
		if ($mp4 != '')
		{
			$_sObject = $mp4;
			$_sObjectMimeType = $this->asExtensions['mp4'];
		}
		if (($flv != '') && (($this->sFlvPlayerTemplate != '') || ($_sObject == '')))
		{
			$_sObject = $flv;
			$_sObjectMimeType = $this->asExtensions['flv'];
		}
		
		$_sEmbed = '';
		$_sEmbedMimeType = '';
		if ($swf != '')
		{
			$_sEmbed = $swf;
			$_sEmbedMimeType = $this->asExtensions['swf'];
		}
		if (($flv != '') && (($this->sFlvPlayerTemplate != '') || ($_sEmbed == '')))
		{
			$_sEmbed = $flv;
			$_sEmbedMimeType = $this->asExtensions['flv'];
		}
		
		// TODO: swf play and stop functions...
		$_sHtml = '';
		
		if ($_bUseHtml5 == true)
		{
			$_sHtml .= '<video width="'.str_replace('px', '', $_sSizeX).'" height="'.str_replace('px', '', $_sSizeY).'" controls>';
			foreach ($this->asExtensions as $_sExtension => $_sMimeType)
			{
				if ($_sExtension != 'flv')
				{
					if ($$_sExtension != '') {$_sHtml .= '<source src="'.$$_sExtension.'" type="'.$_sMimeType.'">';}
				}
			}
		}
		if ($this->sFlvPlayerTemplate != '')
		{
			$this->sFlvPlayerTemplate = str_replace('%SizeX%', str_replace('px', '', $_sSizeX), $this->sFlvPlayerTemplate);
			$this->sFlvPlayerTemplate = str_replace('%SizeY%', str_replace('px', '', $_sSizeY), $this->sFlvPlayerTemplate);
			$_sHtml .= str_replace('%VideoUrl%', $flv, $this->sFlvPlayerTemplate);
		}
		else
		{
			if ($_sObject != '')
			{
				$_sHtml .= '<object '; // id="TestVideo" ';
				if ($_sObjectMimeType != '') {$_sHtml .= 'type="'.$_sObjectMimeType.'" ';}
				$_sHtml .= 'data="'.$_sObject.'" width="'.str_replace('px', '', $_sSizeX).'" height="'.str_replace('px', '', $_sSizeY).';">';
			}
			if ($_sEmbed != '') {$_sHtml .= '<embed src="'.$_sEmbed.'" width="'.str_replace('px', '', $_sSizeX).'" height="'.str_replace('px', '', $_sSizeY).'">';}
			if ($_sObject != '') {$_sHtml .= '</object>';}
			/* if ($_sObjectMimeType == $this->asExtensions['swf'])
			{
				$_sHtml .= '<a href="javascript:;" target="_self" onclick="';
					$_sHtml .= 'var _oVideo = document.getElementById(\'TestVideo\'); ';
					$_sHtml .= 'if (_oVideo.style.display == \'none\') {_oVideo.style.display=\'block\';} ';
					$_sHtml .= 'else {_oVideo.style.display = \'none\';}';
				$_sHtml .= '">play/stop</a>';
			} */
		}
		if ($_bUseHtml5 == true) {$_sHtml .= '</video>';}
		return $_sHtml;
	}

	public function build($_xUrl, $_sSizeX = NULL, $_sSizeY = NULL)
	{
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_xUrl, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_xUrl, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_xUrl = $this->getRealParameter(array('oParameters' => $_xUrl, 'sName' => 'xUrl', 'xParameter' => $_xUrl));
		
		return $this->buildHtmlPlayer(
			array(
				'xUrl' => $_xUrl,
				'sSizeX' => $_sSizeX,
				'sSizeY' => $_sSizeY
			)
		);
	}
}
$oPGVideoPlayer = new classPG_VideoPlayer();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGVideoPlayer', 'xValue' => $oPGVideoPlayer));}
?>