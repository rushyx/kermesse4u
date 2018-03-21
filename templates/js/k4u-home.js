$(document).ready(function(){

	//console.log("[Kermesse] Home page. No. of slides = ", noSlides," Slide change time (ms) = ", changeTm);
	sendRequest(sel, 1);
	setInterval(change, changeTm);

});

function change() {
	sendRequest(sel, 1);
}

function sendRequest(sel, fbs) {

	$.ajax({
		type: "POST",
		dataType: 'json',
		url: webservice,
		data: {  selector: sel, 
					gno: fbs }, 
		success: function (data) 
		{
			rowCnt = data.noRows;
			$('#fbtext').html(data.rowData);
			$('#fb-img').html(data.imgLink);
			
		},
		error: function (xhr, status, err) {
			 console.log("[Kermesse] Ajax error. xhr= ",xhr, "status = ", status, "err = ", err);
			 console.log("Sorry an unexpected server error occurred with selector = "+sel+" If you keep seeing this please inform Admin");
		},
		complete: function (xhr, status) {
			//console.log("[Kermesse] Ajax response complete. rowCnt = ", rowCnt);
		}		
  });	
}