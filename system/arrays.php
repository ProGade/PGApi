<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Arrays extends classPG_ClassBasics
{
	/*
	@start method
	
	@return axArray [type]mixed[][/type]
	[en]...[/en]
	
	@param axArray [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function random($_axArray)
	{
		$_axArray = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'axArray', 'xParameter' => $_axArray, 'bNotNull' => true));

		$_axArray2 = array();
		foreach ($_axArray as $_xIndex => $_xValue)
		{
			$_axArray2[] = array('xIndex' => $_xIndex, 'xValue' => $_xValue);
		}
		shuffle($_axArray2);
		foreach ($_axArray2 as $_aEntry)
		{
			$_axArray[$_aEntry['xIndex']] = $_aEntry['xValue'];
		}
		return $_axArray;
	}
	/* @end method */

    /*
    @start method

	@return axArray [type]mixed[][/type]
	[en]...[/en]

    @param axArray [needed][type]mixed[][/type]
    [en]...[/en]

    @param xIndex [needed][type]mixed[/type]
    [en]...[/en]
    */
    public function removeByIndex($_axArray, $_xIndex)
    {
        $_axArray = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'axArray', 'xParameter' => $_axArray, 'bNotNull' => true));

        $_axNewArray = array();
        for ($i=0; $i<count($_axArray); $i++)
        {
            if (is_int($_xIndex)) {if ($i == $_xIndex) {continue;}}
            else if (is_array($_xIndex))
            {
                if (in_array($i, $_xIndex)) {continue;}
            }
            $_axNewArray[] = $_axArray[$i];
        }
        return $_axNewArray;
    }
    /* @end method */
	
	/*
	@start method
	
	@return iEmptyIndex [type]int[/type]
	[en]...[/en]
	
	@param axArray [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param iMaxIndex [type]int[/type]
	[en]...[/en]
	*/
	public function findEmptyIndex($_axArray, $_iMaxIndex = NULL)
	{
		$_iMaxIndex = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'iMaxIndex', 'xParameter' => $_iMaxIndex));
		$_axArray = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'axArray', 'xParameter' => $_axArray, 'bNotNull' => true));

		for ($i=0; $i<count($_axArray); $i++) {if ($_axArray[$i] === NULL) {return $i;}}
		if ((count($_axArray) < $_iMaxIndex) || ($_iMaxIndex === NULL)) {array_push($_axArray, NULL); return count($_axArray)-1;}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sJavaScriptArray [type]string[/type]
	[en]...[/en]
	
	@param axArray [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param sStringEscape [type]string[/type]
	[en]...[/en]
	*/
	public function toJavaScriptArray($_axArray, $_sStringEscape = NULL)
	{
		global $oPGObjects;

		$_sStringEscape = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'sStringEscape', 'xParameter' => $_sStringEscape));
		$_axArray = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'axArray', 'xParameter' => $_axArray, 'bNotNull' => true));
		
		if ($_sStringEscape === NULL) {$_sStringEscape = '"';}
		
		$i=0;
		$_sJavaScriptArray = '[';
			foreach ($_axArray as $_iIndex => $_xValue)
			{
				if ($i>0) {$_sJavaScriptArray .= ',';}
				if (is_string($_xValue)) {$_sJavaScriptArray .= $_sStringEscape.$_xValue.$_sStringEscape;}
				else if (is_array($_xValue)) {$_sJavaScriptArray .= $this->toJavaScriptArray(array('axArray' => $_xValue));}
				else if (is_object($_xValue)) {$_sJavaScriptArray .= $oPGObjects->toJavaScriptObject(array('oObject' => $_xValue));}
				else {$_sJavaScriptArray .= $_xValue;}
				$i++;
			}
		$_sJavaScriptArray .= ']';
		return $_sJavaScriptArray;
	}
	/* @end method */
}
/* @end class */
$oPGArrays = new classPG_Arrays();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGArrays', 'xValue' => $oPGArrays));}
?>