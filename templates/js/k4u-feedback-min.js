function pager(){rowCnt<fbPerPg?(fbs=0,pc=1):pc++,sendRequest("feedback",fbs),fbs+=fbPerPg}function sendRequest(e,r){$.ajax({type:"POST",dataType:"json",url:webservice,data:{selector:e,gno:r,fbpp:fbPerPg},success:function(e){rowCnt=e.noRows,$("#fb-text").html(e.rowData),$("#pgind").text(pc+" / "+noPgs)},error:function(r,o,n){console.log("[Kermesse] Ajax error. Selector= ",e," xhr= ",r," status = ",o," err = ",n),console.log("Sorry an unexpected server error occurred with selector = "+e+" If you keep seeing this please inform Admin")},complete:function(e,r){}})}$(document).ready(function(){pager()});