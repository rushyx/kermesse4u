function plusSlides(e){showSlides(slideIndex+=e)}function currentSlide(e){showSlides(slideIndex=e)}function showSlides(e){var s,l=document.getElementsByClassName("mySlides"),t=document.getElementsByClassName("dot");for(e>l.length&&(slideIndex=1,e=1),e<1&&(slideIndex=l.length),s=0;s<l.length;s++)l[s].style.display="none";for(s=0;s<t.length;s++)t[s].className=t[s].className.replace(" active","");l[slideIndex-1].style.display="block",t[slideIndex-1].className+=" active",sendRequest(sel,e)}function sendRequest(e,s){var l={};$.ajax({type:"POST",dataType:"json",url:webservice,data:{selector:e,gno:s},success:function(e){rowCnt=e.noRows,rowCnt<10?($("#gallery").addClass("text-center"),$("#gallery").removeClass("text-left")):($("#gallery").removeClass("text-center"),$("#gallery").addClass("text-left")),$("#gallery").html(e.rowData),$("#gallery a").photoSwipe(l)},error:function(s,l,t){console.log("[Kermesse] Ajax error in SendRequest. xhr= ",s,"status = ",l,"err = ",t),console.log("Sorry an unexpected server error occurred with selector = "+e+" If you keep seeing this please inform Admin")},complete:function(e,s){}})}$(document).ready(function(){showSlides(slideIndex),$(".dot").tooltip()});