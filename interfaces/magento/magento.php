<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 02 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Magento extends classPG_ClassBasics
{
	// Declarations...
	private $oClient = NULL;
	private $sSessionID = NULL;
	private $sHost = 'http://localhost/';
	private $xDefaultTaxClassID = NULL;
	private $bSoapV2 = false;
	
	// Construct...
	
	// Methods...
	/*
	@start method
	*/
	public function setDefaultTaxClassID($_xTaxClassID)
	{
		$_xTaxClassID = $this->getRealParameter(array('oParameters' => $_xTaxClassID, 'sName' => 'xTaxClassID', 'xParameter' => $_xTaxClassID));
		$this->xDefaultTaxClassID = $_xTaxClassID;
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function getDefaultTaxClassID() {return $this->xDefaultTaxClassID;}
	/* @end method */
	
	/*
	@start method
	*/
	public function isReady()
	{
		$_bReady = true;
		if (!extension_loaded('soap'))
		{
			$_bReady = false;
			$this->addDebugString(array('sString' => 'Soap extension on local system is not loaded!'));
		}
		return $_bReady;
	}
	/* @end method */
	
	/*
	@start method
	@param bUse [needed][type]bool[/type]
	*/
	public function useSoapV2($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSoapV2 = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function isSoapV2() {return $this->bSoapV2;}
	/* @end method */
	
	/*
	@start method
	@param sHost [needed][type]string[/type]
	*/
	public function setHost($_sHost)
	{
		$_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));
		$this->sHost = $_sHost;
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function getHost() {return $this->sHost;}
	/* @end method */
	
	/*
	@start method
	@param sApiUser [needed][type]string[/type]
	@param sApiKey [needed][type]string[/type]
	*/
	public function login($_sApiUser = NULL, $_sApiKey = NULL)
	{
		$_sApiKey = $this->getRealParameter(array('oParameters' => $_sApiUser, 'sName' => 'sApiKey', 'xParameter' => $_sApiKey));
		$_sApiUser = $this->getRealParameter(array('oParameters' => $_sApiUser, 'sName' => 'sApiUser', 'xParameter' => $_sApiUser));
		if (!$this->oClient) {$this->oClient = new SoapClient($this->sHost.'api/soap/?wsdl');}
		// var_dump($this->oClient->__getFunctions());
		if ($this->oClient)
		{
			try
			{
				$this->sSessionID = $this->oClient->login(utf8_encode($_sApiUser), utf8_encode($_sApiKey));
				// $this->sSessionID = $this->oClient->__soapCall('login', array(utf8_encode($_sApiUser), utf8_encode($_sApiKey)));
				return $this->sSessionID;
			}
			catch (Exception $_oException)
			{
				$this->addDebugString(array('sString' => 'Soap login response error: '.$_oException->getMessage()));
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	@return bSuccess [type]bool[/type]
	*/
	public function close()
	{
		if (($this->oClient) && ($this->sSessionID))
		{
			return $this->oClient->endSession($this->sSessionID);
		}
		return false;
	}
	/* @end method */
	
	/*
	Fault Code Messages:
	0 		Unknown Error
	1 		Internal Error. Please see log for details.
	2 		Access denied.
	3 		Invalid api path.
	4 		Resource path is not callable. 
	100 	Requested store view not found.
	102 	Invalid data given. Details in error message.
	104 	Product type is not in allowed types.
	105 	Product attribute set is not existed
	106 	Product attribute set is not belong catalog product entity type
	*/
	/*
	@start method
	@param sResourceName [type]string[/type]
	*/
	public function getErrors($_sResourceName = NULL)
	{
		$_sResourceName = $this->getRealParameter(array('oParameters' => $_sResourceName, 'sName' => 'sResourceName', 'xParameter' => $_sResourceName));
		if ($_sResourceName != NULL) {return $this->oClient->resourceFaults($this->sSessionID, $_sResourceName);}
		else {return $this->oClient->globalFaults($this->sSessionID);}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	@param sCall [needed][type]string[/type]
	@param axParameters [type]mixed[][/type]
	*/
	public function send($_sCall, $_axParameters = NULL)
	{
		$_axParameters = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'axParameters', 'xParameter' => $_axParameters));
		$_sCall = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'sCall', 'xParameter' => $_sCall));

		try
		{
			if ($_axParameters != NULL)
			{
				if ($this->bSoapV2 == true) {return $this->oClient->$_sCall($this->sSessionID, $_axParameters);}
				else {return $this->oClient->call($this->sSessionID, $_sCall, $_axParameters);}
			}
			else
			{
				if ($this->bSoapV2 == true) {return $this->oClient->$_sCall($this->sSessionID);}
				else {return $this->oClient->call($this->sSessionID, $_sCall);}
			}
		}
		catch (SoapFault $_oException)
		{
			$this->addDebugString(array('sString' => 'Soap call response error: ['.$_oException->faultcode.'] '.$_oException->faultstring.' in '.$_oException->getFile().' on line '.$_oException->getLine().'; Details: '.$_oException->getTraceAsString()));
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => '<b>'.$_sCall.'<b><pre>'.print_r($_axParameters, true).'</pre>'));}
		}
	}
	/* @end method */
	
	/*
	@start method
	@return asInfo [type]string[][/type]
	*/
	public function getInfo()
	{
		$_asInfo = array();
		if ($this->bSoapV2 == true) {$_asInfo = $this->send(array('sCall' => 'magentoInfo'));}
		else {$_asInfo = $this->send(array('sCall' => 'magento.info'));}
		return $_asInfo;
	}
	/* @end method */

	// Stores...
	/*
	@start method
	@return axStores [type]mixed[][/type]
	*/
	public function getStores()
	{
		$_axStores = array();
		if ($this->bSoapV2 == true) {$_axStores = $this->send(array('sCall' => 'storeList'));}
		else {$_axStores = $this->send(array('sCall' => 'store.list'));}
		return $_axStores;
	}
	/* @end method */
	
	/*
	@start method
	@return axStoreInfo [type]mixed[][/type]
	@param xStore [type]mixed[/type]
	*/
	public function getStoreInfo($_xStore)
	{
		$_xStore = $this->getRealParameter(array('oParameters' => $_xStore, 'sName' => 'xStore', 'xParameter' => $_xStore));
		
		$_axStoreInfo = array();
		if ($this->bSoapV2 == true) {$_axStoreInfo = $this->send(array('sCall' => 'storeInfo', 'axParameters' => array($_xStore)));}
		else {$_axStoreInfo = $this->send(array('sCall' => 'store.info', 'axParameters' => array($_xStore)));}
		return $_axStoreInfo;
	}
	/* @end method */
	
	// Categories...
	/*
	@start method
	*/
	public function getCategories($_iParentCategoryID = NULL, $_xWebsite = NULL, $_xStoreView = NULL, $_bGetSubStructure = NULL)
	{
		$_xWebsite = $this->getRealParameter(array('oParameters' => $_iParentCategoryID, 'sName' => 'xWebsite', 'xParameter' => $_xWebsite));
		$_xStoreView = $this->getRealParameter(array('oParameters' => $_iParentCategoryID, 'sName' => 'xStoreView', 'xParameter' => $_xStoreView));
		$_bGetSubStructure = $this->getRealParameter(array('oParameters' => $_iParentCategoryID, 'sName' => 'bGetSubStructure', 'xParameter' => $_bGetSubStructure));
		$_iParentCategoryID = $this->getRealParameter(array('oParameters' => $_iParentCategoryID, 'sName' => 'iParentCategoryID', 'xParameter' => $_iParentCategoryID));
		
		if ($_bGetSubStructure === NULL) {$_bGetSubStructure = false;}
		
		$_axParameters = NULL;
		if ($_iParentCategoryID) {$_axParameters['parentCategory'] = $_iParentCategoryID;}
		if ($_xWebsite) {$_axParameters['website'] = $_xWebsite;}
		if ($_xStoreView) {$_axParameters['storeView'] = $_xStoreView;}
	
		$_axCategories = array();
		if ($this->bSoapV2 == true) {$_axCategories = $this->send(array('sCall' => 'catalogCategoryLevel', 'axParameters' => $_axParameters));}
		else {$_axCategories = $this->send(array('sCall' => 'catalog_category.level', 'axParameters' => $_axParameters));}
		
		if ($_bGetSubStructure == true)
		{
			for ($i=0; $i<count($_axCategories); $i++)
			{
				$_axCategories[$i]['axSubCategories'] = $this->getCategories(array('iParentCategoryID' => $_axCategories['category_id'], 'xWebsite' => $_xWebsite, 'xStoreView' => $_xStoreView, 'bGetSubStructure' => $_bGetSubStructure));
			}
		}
		
		return $_axCategories;
	}
	/* @end method */
	
	// Products....
	/*
	@start method
	@return axProductTypes [type]mixed[][/type]
	*/
	public function getProductTypes()
	{
		$_axProductTypes = array();
		if ($this->bSoapV2 == true) {$_axProductTypes = $this->send(array('sCall' => 'catalogProductTypeList'));}
		else {$_axProductTypes = $this->send(array('sCall' => 'catalog_product_type.list'));}
		return $_axProductTypes;
	}
	/* @end method */
	
	/*
	@start method
	@param xStoreView [type]mixed[/type]
	@param axFilters [type]mixed[][/type]
	*/
	public function getProducts($_xStoreView = NULL, $_axFilters = NULL)
	{
		$_axFilters = $this->getRealParameter(array('oParameters' => $_xStoreView, 'sName' => 'axFilters', 'xParameter' => $_axFilters));
		$_xStoreView = $this->getRealParameter(array('oParameters' => $_xStoreView, 'sName' => 'xStoreView', 'xParameter' => $_xStoreView));

		$_axParameters = NULL;
		if ($_axFilters != NULL) {$_axParameters['filters'] = $_axFilters;}
		if ($_xStoreView != NULL) {$_axParameters['storeView'] = $_xStoreView;}
		
		$_axProducts = array();
		if ($this->bSoapV2 == true) {$_axProducts = $this->send(array('sCall' => 'catalogProductList', 'axParameters' => $_axParameters));}
		else {$_axProducts = $this->send(array('sCall' => 'catalog_product.list', 'axParameters' => $_axParameters));}
		return $_axProducts;
	}
	/* @end method */
	
	/*
	@start method
	@param iCategoryID
	*/
	public function getProductsFromCategory($_iCategoryID = NULL)
	{
		$_iCategoryID = $this->getRealParameter(array('oParameters' => $_iCategoryID, 'sName' => 'iCategoryID', 'xParameter' => $_iCategoryID));
		
		$_axParameters = NULL;
		if ($_iCategoryID != NULL) {$_axParameters['categoryId'] = $_iCategoryID;}

		if ($this->bSoapV2 == true) {$_axProducts = $this->send(array('sCall' => 'catalogCategoryAssignedProducts', 'axParameters' => $_axParameters));}
		else {$_axProducts = $this->send(array('sCall' => 'catalog_category.assignedProducts', 'axParameters' => $_axParameters));}
		return $_axProducts;
	}
	/* @end method */
	
	/*
	@start method
	@param xProduct [needed][type]mixed[/type]
	@param xStoreView [type]mixed[/type]
	@param axGetAttributes [type]mixed[][/type]
	@param sProductIdentifierType [type]string[/type]
	*/
	public function getProductDetails($_xProduct, $_xStoreView = NULL, $_axGetAttributes = NULL, $_sProductIdentifierType = NULL)
	{
		$_xStoreView = $this->getRealParameter(array('oParameters' => $_xProduct, 'sName' => 'xStoreView', 'xParameter' => $_xStoreView));
		$_axGetAttributes = $this->getRealParameter(array('oParameters' => $_xProduct, 'sName' => 'axGetAttributes', 'xParameter' => $_axGetAttributes));
		$_sProductIdentifierType = $this->getRealParameter(array('oParameters' => $_xProduct, 'sName' => 'sProductIdentifierType', 'xParameter' => $_sProductIdentifierType));
		$_xProduct = $this->getRealParameter(array('oParameters' => $_xProduct, 'sName' => 'xProduct', 'xParameter' => $_xProduct));
	
		$_axParameters = array();
		$_axParameters['product'] = $_xProduct;
		if ($_xStoreView != NULL) {$_axParameters['storeView'] = $_xStoreView;}
		if ($_axGetAttributes != NULL) {$_axParameters['attributes'] = $_axGetAttributes;}
		if ($_sProductIdentifierType != NULL) {$_axParameters['productIdentifierType'] = $_sProductIdentifierType;}
	
		$_axProduct = array();
		if ($this->bSoapV2 == true) {$_axProduct = $this->send(array('sCall' => 'catalogProductInfo', 'axParameters' => $_axParameters));}
		else {$_axProduct = $this->send(array('sCall' => 'catalog_product.info', 'axParameters' => $_axParameters));}
		return $_axProduct;
	}
	/* @end method */
	
	/*
	@start method
	@return axAttributeSets [type]mixed[][/type]
	*/
	public function getAttributeSets()
	{
		$_axAttributeSets = array();
		if ($this->bSoapV2 == true) {$_axAttributeSets = $this->send(array('sCall' => 'catalogProductAttributeSetList'));}
		else {$_axAttributeSets = $this->send(array('sCall' => 'catalog_product_attribute_set.list'));}
		return $_axAttributeSets;
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function insertProduct(
		$_sProductType, 
		$_iAttributeSetID = NULL, 
		$_sProductSku = NULL, 
		$_axWebsites = NULL,
		$_xStoreView = NULL,
		$_axCategories = NULL,
		$_sName = NULL,
		$_dPrice = NULL,
		$_sDescription = NULL,
		$_sShortDescription = NULL,
		$_dWeight = NULL,
		$_iStatus = NULL,
		$_iVisibility = NULL,
		$_xTaxClassID = NULL
	)
	{
		$_iAttributeSetID = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'iAttributeSetID', 'xParameter' => $_iAttributeSetID));
		$_sProductSku = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'sProductSku', 'xParameter' => $_sProductSku));
		$_axWebsites = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'axWebsites', 'xParameter' => $_axWebsites));
		$_xStoreView = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'xStoreView', 'xParameter' => $_xStoreView));
		$_axCategories = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'axCategories', 'xParameter' => $_axCategories));
		$_sName = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'sName', 'xParameter' => $_sName));
		$_dPrice = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'dPrice', 'xParameter' => $_dPrice));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sShortDescription = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'sShortDescription', 'xParameter' => $_sShortDescription));
		$_dWeight = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'dWeight', 'xParameter' => $_dWeight));
		$_iStatus = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'iStatus', 'xParameter' => $_iStatus));
		$_iVisibility = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'iVisibility', 'xParameter' => $_iVisibility));
		$_xTaxClassID = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'xTaxClassID', 'xParameter' => $_xTaxClassID));
		$_sProductType = $this->getRealParameter(array('oParameters' => $_sProductType, 'sName' => 'sProductType', 'xParameter' => $_sProductType));
		
		if ($_sProductType === NULL) {$_sProductType = 'simple';}
		if ($_iStatus === NULL) {$_iStatus = 0;}
		if ($_iVisibility === NULL) {$_iVisibility = 4;}
		if ($_xTaxClassID === NULL) {$_xTaxClassID = $this->xDefaultTaxClassID;}
		
		$_axProduct = $this->buildProductStructure(
			array(
				'sProductType' => $_sProductType,
				'iAttributeSetID' => $_iAttributeSetID,
				'sProductSku' => $_sProductSku,
				'xStoreView' => $_xStoreView,
				'axWebsites' => $_axWebsites,
				'axCategories' => $_axCategories,
				'sName' => $_sName,
				'dPrice' => $_dPrice,
				'sDescription' => $_sDescription,
				'sShortDescription' => $_sShortDescription,
				'dWeight' => $_dWeight,
				'iStatus' => $_iStatus,
				'iVisibility' => $_iVisibility,
				'xTaxClassID' => $_xTaxClassID
			)
		);
		
		if ($this->bSoapV2 == true) {return $this->send(array('sCall' => 'catalogProductCreate', 'axParameters' => $_axProduct));}
		return $this->send(array('sCall' => 'catalog_product.create', 'axParameters' => $_axProduct));
	}
	/* @end method */	
	
	/*
	@start method
	*/
	public function updateProduct(
		$_iProductID, 
		$_sProductSku = NULL, 
		$_axWebsites = NULL,
		$_xStoreView = NULL,
		$_axCategories = NULL,
		$_sName = NULL,
		$_dPrice = NULL,
		$_sDescription = NULL,
		$_sShortDescription = NULL,
		$_dWeight = NULL,
		$_iStatus = NULL,
		$_iVisibility = NULL,
		$_xTaxClassID = NULL,
		$_sProductIdentifierType = NULL
	)
	{
		$_sProductSku = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sProductSku', 'xParameter' => $_sProductSku));
		$_axWebsites = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'axWebsites', 'xParameter' => $_axWebsites));
		$_xStoreView = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'xStoreView', 'xParameter' => $_xStoreView));
		$_axCategories = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'axCategories', 'xParameter' => $_axCategories));
		$_sName = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_dPrice = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'dPrice', 'xParameter' => $_dPrice));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sShortDescription = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sShortDescription', 'xParameter' => $_sShortDescription));
		$_dWeight = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'dWeight', 'xParameter' => $_dWeight));
		$_iStatus = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iStatus', 'xParameter' => $_iStatus));
		$_iVisibility = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iVisibility', 'xParameter' => $_iVisibility));
		$_xTaxClassID = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'xTaxClassID', 'xParameter' => $_xTaxClassID));
		$_sProductIdentifierType = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sProductIdentifierType', 'xParameter' => $_sProductIdentifierType));
		$_iProductID = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iProductID', 'xParameter' => $_iProductID));
		
		$_axProduct = $this->buildProductStructure(
			array(
				'iProductID' => $_iProductID,
				'sProductSku' => $_sProductSku,
				'xStoreView' => $_xStoreView,
				'axWebsites' => $_axWebsites,
				'axCategories' => $_axCategories,
				'sName' => $_sName,
				'dPrice' => $_dPrice,
				'sDescription' => $_sDescription,
				'sShortDescription' => $_sShortDescription,
				'dWeight' => $_dWeight,
				'iStatus' => $_iStatus,
				'iVisibility' => $_iVisibility,
				'xTaxClassID' => $_xTaxClassID,
				'sProductIdentifierType' => $_sProductIdentifierType
			)
		);
		
		if ($this->bSoapV2 == true) {return $this->send(array('sCall' => 'catalogProductUpdate', 'axParameters' => $_axProduct));}
		return $this->send(array('sCall' => 'catalog_product.update', 'axParameters' => $_axProduct));
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function saveProduct(
		$_iProductID, 
		$_sProductType = NULL, 
		$_iAttributeSetID = NULL, 
		$_sProductSku = NULL, 
		$_axWebsites = NULL,
		$_xStoreView = NULL,
		$_axCategories = NULL,
		$_sName = NULL,
		$_dPrice = NULL,
		$_sDescription = NULL,
		$_sShortDescription = NULL,
		$_dWeight = NULL,
		$_iStatus = NULL,
		$_iVisibility = NULL,
		$_xTaxClassID = NULL,
		$_sProductIdentifierType = NULL
	)
	{
		$_sProductType = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sProductType', 'xParameter' => $_sProductType));
		$_iAttributeSetID = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iAttributeSetID', 'xParameter' => $_iAttributeSetID));
		$_sProductSku = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sProductSku', 'xParameter' => $_sProductSku));
		$_axWebsites = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'axWebsites', 'xParameter' => $_axWebsites));
		$_xStoreView = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'xStoreView', 'xParameter' => $_xStoreView));
		$_axCategories = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'axCategories', 'xParameter' => $_axCategories));
		$_sName = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_dPrice = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'dPrice', 'xParameter' => $_dPrice));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sShortDescription = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sShortDescription', 'xParameter' => $_sShortDescription));
		$_dWeight = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'dWeight', 'xParameter' => $_dWeight));
		$_iStatus = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iStatus', 'xParameter' => $_iStatus));
		$_iVisibility = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iVisibility', 'xParameter' => $_iVisibility));
		$_xTaxClassID = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'xTaxClassID', 'xParameter' => $_xTaxClassID));
		$_sProductIdentifierType = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sProductIdentifierType', 'xParameter' => $_sProductIdentifierType));
		$_iProductID = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iProductID', 'xParameter' => $_iProductID));

		$_axProduct = $this->buildProductStructure(
			array(
				'iProductID' => $_iProductID,
				'sProductType' => $_sProductType,
				'iAttributeSetID' => $_iAttributeSetID,
				'sProductSku' => $_sProductSku,
				'xStoreView' => $_xStoreView,
				'axWebsites' => $_axWebsites,
				'axCategories' => $_axCategories,
				'sName' => $_sName,
				'dPrice' => $_dPrice,
				'sDescription' => $_sDescription,
				'sShortDescription' => $_sShortDescription,
				'dWeight' => $_dWeight,
				'iStatus' => $_iStatus,
				'iVisibility' => $_iVisibility,
				'xTaxClassID' => $_xTaxClassID,
				'sProductIdentifierType' => $_sProductIdentifierType
			)
		);
		
		// TODO: Look for product exists...
		// TODO: Update if product exists...
		// TODO: Insert if product doesn't exists...
	}
	/* @end method */
	
	/*
	@start method
	*/
	public function buildProductStructure(
		$_iProductID, 
		$_sProductType = NULL, 
		$_iAttributeSetID = NULL, 
		$_sProductSku = NULL, 
		$_axWebsites = NULL,
		$_xStoreView = NULL,
		$_axCategories = NULL,
		$_sName = NULL,
		$_dPrice = NULL,
		$_sDescription = NULL,
		$_sShortDescription = NULL,
		$_dWeight = NULL,
		$_iStatus = NULL,
		$_iVisibility = NULL,
		$_xTaxClassID = NULL,
		$_sProductIdentifierType = NULL
	)
	{
		$_sProductType = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sProductType', 'xParameter' => $_sProductType));
		$_iAttributeSetID = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iAttributeSetID', 'xParameter' => $_iAttributeSetID));
		$_sProductSku = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sProductSku', 'xParameter' => $_sProductSku));
		$_axWebsites = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'axWebsites', 'xParameter' => $_axWebsites));
		$_xStoreView = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'xStoreView', 'xParameter' => $_xStoreView));
		$_axCategories = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'axCategories', 'xParameter' => $_axCategories));
		$_sName = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_dPrice = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'dPrice', 'xParameter' => $_dPrice));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sShortDescription = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sShortDescription', 'xParameter' => $_sShortDescription));
		$_dWeight = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'dWeight', 'xParameter' => $_dWeight));
		$_iStatus = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iStatus', 'xParameter' => $_iStatus));
		$_iVisibility = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iVisibility', 'xParameter' => $_iVisibility));
		$_xTaxClassID = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'xTaxClassID', 'xParameter' => $_xTaxClassID));
		$_sProductIdentifierType = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'sProductIdentifierType', 'xParameter' => $_sProductIdentifierType));
		$_iProductID = $this->getRealParameter(array('oParameters' => $_iProductID, 'sName' => 'iProductID', 'xParameter' => $_iProductID));

		$_axProduct = array();
		if ($_iProductID !== NULL) {$_axProduct['productId'] = $_iProductID;}
		if ($_sProductType !== NULL) {$_axProduct['type'] = $_sProductType;}
		if ($_iAttributeSetID !== NULL) {$_axProduct['set'] = $_iAttributeSetID;}
		if (($_sProductSku !== NULL) && ($_iProductID === NULL)) {$_axProduct['sku'] = $_sProductSku;}
		if ($_axWebsites !== NULL) {$_axProduct['productData']['websites'] = $_axWebsites;}
		if ($_axCategories !== NULL) {$_axProduct['productData']['categories'] = $_axCategories;}
		if (($_sProductSku !== NULL) && ($_iProductID !== NULL)) {$_axProduct['productData']['sku'] = $_sProductSku;}
		if ($_sName !== NULL) {$_axProduct['productData']['name'] = $_sName;}
		if ($_dPrice !== NULL) {$_axProduct['productData']['price'] = $_dPrice;}
		if ($_sDescription !== NULL) {$_axProduct['productData']['description'] = $_sDescription;}
		if ($_sShortDescription !== NULL) {$_axProduct['productData']['short_description'] = $_sShortDescription;}
		if ($_dWeight !== NULL) {$_axProduct['productData']['weight'] = $_dWeight;}
		if ($_iStatus !== NULL) {$_axProduct['productData']['status'] = $_iStatus;}
		if ($_iVisibility !== NULL) {$_axProduct['productData']['visibility'] = $_iVisibility;}
		if ($_xTaxClassID !== NULL) {$_axProduct['productData']['tax_class_id'] = $_xTaxClassID;}
		if ($_xStoreView !== NULL) {$_axProduct['storeView'] = $_xStoreView;}
		if ($_sProductIdentifierType !== NULL) {$_axProduct['productIdentifierType'] = $_sProductIdentifierType;}

		return $_axProduct;
	}
	/* @end method */
}
/* @end class */
$oPGMagento = new classPG_Magento();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMagento', 'xValue' => $oPGMagento));}

/*
$oPGMagento->setDebugMode(array('iMode' => PG_DEBUG_HIGH));
$oPGMagento->setHost(array('sHost' => 'http://shop.diez-isis.de/index.php/'));
if ($oPGMagento->login(array('sApiUser' => '$Wuest-!T', 'sApiKey' => '!2kGt67$mAb%59laX')))
{
	echo 'connected!';
	// ProduktID = 9
	// var_dump($oPGMagento->send(array('sCall' => 'catalog_product_attribute_set.list')));
	// var_dump($oPGMagento->send(array('sCall' => 'catalog_product.info', 'xParameters' => array('7'))));
	// var_dump($oPGMagento->send(array('sCall' => 'catalog_category.level', 'xParameters' => array('website' => '1', 'storeView' => '1', 'parentCategory' => '2'))));
	echo $oPGMagento->send(
		array(
			'sCall' => 'catalog_product.create', 
			'xParameters' => array(
				'simple', // type
				'4', // set (set_id)
				'12345', // sku
				array(
					'categories' => array(),
					'websites' => array(),
					'name' => 'Testartikel',
					'price' => '3.50',
					'description' => 'Test-Beschreibung',
					'short_description' => 'Test-Kurzbeschreibung',
					'weight' => '5.00',
					'status' => '1',
					'visibility' => '4',
					'tax_class_id' => 'DE 19%'
					// 'stock_data ' => array('qty' => '')
				)
			)
		)
	);
	echo $oPGMagento->send(
		array(
			'sCall' => 'catalog_product.update', 
			'xParameters' => array(
				'9',
				array(
					'categories' => array('Zu den Angeboten/Wohnen & Leben') // array(utf8_encode('Default Category/Zu den Angeboten/Wohnen & Leben'))
					// 'categories' => array(utf8_encode('Wohnen & Leben')),
					// 'status' => '1'
				)
			)
		)
	);
	$oPGMagento->close();
}
echo $oPGMagento->getDebugString();
*/
?>