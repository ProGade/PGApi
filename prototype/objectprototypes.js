/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
oPGPrototypes.setOnElement({'oClass': Object, 'sName': 'getName', 'xValue': function() {return "Object";}});

if (typeof(oPGObjects) != 'undefined')
{
	oPGPrototypes.classToPrototypes({'sSetClass': 'Object', 'oGetClass': oPGObjects, 'sGetClass': 'oPGObjects'});
}
