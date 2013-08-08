// JavaScript Document
function check_bankdatainsert_form(){
	//alert('Hello');
	
  var numcheck	=	/(^\d+$)|(^\d+\.\d+$)/ ;	// checking for number	

  //  Checking whether Bank Code is left blank or not.
  if((document.bankdatainsert_form.bank_code.value == "") || (document.bankdatainsert_form.bank_code.value.charAt(0) == " "))
  {
	     alert('Please provide 11-digit IFSC Code ! Example(ANDHRA BANK): ANDB0000593 ');
         document.bankdatainsert_form.bank_code.focus();
         return false;
  }

  //  Checking whether Bank Name is left blank or not.
  if((document.bankdatainsert_form.bank_name.value == "") || (document.bankdatainsert_form.bank_name.value.charAt(0) == " "))
  {
	     alert('Please provide Bank Name !');
         document.bankdatainsert_form.bank_name.focus();
         return false;
  } 	
	
  
 //  Checking whether Bank Address is left blank or not.
  if((document.bankdatainsert_form.bank_address.value == "") || (document.bankdatainsert_form.bank_address.value.charAt(0) == " "))
  {
	     alert('Please provide bank address !');
         document.bankdatainsert_form.bank_address.focus();
         return false;
  } 			

  //  Checking whether Bank Contact No. is left blank or not.
  if((document.bankdatainsert_form.bank_contactno.value == "") || (document.bankdatainsert_form.bank_contactno.value.charAt(0) == " "))
  {
	     alert('Please provide contact no of the branch !');
         document.bankdatainsert_form.bank_contactno.focus();
         return false;
  } 
  
  // Checking whether Bank Contact No. is a valid number
  if(!numcheck.test(document.bankdatainsert_form.bank_contactno.value))
  {
	   alert('Please specify a valid contact no ! For Example: 22837100');
	   document.bankdatainsert_form.bank_contactno.focus();
	   return false;
  }
  
  
  
  if(window.confirm('Are you sure that all details entered are correct ?' + '\n\n' + 'Click OK to insert record.' + '\n' + 'Click Cancel to recheck.'))
           return true;
        else
         return false;  
}