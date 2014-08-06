/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 22 2012
*/
oPGPrototypes.setOnElement({'oClass': String, 'sName': 'getName', 'xValue': function() {return "String";}});
oPGPrototypes.setOnElement({'oClass': String, 'sName': 'getClassName', 'xValue': function() {return "String";}});
oPGPrototypes.setOnElement({'oClass': String, 'sName': 'getTypeOfInstance', 'xValue': function() {return "String";}});

if (typeof(oPGStrings) != 'undefined')
{
	oPGPrototypes.classToPrototypes({'sSetClass': 'String', 'oGetClass': oPGStrings, 'sGetClass': 'oPGStrings'});
}
