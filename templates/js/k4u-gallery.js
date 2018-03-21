$(document).ready(function(){
	showSlides(slideIndex);
	
	$('.dot').tooltip();

});

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  
  if (n > slides.length) {
  	slideIndex = 1;
	n = 1;  	
  }
  	
  if (n < 1) {slideIndex = slides.length}
  
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";

 // post off ajax to request gallery no. n
 sendRequest(sel, n); 
 
}

function sendRequest(sel, galNo) {

	var psopt = {}; // optional photoswipe options
	
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: webservice,
		data: {  selector: sel, 
					gno: galNo }, // selector, gallery no.
		success: function (data) 
		{
			rowCnt = data.noRows;
			if (rowCnt < 10) {
				$('#gallery').addClass('text-center');
				$('#gallery').removeClass('text-left');
			}
			else {
				$('#gallery').removeClass('text-center');
				$('#gallery').addClass('text-left');				
			}
		
			$('#gallery').html(data.rowData);
			$("#gallery a").photoSwipe(psopt);			
		},
		error: function (xhr, status, err) {
			 console.log("[Kermesse] Ajax error in SendRequest. xhr= ",xhr, "status = ", status, "err = ", err);
			 console.log("Sorry an unexpected server error occurred with selector = "+sel+" If you keep seeing this please inform Admin");
		},
		complete: function (xhr, status) {
			//console.log("[Kermesse] sendRequest. Ajax response rowCnt = ", rowCnt);
		}		
  });	
}