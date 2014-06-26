oPGDocumentation.setNetworkResponseFile({'sFile': 'documentation_response.php'});

oPGEventManager.addEvent(
	{
		'oObject': window, 
		'sEventType': PG_EVENTTYPE_ONLOAD, 
		'fFunction': function(_oEvent)
		{
			oPGBrowser.onLoad(_oEvent);
			oPGFrameset.onResize(_oEvent);
			oPGDocumentation.getDocuFileContent({'sFile': 'start.php'});
		}
	}
);

oPGEventManager.addEvent(
	{
		'oObject': window, 
		'sEventType': PG_EVENTTYPE_ONRESIZE, 
		'fFunction': function(_oEvent)
		{
			if (oPGBrowser.isResized())
			{
				oPGFrameset.onResize(_oEvent);
			}
		}
	}
);

oPGEventManager.addEvent(
	{
		'oObject': document,
		'sEventType': PG_EVENTTYPE_ONMOUSEUP,
		'fFunction': function(_oEvent)
		{
			oPGMouse.onMouseUp(_oEvent);
			oPGFrameset.onMouseUp(_oEvent);
			oPGButton.onMouseUp(_oEvent);
			oPGDragAndDrop.onMouseUp(_oEvent);
			oPGBrowser.enableSelect(_oEvent);
		}
	}
);

oPGEventManager.addEvent(
	{
		'oObject': document,
		'sEventType': PG_EVENTTYPE_ONMOUSEDOWN,
		'fFunction': function(_oEvent)
		{
			oPGMouse.onMouseDown(_oEvent);
			// oPGFrameset.onMouseDown(_oEvent);
		}
	}
);

oPGEventManager.addEvent(
	{
		'oObject': document,
		'sEventType': PG_EVENTTYPE_ONCLICK,
		'fFunction': function(_oEvent)
		{
			oPGDragAndDrop.onClick(_oEvent);
		}
	}
);

oPGEventManager.addEvent(
	{
		'oObject': document,
		'sEventType': PG_EVENTTYPE_ONMOUSEMOVE,
		'fFunction': function(_oEvent)
		{
			oPGMouse.onMouseMove(_oEvent);
			oPGFrameset.onMouseMove(_oEvent);
			oPGDragAndDrop.onMouseMove(_oEvent);
		}
	}
);

