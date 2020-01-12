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
		var roomName = $(this).attr("room-name");
		var roomId = $(this).attr("data-room");
		
		$.ajax({
			type: "POST",
			url:'ajax-all-files.php',
			data: {
				txInd : "room-price",
				roomId : roomId,
			},
			complete: function (response){
				var resp = response.responseText.split('|');
				if(resp[1] <= 0){
					alert("Mohon Maaf, Untuk saat ini tidak ada kamar yang tersedia untuk tipe kamar ini.");
					return false;
				}else{
					$("#hrgKmr").val(resp[0]);
					$(".room-name").val(roomName);
					$(".room-name").attr("data-id",roomId);
				}
				
			},
			error: function(){
				alert("Connection to database failed!");
			}
		});
		return false;
	});

	$(document).on("click",".btn-order", function(e){
		//var declare
		var sucInd = 0;
		var noKtp = $("#idKtp").val();
		var nama = $("#nama").val();
		var noHP = $("#noHP").val();
		var email = $("#email").val();
		var roomId = $(".room-name").attr("data-id");
		var chckin_dt = $(".tgl-checkin").val();
		var chckout_dt = $(".tgl-checkout").val();
		var total = $("#ttlByr").val();

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
	      		sucInd = 1;
	      	}else if(!LmInap){
				$(".alert-add").html("Pilih Tanggal Check in & Out");
				sucInd = 1;
			}else if(LmInap1[0] <= 0){
				$(".alert-add").html("Pilih Tanggal Check in & Out dengan benar!");
				sucInd = 1;
			}else{
				var harga = $("#hrgKmr").val();
				var total = LmInap1[0] * harga
				$("#ttlByr").val(total);
			}
		}

		if(sucInd == 1){
			return false;
		}else{
			$.ajax({
				type: "POST",
				url:'ajax-all-files.php',
				data: {
					txInd : "book-ind",
					noKtp : noKtp,
					nama : nama,
					noHP : noHP,
					email : email,
					roomId : roomId,
					chckin_dt : chckin_dt,
					chckout_dt : chckout_dt,
					total : total,
				},
				complete: function (response){
					$("#PymntConfirmModal").modal("show");
					$(".btn-modal").css("display","block");
					$(".disp-total-price").html("Total Pembayaran : Rp. " + total);
					$(".btn-konfirm-paid").attr("data-current-id",response.responseText);
					$(".btn-order").attr("disabled",true);
				},
				error: function(){
					alert("Connection to database failed!");
				}
			});
			return false;
		}
	});

	$(document).on("click",".btn-konfirm-paid",function(e){
		var current_id = $(this).attr("data-current-id");

		$.ajax({
			type: "POST",
			url:'ajax-all-files.php',
			data: {
				txInd : "updt-user-paid-ind",
				current_id : current_id,
			},
			complete: function (response){
				$("#PymntConfirmModal").modal("hide");
				$(".btn-konfirm-paid").attr("disabled",true);
				$(".paid-modal-head").html("Konfirmasi Pembayaran telah anda lakukan! Admin Kami akan mengkonfirmasi kembali!<br> Muat ulang halaman untuk Booking berikutnya.");
			},
			error: function(){
				alert("Connection to database failed!");
			}
		});

		return false;
	});
});