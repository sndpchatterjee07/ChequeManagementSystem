// JavaScript Document
function check_chequedatainsert_form(){
	
   var numcheck	=	/(^\d+$)|(^\d+\.\d+$)/ ;	// checking for number	
	
   //  Checking whether Cheque No. is left blank or not.
   if((document.chequedatainsert_form.cheque_no.value == "") || (document.chequedatainsert_form.cheque_no.value.charAt(0) == " "))
   {
		alert('Please provide Cheque No !');
		document.chequedatainsert_form.cheque_no.focus();
	    return false;
	}
   
   // Checking whether Cheque amount is left blank or not.
   if((document.chequedatainsert_form.cheque_amount.value == "") || (document.chequedatainsert_form.cheque_amount.value.charAt(0) == " "))
   {
		alert('Please provide Cheque Amount !');
		document.chequedatainsert_form.cheque_amount.focus();
	    return false;
	}
   
   // Checking whether Cheque Amount is a valid number.
   if(!numcheck.test(document.chequedatainsert_form.cheque_amount.value))
   {
           alert('Please specify a valid amount !');
           document.chequedatainsert_form.cheque_amount.focus();
           return false;
   }
   
/* Checking whether issued_to is left blank or not.
   if((document.chequedatainsert_form.issued_to.value == "") || (document.chequedatainsert_form.issued_to.value.charAt(0) == " "))
   {
		alert('Please provide name to whom cheque is issued to !');
		document.chequedatainsert_form.issued_to.focus();
	    return false;
	}
   
 Checking whether issued_from is left blank or not.
   if((document.chequedatainsert_form.issued_from.value == "") || (document.chequedatainsert_form.issued_from.value.charAt(0) == " "))
   {
		alert('Please provide name of Cheque issuer  !');
		document.chequedatainsert_form.issued_from.focus();
	    return false;
	}*/
   
   if((document.chequedatainsert_form.issued_to.value == "") && (document.chequedatainsert_form.issued_from.value == "")){
	   alert('Please provide Debtor/Creditor details  !');
	   return false;
   }
   
   // Enabling the disabled values
   document.getElementById('issued_from').disabled=false;
   document.getElementById('issued_to').disabled=false;
   
   
   if(window.confirm('Are you sure that all details entered are correct ?' + '\n\n' + 'Click OK to insert record.' + '\n' + 'Click Cancel to recheck.'))
       return true;
    else
     return false;
}