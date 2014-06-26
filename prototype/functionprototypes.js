/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
oPGPrototypes.setOnElement({'oClass': Function, 'sName': 'getClassName', 'xValue': function() {return "Function";}});
oPGPrototypes.setOnElement({'oClass': Function, 'sName': 'getTypeOfInstance', 'xValue': function() {return "Function";}});
oPGPrototypes.setOnElement(
	{
		'oClass': Function,
		'sName': 'getName', 
		'xValue': function()
		{
			var _asMatches = this.toString().match(/^function\s(\w+)/);
			return _asMatches ? _asMatches[1] : "anonymous";
		}
	}
);
