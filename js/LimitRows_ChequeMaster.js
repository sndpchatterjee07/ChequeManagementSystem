function limitSetter(selectObj){
	//alert ('Hello');	
	 // get the index of the selected option 
	 var idx = selectObj.selectedIndex; 
 	// get the value of the selected option 
 	 var which = selectObj.options[idx].value;
	 alert (which); 
	 //return which;
	 return false;
}
	