$(document).ready(function(){

  pager();
  	
});


function pager() {
	
	if (rowCnt < fbPerPg) {
		fbs = 0;
		pc = 1;
	}
	else {
		pc++;
	} 

	sendRequest('feedback', fbs);
	fbs += fbPerPg;
}

function sendRequest(sel, fbs) {

	$.ajax({
		type: "POST",
		dataType: 'json',
		url: webservice,
		data: {  selector: sel, 
					gno: fbs,
					fbpp: fbPerPg }, 
		success: function (data) 
		{
			rowCnt = data.noRows;
			$('#fb-text').html(data.rowData);
			$('#pgind').text(pc + ' / ' + noPgs);			
		},
		error: function (xhr, status, err) {
			 console.log("[Kermesse] Ajax error. Selector= ", sel, " xhr= ", xhr, " status = ", status, " err = ", err);
			 console.log("Sorry an unexpected server error occurred with selector = "+sel+" If you keep seeing this please inform Admin");
		},
		complete: function (xhr, status) {
			//console.log("[Kermesse] Ajax response complete. rowCnt = ", rowCnt);

		}		
  });	
  
}