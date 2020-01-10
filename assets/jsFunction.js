/* 
File : jsfunction.js
Author : Danny Bastian M.
Use : Every Javascript function will be placed here for hotel-website project.
Version : 1.0.0
*/

$(document).ready(function(){

	//Autofill date field in page

	function fillDate(){
	  var today = new Date();
	  if(today.getDate() < 10){
	    var date = '-0'+today.getDate();
	  }else{
	    var date = '-'+today.getDate();
	  }
	  if((today.getMonth()+1) < 10){
	    var month = '-0'+(today.getMonth()+1);
	  }else {
	    var month = '-'+(today.getMonth()+1);
	  }

	  var fullDate = today.getFullYear()+month+date;
	  $("input[type=date]").val(fullDate);
	  //document.getElementById("tgl1").value = fullDate;
	};

	fillDate();

	$(document).on("input",".tgl-chck", function(e){
		var ckIn = new Date($(".tgl-checkin").val());
		var ckOt = new Date($(".tgl-checkout").val());

		var diff = (ckOt - ckIn)/1000/60/60/24;
		$("#LmInap").val(diff +" Hari");
	});

	$(document).on("click",".btn-room",function(e){
		$(".room-name").val($(this).attr("room-name"));
		var roomId = $(this).attr("data-room");

		$.ajax({
			type: "POST",
			url:'ajax-all-files.php',
			data: {
				txInd : "room-price",
				roomId : roomId,
			},
			complete: function (response){
				$("#hrgKmr").val(response.responseText);
			},
			error: function(){
				alert("Connection to database failed!");
			}
		});
		return false;
	});

	$(document).on("click",".btn-order", function(e){
		var sucInd = 0;
		$(".form-tamu-detail").find("input").each(function(){
			if($(this).prop('required') && $(this).val() == ''){
				var placeHold = $(this).attr("placeholder")
				var alertAdd =  placeHold + " tidak boleh kosong";
				$(".alert-add").html(alertAdd);
				sucInd = 1;
				return false;
			}else{
				$(".alert-add").html("");
				sucInd = 0;
			}
		});

		if(sucInd == 1){
			return false;
		}else{
			var roomNm = $(".room-name").val();
			var LmInap = $("#LmInap").val();
	      	var LmInap1 = LmInap.split(" ");
	      	if(!roomNm){
	      		$(".alert-add").html("Pilih Kamar Terlebih Dahulu");
	      	}else if(!LmInap){
				$(".alert-add").html("Pilih Tanggal Check in & Out");
			}else if(LmInap1[0] <= 0){
				$(".alert-add").html("Pilih Tanggal Check in & Out dengan benar!");
			}
		}
	});
});