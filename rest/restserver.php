<?php
/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura
* Last changes of this file: Jul 21 2014
*/
/*
@start class

@description
[en]...[/en]

@param extends classPG_ClassBasics
*/
class classPG_RestServer extends classPG_ClassBasics
{
	public $sRequestMethod = '';
	public $asUrlElements = array();
	public $sJson = '';
	public $axParams = array();

	public function __construct()
	{
		$this->initClassBasics();
	}

	/*
	@start method

	@description
	[en]...[/en]

	@return axResponse [type]mixed[][/type]
	[en]...[/en]

	@param sMethod [type]string[/type]
	[en]...[/en]

	@param axData [type]mixed[][/type]
	[en]...[/en]
	*/
	public function sendRequest($_sMethod = NULL, $_axData = NULL)
	{
		if (empty($_sMethod)) {$_sMethod = 'POST';}

		$_sData = json_encode($_axData);

		$_oCurl = curl_init(MBV_REST_ENDPOINT_URL);
		curl_setopt($_oCurl, CURLOPT_CUSTOMREQUEST, $_sMethod);
		curl_setopt($_oCurl, CURLOPT_POSTFIELDS, $_sData);
		curl_setopt($_oCurl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($_oCurl, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: '.strlen($_sData)
			)
		);

		return json_decode(curl_exec($_oCurl), true);
	}
	/* @end method */

	/*
	@start method

	@description
	[en]...[/en]

	@return axResponse [type]mixed[][/type]
	[en]...[/en]
	*/
	public function receiveRequest()
	{
		$this->sRequestMethod = $_SERVER['REQUEST_METHOD'];
		// $this->asUrlElements = explode('/', $_SERVER['PATH_INFO']);
		$this->parseJson();
		return $this->execRequest();
	}
	/* @end method */

	/*
	@start method

	@description
	[en]...[/en]

	@return sResponse [type]string[/type]
	[en]...[/en]
	*/
	public function sendResponse($_axData)
	{
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		return json_encode($_axData);
	}
	/* @end method */

	/*
	@start method
	*/
	public function parseJson()
	{
		$this->sJson = file_get_contents('php://input');
		$this->axParams = json_decode($this->sJson, true);
	}
	/* @end method */

	/*
	@start method
	*/
	public function execRequest()
	{
		// TODO
	}
	/* @end method */
}
/* @end class */
$oPGRestServer = new classPG_RestServer();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGRestServer', 'xValue' => $oPGRestServer));}
?>