function change(){sendRequest(sel,1)}function sendRequest(e,n){$.ajax({type:"POST",dataType:"json",url:webservice,data:{selector:e,gno:n},success:function(e){rowCnt=e.noRows,$("#fbtext").html(e.rowData),$("#fb-img").html(e.imgLink)},error:function(n,o,t){console.log("[Kermesse] Ajax error. xhr= ",n,"status = ",o,"err = ",t),console.log("Sorry an unexpected server error occurred with selector = "+e+" If you keep seeing this please inform Admin")},complete:function(e,n){}})}$(document).ready(function(){sendRequest(sel,1),setInterval(change,changeTm)});