/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
oPGPrototypes.setOnElement({'oClass': Array, 'sName': 'getName', 'xValue': function() {return "Array";}});
oPGPrototypes.setOnElement({'oClass': Array, 'sName': 'getClassName', 'xValue': function() {return "Array";}});
oPGPrototypes.setOnElement({'oClass': Array, 'sName': 'getTypeOfInstance', 'xValue': function() {return "Array";}});

if (typeof(oPGArrays) != 'undefined')
{
	oPGPrototypes.classToPrototypes({'sSetClass': 'Array', 'oGetClass': oPGArrays, 'sGetClass': 'oPGArrays'});
}
