/**
 *   Script for opening a popup window when user tries to search his Bank IFSC Code
 */

function pop(url)
{
	 var width  = 420;
	 var height = 110;
	 var left   = (screen.width  - width)/2;
	 var top    = (screen.height - height)/2;
	 
	 
	 var params = 'width='+width+', height='+height;
	 params += ', top='+top+', left='+left;
	 params += ', directories=no';
	 params += ', location=no';
	 params += ', menubar=no';
	 params += ', resizable=no';
	 params += ', scrollbars=no';
	 params += ', status=no';
	 params += ', toolbar=no';
	 newwin=window.open(url,'windowname5', params);
	 if (window.focus) {newwin.focus();}
}
