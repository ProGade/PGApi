<?php
class classPG_InfoBubble extends classPG_ClassBasics
{
	public function build($_sInfoBubbleID, $_sAnchorContent = NULL, $_sBubbleContent = NULL)
	{
		$_sAnchorContent = $this->getRealParameter(array('oParameters' => $_sInfoBubbleID, 'sName' => 'sAnchorContent', 'xParameter' => $_sAnchorContent));
		$_sBubbleContent = $this->getRealParameter(array('oParameters' => $_sInfoBubbleID, 'sName' => 'sBubbleContent', 'xParameter' => $_sBubbleContent));
		$_sInfoBubbleID = $this->getRealParameter(array('oParameters' => $_sInfoBubbleID, 'sName' => 'sInfoBubbleID', 'xParameter' => $_sInfoBubbleID));
		
		if ($_sInfoBubbleID === NULL) {$_sInfoBubbleID = $this->getNextID();}
		if ($_sAnchorContent === NULL) {$_sAnchorContent = 'info';}
		if ($_sBubbleContent === NULL) {$_sBubbleContent = '';}

		$_sHtml = '';
		
		$_sHtml .= '<div id="'.$_sInfoBubbleID.'" class="info_bubble" ';
		$_sHtml .= 'style="position:absolute; display:inline-block; display:none; border-radius:5px; padding:5px; border:solid 1px #cccccc; background-color:#ffffff;" ';
		$_sHtml .= '>'.$_sBubbleContent.'</div>';
		
		$_sHtml .= '<span id="'.$_sInfoBubbleID.'Anchor" class="info_bubble_anchor" style="cursor:pointer;" ';
		$_sHtml .= 'onmouseover="oPGInfoBubble.show(\''.$_sInfoBubbleID.'\');" ';
		$_sHtml .= 'onmouseout="oPGInfoBubble.hide(\''.$_sInfoBubbleID.'\');" ';
		$_sHtml .= '>'.$_sAnchorContent.'</span>';
		
		return $_sHtml;
	}
}
$oPGInfoBubble = new classPG_InfoBubble();
?>