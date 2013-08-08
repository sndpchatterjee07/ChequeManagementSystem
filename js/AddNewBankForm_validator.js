/*  On form Submission  */
function check_AddNewBankAccount_form(){
	
	//alert('Sandeep');
	var numcheck	=	/(^\d+$)|(^\d+\.\d+$)/ ;	// checking for number	

	//  Checking whether Account No. is left blank or not.
	if((document.AddNewBankAccount_form.user_account_no.value == "") || (document.AddNewBankAccount_form.user_account_no.value.charAt(0) == " "))
	{
		     alert('Please provide your Bank Account No ! ');
	         document.AddNewBankAccount_form.user_account_no.focus();
	         return false;
	}
	
    //  Checking whether Account Balance is left blank or not.
	if((document.AddNewBankAccount_form.balance.value == "") || (document.AddNewBankAccount_form.balance.value.charAt(0) == " "))
	{
		     alert('Please specify your Bank Balance ! ');
		     document.AddNewBankAccount_form.balance.focus();
	         return false;
	}
	
// Checking whether Account Balance is a valid number
	if(!numcheck.test(document.AddNewBankAccount_form.balance.value))
	{
		   alert('Account Balance should be numeric !');
		   document.AddNewBankAccount_form.balance.focus();
		   return false;
	}
	if(window.confirm('Are you sure that all details entered are correct ?' + '\n\n' + 'Click OK to insert record.' + '\n' + 'Click Cancel to recheck.'))
        return true;
     else
      return false;
	
}