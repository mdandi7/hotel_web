/* 
File : jsfunction.js
Author : Danny Bastian M.
Use : Every Javascript function will be placed here for hotel-website project.
Version : 1.0.0
*/

$(document).ready(function(){
	
	$(document).on("click",".btn-find-book",function(e){
		var bkCode = $(".booking-code").val();
		
		if(!bkCode){
			alert("Isi Booking Code anda!");
			return false;
		}
		$(".cancel-table-show").css("display","block");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "book-cancel",
            bkCode : bkCode,
          },
          complete: function(response){
          	$(".cancel-table").html(response.responseText);
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});

	});

	$(document).on("click",".btn-cancel-book",function(e){
		var bkCd = $(this).attr("data-id");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "cancel-bookcd",
            bkCd : bkCd,
          },
          complete: function(response){
          	$(".btn-find-book").trigger("click");
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	})

});