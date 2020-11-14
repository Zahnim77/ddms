 // For Number Input Only 
 //------------------------------------------------------------------- Start
	function isNumberKey(evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 
		&& (charCode < 48 || charCode > 57))
		return false;
		return true;
	}
	function isNumericKey(evt) {
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 
		&& (charCode < 48 || charCode > 57))
		return true;
		return false;
	}
 // For Number Input Only 
 //--------------------------------------------------------------------- end



// For Password Show / Hide
// --------------------------------------------------------------- Start
$(document).ready(function(){
	$('.pass_show').append('<span class="ptxt">Show</span>');  
	});
	$(document).on('click','.pass_show .ptxt', function(){ 
	$(this).text($(this).text() == "Show" ? "Hide" : "Show"); 
	$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
});
// For Password Show / Hide
// --------------------------------------------------------------- Start




 // For Age Calculation Query Only 
 //------------------------------------------------------------------- START
	function submitBday(){
	  var Q4A = "";
	  var Bdate = document.getElementById('bday').value;
	  var Bday = +new Date(Bdate);
	  Q4A += + ~~ ((Date.now() - Bday) / (31557600000));
	  var theBday = document.getElementById('resultBday');
	  theBday.innerHTML = Q4A;
	}
 // For Age Calculation Query Only 
 //------------------------------------------------------------------- end




 // For Image Onclick File Load Query Only 
 //------------------------------------------------------------------- START
	window.addEventListener("DOMContentLoaded", function(){
	  document.getElementById("imgLoadingButton1").addEventListener("click", function(){
	    document.getElementById("realInput1").addEventListener("change", function(){
	    });
	    document.getElementById("realInput1").click();
	  });
	  document.getElementById("imgLoadingButton2").addEventListener("click", function(){
	    document.getElementById("realInput2").addEventListener("change", function(){
	    });
	    document.getElementById("realInput2").click();
	  });
	  document.getElementById("imgLoadingButton3").addEventListener("click", function(){
	    document.getElementById("realInput3").addEventListener("change", function(){
	    });
	    document.getElementById("realInput3").click();
	  });
	  document.getElementById("imgLoadingButton4").addEventListener("click", function(){
	    document.getElementById("realInput4").addEventListener("change", function(){
	    });
	    document.getElementById("realInput4").click();
	  });
	  document.getElementById("imgLoadingButton5").addEventListener("click", function(){
	    document.getElementById("realInput5").addEventListener("change", function(){
	    });
	    document.getElementById("realInput5").click();
	  });
	  document.getElementById("imgLoadingButton6").addEventListener("click", function(){
	    document.getElementById("realInput6").addEventListener("change", function(){
	    });
	    document.getElementById("realInput6").click();
	  });
	  document.getElementById("imgLoadingButton7").addEventListener("click", function(){
	    document.getElementById("realInput7").addEventListener("change", function(){
	    });
	    document.getElementById("realInput7").click();
	  });
	  document.getElementById("imgLoadingButton8").addEventListener("click", function(){
	    document.getElementById("realInput8").addEventListener("change", function(){
	    });
	    document.getElementById("realInput8").click();
	  });
	  document.getElementById("imgLoadingButton9").addEventListener("click", function(){
	    document.getElementById("realInput9").addEventListener("change", function(){
	    });
	    document.getElementById("realInput9").click();
	  });
	  document.getElementById("imgLoadingButton10").addEventListener("click", function(){
	    document.getElementById("realInput10").addEventListener("change", function(){
	    });
	    document.getElementById("realInput10").click();
	  });
	  document.getElementById("imgLoadingButton11").addEventListener("click", function(){
	    document.getElementById("realInput11").addEventListener("change", function(){
	    });
	    document.getElementById("realInput11").click();
	  });
	  document.getElementById("imgLoadingButton12").addEventListener("click", function(){
	    document.getElementById("realInput12").addEventListener("change", function(){
	    });
	    document.getElementById("realInput12").click();
	  });
	});
 // For Image Onclick File Load Query Only 
 //------------------------------------------------------------------- end




 // For Onclick Button Alert Query Only 
 //------------------------------------------------------------------- START
function createFunction(){
  alert("Are You Want to Create Profile!");
}
function editFunction(){
  alert("Are You Want to Edit Profile!");
}
function saveFunction(){
  alert("Are You Want to Save Profile!");
}
function uploadFunction(){
  alert("Are You Want to Upload Profile!");
}
function deleteFunction(){
  alert("Are You Want to Delete Profile!");
}
function approvalFunction(){
  alert("Are You Want to Approve Profile!");
}
 // For Onclick Button Alert Query Only  
 //------------------------------------------------------------------- end






 // For Div Area Print Query Only 
 //------------------------------------------------------------------- START
  //<button type="button" class="bttn print" onclick="printDiv('printableArea')">Print</button>
  // <div id="printableArea"> print content area</div>
	function printDiv(divName) {
	 var printContents = document.getElementById(divName).innerHTML;
	 var originalContents = document.body.innerHTML;
	 document.body.innerHTML = printContents;
	 window.print();
	 document.body.innerHTML = originalContents;
	}
 // For Div Area Print Query Only 
 //------------------------------------------------------------------- end






 // For Table Export 2 Excel Query Only 
 //------------------------------------------------------------------- START
	$('#exp2excel').click(function () {
		$("#table_sorting_types").table2excel({
			filename: "SearchResult.xls"
		});
	});
 // For Table Export 2 Excel Query Only 
 //------------------------------------------------------------------- end




