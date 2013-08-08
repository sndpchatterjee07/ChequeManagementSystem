// JavaScript Document
function check(){
	
	//alert('Hello');
	//return false;
	
   var numcheck	=	/(^\d+$)|(^\d+\.\d+$)/ ;	// checking for number	
	
  //  Checking whether Company Id is left blank or not.
  if((document.sundrydatainsert_form.company_id.value == "") || (document.sundrydatainsert_form.company_id.value.charAt(0) == " "))
    {
	     alert('Please provide Company Id !');
         document.sundrydatainsert_form.company_id.focus();
         return false;
    }
	
	//  Checking whether Company Name is left blank or not.
if((document.sundrydatainsert_form.company_name.value == "") || (document.sundrydatainsert_form.company_name.value.charAt(0) == " "))
    {
	     alert('Please provide Company Name !');
         document.sundrydatainsert_form.company_name.focus();
         return false;
    }	
	
	
	//  Checking whether Contact Person Name is left blank or not.
if((document.sundrydatainsert_form.responsible_person.value == "") || (document.sundrydatainsert_form.responsible_person.value.charAt(0) == " "))
    {
	     alert('Please provide name of Contact Person !');
         document.sundrydatainsert_form.responsible_person.focus();
         return false;
    }	
	
	
	//  Checking whether Contact Person Address is left blank or not.
	if((document.sundrydatainsert_form.responsible_person_address.value == "") || (document.sundrydatainsert_form.responsible_person_address.value.charAt(0) == " "))
    {
	     alert('Please provide address of Contact Person !');
         document.sundrydatainsert_form.responsible_person_address.focus();
         return false;
    }	
	
   //  Checking whether Contact Person No. is left blank or not.
	if((document.sundrydatainsert_form.responsible_person_contact_no.value == "") || (document.sundrydatainsert_form.responsible_person_contact_no.value.charAt(0) == " "))
    {
	     alert('Please provide contact no. of concerned person !');
         document.sundrydatainsert_form.responsible_person_contact_no.focus();
         return false;
    }	
	
	// Checking whether Contact Person No. is a valid number
	 if(!numcheck.test(document.sundrydatainsert_form.responsible_person_contact_no.value))
	 {
	           alert('Please specify a valid contact no ! For Example: 22837100');
	           document.sundrydatainsert_form.responsible_person_contact_no.focus();
	           return false;
	  }
	
	
	if(window.confirm('Are you sure that all details entered are correct ?' + '\n\n' + 'Click OK to insert record.' + '\n' + 'Click Cancel to recheck.'))
           return true;
        else
         return false;   
}
	