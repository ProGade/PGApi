/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 22 2012
*/
oPGPrototypes.setOnElement({'oClass': Object, 'sName': 'getName', 'xValue': function() {return "Object";}});

if (typeof(oPGObjects) != 'undefined')
{
	oPGPrototypes.classToPrototypes({'sSetClass': 'Object', 'oGetClass': oPGObjects, 'sGetClass': 'oPGObjects'});
}
