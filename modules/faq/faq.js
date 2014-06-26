/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Faq()
{
	// Declarations...
	this.asCategories = new Array();
	this.asQuestions = new Array();
	this.bCategoriesClosed = true;
	this.bQuestionsClosed = true;
	
	// Construct...
	
	// Methods...
	/* @start method */
	this.init = function()
	{
		var i=0;
		if (this.bCategoriesClosed == true) {for (i=0; i<this.asCategories.length; i++) {this.closeCategory(this.asCategories[i]);}}
		if (this.bQuestionsClosed == true) {for (i=0; i<this.asQuestions.length; i++) {this.closeQuestion(this.asQuestions[i]);}}
	}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	this.useCategoriesClosed = function(_bUse) {this.bCategoriesClosed = _bUse;}
	/* @end method */

	/* @start method */
	this.isCategoriesClosed = function() {return this.bCategoriesClosed;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	this.useQuestionsClosed = function(_bUse) {this.bQuestionsClosed = _bUse;}
	/* @end method */

	/* @start method */
	this.isQuestionsClosed = function() {return this.bQuestionsClosed;}
	/* @end method */

	/*
	@start method
	@param sCategoryID
	*/
	this.registerCategory = function(_sCategoryID)
	{
		this.asCategories.push(_sCategoryID);
	}
	/* @end method */
	
	/*
	@start method
	@param sQuestionID
	*/
	this.registerQuestion = function(_sQuestionID)
	{
		this.asQuestions.push(_sQuestionID);
	}
	/* @end method */

	/*
	@start method
	@param sCategoryID
	*/
	this.openCategory = function(_sCategoryID)
	{
		var _oCategory = this.oDocument.getElementById(_sCategoryID);
		var _oCategoryIconOpen = this.oDocument.getElementById(_sCategoryID+'IconOpen');
		var _oCategoryIconClose = this.oDocument.getElementById(_sCategoryID+'IconClose');
		if (_oCategory)
		{
			_oCategory.style.display = 'block';
			if (_oCategoryIconOpen) {_oCategoryIconOpen.style.display = 'inline';}
			if (_oCategoryIconClose) {_oCategoryIconClose.style.display = 'none';}
		}
	}
	/* @end method */
	
	/*
	@start method
	@param sCategoryID
	*/
	this.closeCategory = function(_sCategoryID)
	{
		var _oCategory = this.oDocument.getElementById(_sCategoryID);
		var _oCategoryIconOpen = this.oDocument.getElementById(_sCategoryID+'IconOpen');
		var _oCategoryIconClose = this.oDocument.getElementById(_sCategoryID+'IconClose');
		if (_oCategory)
		{
			_oCategory.style.display = 'none';
			if (_oCategoryIconOpen) {_oCategoryIconOpen.style.display = 'none';}
			if (_oCategoryIconClose) {_oCategoryIconClose.style.display = 'inline';}
		}
	}
	/* @end method */
	
	/*
	@start method
	@param sCategoryID
	*/
	this.switchCategory = function(_sCategoryID)
	{
		var _oCategory = this.oDocument.getElementById(_sCategoryID);
		if (_oCategory)
		{
			if (_oCategory.style.display == 'none') {this.openCategory(_sCategoryID);}
			else {this.closeCategory(_sCategoryID);}
		}
	}
	/* @end method */
	
	/*
	@start method
	@param sQuestionID
	*/
	this.openQuestion = function(_sQuestionID)
	{
		var _oQuestion = this.oDocument.getElementById(_sQuestionID);
		var _oQuestionIconOpen = this.oDocument.getElementById(_sQuestionID+'IconOpen');
		var _oQuestionIconClose = this.oDocument.getElementById(_sQuestionID+'IconClose');
		if (_oQuestion)
		{
			_oQuestion.style.display = 'block';
			if (_oQuestionIconOpen) {_oQuestionIconOpen.style.display = 'inline';}
			if (_oQuestionIconClose) {_oQuestionIconClose.style.display = 'none';}
		}
	}
	/* @end method */
	
	/*
	@start method
	@param sQuestionID
	*/
	this.closeQuestion = function(_sQuestionID)
	{
		var _oQuestion = this.oDocument.getElementById(_sQuestionID);
		var _oQuestionIconOpen = this.oDocument.getElementById(_sQuestionID+'IconOpen');
		var _oQuestionIconClose = this.oDocument.getElementById(_sQuestionID+'IconClose');
		if (_oQuestion)
		{
			_oQuestion.style.display = 'none';
			if (_oQuestionIconOpen) {_oQuestionIconOpen.style.display = 'none';}
			if (_oQuestionIconClose) {_oQuestionIconClose.style.display = 'inline';}
		}
	}
	/* @end method */

	/*
	@start method
	@param sQuestionID
	*/
	this.switchQuestion = function(_sQuestionID)
	{
		var _oQuestion = this.oDocument.getElementById(_sQuestionID);
		if (_oQuestion)
		{
			if (_oQuestion.style.display == 'none') {this.openQuestion(_sQuestionID);}
			else {this.closeQuestion(_sQuestionID);}
		}
	}
	/* @end method */
}
/* @end class */
classPG_Faq.prototype = new classPG_ClassBasics();
var oPGFaq = new classPG_Faq();
