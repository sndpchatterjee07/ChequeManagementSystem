/* This script gets triggered on "onblur" event of "user_account_no" field present in the "ChequeDataInsertForm.php".

  		Checks 2 things:
	 1. Whether Account Number for that user really exists or not ?
	 2. For Debit type transactions,user has sufficient funds or not.
	 
*/

var request = false;
try{	
	request = new XMLHttpRequest(); // For IE7+, Firefox, Chrome, Opera, Safari
}
catch (trymicrosoft)
{
   try{
      request = new ActiveXObject("Msxml2.XMLHTTP");
   }
   catch (othermicrosoft){
	   try{
		   		request = new ActiveXObject("Microsoft.XMLHTTP"); // For IE6, IE5
       }
       catch (failed){
         request = false;
       }
    }
}

if (!request)   // Check and see if request is still false (if things are going okay, it won't be).
           alert("Error initializing XMLHttpRequest!");
/*
else
           alert("XMLHttpRequest succesfully initialized.");
*/

function checkAccountNumberValidity()
{
	var a = document.getElementById('transaction_type');
	
	var transaction_type = a.options[a.selectedIndex].value;
	var user_account_no = document.getElementById("user_account_no").value;
	var cheque_amount = document.getElementById("cheque_amount").value;
    //alert(cheque_amount);
	var url = "checkAccountNumberValidity.php?transaction_type=" + transaction_type + "&user_account_no=" +user_account_no + "&cheque_amount=" + cheque_amount;	
    request.open("GET", url, true);   //  true means request is asynchronous.
    request.onreadystatechange = promptUserForCorrection;// After server's processing is over, promptUser( )  gets called.
	request.send(null);	// Since request is sent via URL, null is passed as an argument to send(  ) .
}



function promptUserForCorrection()
{
	// alert(request.reponseText);
	// alert(request.status);
	//alert(request.readyState);

	//0: The request is uninitialized (before you've called open()).
	//1: The request is set up, but hasn't been sent (before you've called send()).
	//2: The request was sent and is being processed (you can usually get content headers from the response at this point).
	//3: The request is being processed; often some partial data is available from the response, but the server hasn't finished with its response.
	//4: The response is complete; you can get the server's response and use it.



    if (request.readyState == 4)
       if (request.status == 200)
       {
            var a = request.responseText;
            document.getElementById("isValidAccountNo").innerHTML = a;
       }
       else if (request.status == 404)
       {
           alert("Requested URL does not exist");
       }
       else
       {
           alert("Error: status code is " + request.status);
       }
}