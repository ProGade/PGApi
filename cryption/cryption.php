<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 20 2012
*/
/*
define('PG_CRYPT_MCRYPT_MODE_ECB', MCRYPT_MODE_ECB);
define('PG_CRYPT_MCRYPT_MODE_CBC', MCRYPT_MODE_CBC);
define('PG_CRYPT_MCRYPT_MODE_CFB', MCRYPT_MODE_CFB);
define('PG_CRYPT_MCRYPT_MODE_OFB', MCRYPT_MODE_OFB);
define('PG_CRYPT_MCRYPT_MODE_NOFB', MCRYPT_MODE_NOFB);
define('PG_CRYPT_MCRYPT_MODE_STREAM', MCRYPT_MODE_STREAM);

define('PG_CRYPT_MCRYPT_RANDOM_ENCRYPT', MCRYPT_ENCRYPT);
define('PG_CRYPT_MCRYPT_RANDOM_DECRYPT', MCRYPT_DECRYPT);
define('PG_CRYPT_MCRYPT_RANDOM_DEV_RANDOM', MCRYPT_DEV_RANDOM);
define('PG_CRYPT_MCRYPT_RANDOM_DEV_URANDOM', MCRYPT_DEV_URANDOM);
define('PG_CRYPT_MCRYPT_RANDOM_RAND', MCRYPT_RAND);

define('PG_CRYPT_MCRYPT_CIPHER_3DES', MCRYPT_3DES);
define('PG_CRYPT_MCRYPT_CIPHER_ARCFOUR_IV', MCRYPT_ARCFOUR_IV); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_ARCFOUR', MCRYPT_ARCFOUR); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_BLOWFISH', MCRYPT_BLOWFISH);
define('PG_CRYPT_MCRYPT_CIPHER_CAST_128', MCRYPT_CAST_128);
define('PG_CRYPT_MCRYPT_CIPHER_CAST_256', MCRYPT_CAST_256);
define('PG_CRYPT_MCRYPT_CIPHER_CRYPT', MCRYPT_CRYPT);
define('PG_CRYPT_MCRYPT_CIPHER_DES', MCRYPT_DES);
// define('PG_CRYPT_MCRYPT_CIPHER_DES_COMPAT', MCRYPT_DES_COMPAT); // (libmcrypt 2.2.x only)
// define('PG_CRYPT_MCRYPT_CIPHER_ENIGMA', MCRYPT_ENIGMA); // (libmcrypt > 2.4.x only, alias for MCRYPT_CRYPT)
define('PG_CRYPT_MCRYPT_CIPHER_GOST', MCRYPT_GOST);
define('PG_CRYPT_MCRYPT_CIPHER_IDEA', MCRYPT_IDEA); // (non-free)
define('PG_CRYPT_MCRYPT_CIPHER_LOKI97', MCRYPT_LOKI97); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_MARS', MCRYPT_MARS); // (libmcrypt > 2.4.x only, non-free)
define('PG_CRYPT_MCRYPT_CIPHER_PANAMA', MCRYPT_PANAMA); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_RIJNDAEL_128', MCRYPT_RIJNDAEL_128); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_RIJNDAEL_192', MCRYPT_RIJNDAEL_192); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_RIJNDAEL_256', MCRYPT_RIJNDAEL_256); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_RC2', MCRYPT_RC2);
// define('PG_CRYPT_MCRYPT_CIPHER_RC4', MCRYPT_RC4); // (libmcrypt 2.2.x only)
define('PG_CRYPT_MCRYPT_CIPHER_RC6', MCRYPT_RC6); // (libmcrypt > 2.4.x only)
// define('PG_CRYPT_MCRYPT_CIPHER_RC6_128', MCRYPT_RC6_128); // (libmcrypt 2.2.x only)
// define('PG_CRYPT_MCRYPT_CIPHER_RC6_192', MCRYPT_RC6_192); // (libmcrypt 2.2.x only)
// define('PG_CRYPT_MCRYPT_CIPHER_RC6_256', MCRYPT_RC6_256); // (libmcrypt 2.2.x only)
define('PG_CRYPT_MCRYPT_CIPHER_SAFER64', MCRYPT_SAFER64);
define('PG_CRYPT_MCRYPT_CIPHER_SAFER128', MCRYPT_SAFER128);
define('PG_CRYPT_MCRYPT_CIPHER_SAFERPLUS', MCRYPT_SAFERPLUS); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_SERPENT', MCRYPT_SERPENT); // (libmcrypt > 2.4.x only)
// define('PG_CRYPT_MCRYPT_CIPHER_SERPENT_128', MCRYPT_SERPENT_128); // (libmcrypt 2.2.x only)
// define('PG_CRYPT_MCRYPT_CIPHER_SERPENT_192', MCRYPT_SERPENT_192); // (libmcrypt 2.2.x only)
// define('PG_CRYPT_MCRYPT_CIPHER_SERPENT_256', MCRYPT_SERPENT_256); // (libmcrypt 2.2.x only)
define('PG_CRYPT_MCRYPT_CIPHER_SKIPJACK', MCRYPT_SKIPJACK); // (libmcrypt > 2.4.x only)
// define('PG_CRYPT_MCRYPT_CIPHER_TEAN', MCRYPT_TEAN); // (libmcrypt 2.2.x only)
define('PG_CRYPT_MCRYPT_CIPHER_THREEWAY', MCRYPT_THREEWAY);
define('PG_CRYPT_MCRYPT_CIPHER_TRIPLEDES', MCRYPT_TRIPLEDES); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_TWOFISH', MCRYPT_TWOFISH); // (for older mcrypt 2.x versions, or mcrypt > 2.4.x )
define('PG_CRYPT_MCRYPT_CIPHER_TWOFISH128', MCRYPT_TWOFISH128); // (TWOFISHxxx are available in newer 2.x versions, but not in the 2.4.x versions)
define('PG_CRYPT_MCRYPT_CIPHER_TWOFISH192', MCRYPT_TWOFISH192);
define('PG_CRYPT_MCRYPT_CIPHER_TWOFISH256', MCRYPT_TWOFISH256);
define('PG_CRYPT_MCRYPT_CIPHER_WAKE', MCRYPT_WAKE); // (libmcrypt > 2.4.x only)
define('PG_CRYPT_MCRYPT_CIPHER_XTEA', MCRYPT_XTEA); // (libmcrypt > 2.4.x only)
*/

$asPGMcryptModes = mcrypt_list_modes();
foreach ($asPGMcryptModes as $sPGMcryptMode)
{
	define('PG_CRYPT_'.$sPGMcryptMode, $sPGMcryptMode);
}

if (!defined('PG_CRYPT_MCRYPT_MODE_ECB')) {define('PG_CRYPT_MCRYPT_MODE_ECB', MCRYPT_MODE_ECB);}
if (!defined('PG_CRYPT_MCRYPT_CIPHER_RIJNDAEL_256')) {define('PG_CRYPT_MCRYPT_CIPHER_RIJNDAEL_256', MCRYPT_RIJNDAEL_256);}
if (!defined('PG_CRYPT_MCRYPT_RANDOM_RAND')) {define('PG_CRYPT_MCRYPT_RANDOM_RAND', MCRYPT_RAND);}

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Cryption extends classPG_ClassBasics
{
	// Declarations...
	private $sSecretKey = 'this!ismy_secret%key';
	private $sMcryptMode = NULL;
	private $sMcryptCipher = NULL;
	private $iMcryptRandom = NULL;
	
	// Construct...
	public function __construct()
	{
		if (defined('PG_CRYPT_MCRYPT_MODE_ECB')) {$this->sMcryptMode = PG_CRYPT_MCRYPT_MODE_ECB;}
		if (defined('PG_CRYPT_MCRYPT_CIPHER_RIJNDAEL_256')) {$this->sMcryptCipher = PG_CRYPT_MCRYPT_CIPHER_RIJNDAEL_256;}
		if (defined('PG_CRYPT_MCRYPT_RANDOM_RAND')) {$this->iMcryptRandom = PG_CRYPT_MCRYPT_RANDOM_RAND;}
	}
	
	// Methods...
	/*
	@start method
	
	@return asModes [type]string[][/type]
	[en]...[/en]
	*/
	public function getModesList()
	{
		$_asModes = mcrypt_list_modes();
		for ($i=0; $i<count($_asModes); $i++)
		{
			$_asModes[$i] = 'PG_CRYPT_'.$_asModes[$i];
		}
		return $_asModes;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setSecretKey($_sKey)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sKey, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$this->sSecretKey = $_sKey;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sEncryptedString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function encrypt($_sString, $_sKey = NULL)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->mcryptEncrypt(array('sString' => $_sString, 'sKey' => $_sKey));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDecryptedString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function decrypt($_sString, $_sKey = NULL)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->mcryptDecrypt(array('sString' => $_sString, 'sKey' => $_sKey));
	}
	/* @end method */

	// Mcrypt...
	/*
	@start method
	
	@param sMode [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setMcyrptMode($_sMode)
	{
		$_sMode = $this->getRealParameter(array('oParameters' => $_sMode, 'sName' => 'sMode', 'xParameter' => $_sMode));
		$this->sMcryptMode = $_sMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sMcryptMode [type]string[/type]
	[en]...[/en]
	*/
	public function getMcryptMode() {return $this->sMcryptMode;}
	/* @end method */
	
	/*
	@start method
	
	@param sCipher [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setMcryptCipher($_sCipher)
	{
		$_sCipher = $this->getRealParameter(array('oParameters' => $_sCipher, 'sName' => 'sCipher', 'xParameter' => $_sCipher));
		$this->sMcryptCipher = $_sCipher;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sMcryptCipher [type]string[/type]
	[en]...[/en]
	*/
	public function getMcryptCipher() {return $this->sMcryptCipher;}
	/* @end method */

	/*
	@start method
	
	@param iRandom [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setMcryptRandom($_iRandom)
	{
		$_iRandom = $this->getRealParameter(array('oParameters' => $_iRandom, 'sName' => 'iRandom', 'xParameter' => $_iRandom));
		$this->iMcryptRandom = $_iRandom;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMcryptRandom [type]int[/type]
	[en]...[/en]
	*/
	public function getMcryptRandom() {return $this->iMcryptRandom;}
	/* @end method */

	/*
	@start method
	
	@return sEncryptedString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function mcryptEncrypt($_sString, $_sKey = NULL)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sKey == NULL) {$_sKey = $this->sSecretKey;}
		$_iIvSize = mcrypt_get_iv_size($this->sMcryptCipher, $this->sMcryptMode);
		$_sIvString = mcrypt_create_iv($_iIvSize, $this->iMcryptRandom);
		$_sString = mcrypt_encrypt($this->sMcryptCipher, md5($_sKey), $_sString, $this->sMcryptMode, $_sIvString);
		return $_sString;
	}
	/* @end method */

	/*
	@start method
	
	@return sDecryptedString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sKey [needed][type]string[/type]
	[en]...[/en]
	*/
	public function mcryptDecrypt($_sString, $_sKey = NULL)
	{
		$_sKey = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sKey', 'xParameter' => $_sKey));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sKey == NULL) {$_sKey = $this->sSecretKey;}
		$_iIvSize = mcrypt_get_iv_size($this->sMcryptCipher, $this->sMcryptMode);
		$_sIvString = mcrypt_create_iv($_iIvSize, $this->iMcryptRandom);
		$_sString = mcrypt_decrypt($this->sMcryptCipher, md5($_sKey), $_sString, $this->sMcryptMode, $_sIvString);
		return $_sString;
	}
	/* @end method */
}
/* @end class */
$oPGCryption = new classPG_Cryption();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCryption', 'xValue' => $oPGCryption));}
?>