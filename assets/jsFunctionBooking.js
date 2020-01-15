/* 
File : jsFunctionBook.js
Author : Danny Bastian M.
Use : Every Javascript function will be placed here for hotel-website project.
Version : 1.0.0
*/

$(document).ready(function(){

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

	//Booking Page

	$(document).on("click",".clear-search",function(e){

		$(".search-table").css("display","none");
		$(".all-tables").css("display","block");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "book-page",
          },
          complete: function(response){
          	var rsp = response.responseText.split("|");

          	$(".pending-table").html(rsp[0]);
          	$(".succed-table").html(rsp[1]);
          	$(".chckout-table").html(rsp[2]);
            $(".chckin-table").html(rsp[3]);
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	$(".clear-search").trigger("click");

	$(document).on("click",".button-confirm",function(e){
		var bookId = $(this).attr("data-id");
		
		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "confirm-book",
            bookId : bookId,
          },
          complete: function(response){
          	$(".clear-search").trigger("click");
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	$(document).on("click",".btn-confirm-ckout",function(e){
		var bookId = $(this).attr("data-id");
		var roomId = $(this).attr("data-room");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "confirm-ckout",
            bookId : bookId,
            roomId : roomId,
          },
          complete: function(response){
          	$(".clear-search").trigger("click");
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	$(document).on("click",".find-data-ktp",function(e){
		var ktpNum = $(".ktp-search").val();
		if(!ktpNum){
			alert("Masukkan No.KTP!")
			return false;
		}

		$(".search-table").css("display","block");
		$(".all-tables").css("display","none");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "search-ktp",
            ktpNum : ktpNum,
          },
          complete: function(response){
          	$(".search-table-show").html(response.responseText);
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	//Guest Page

	$(document).on("click",".clear-guest",function(e){

		$(".guest-table-search").css("display","none");
		$(".guest-table").css("display","block");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "guest-page",
          },
          complete: function(response){
          	$(".guest-table-show").html(response.responseText);
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	$(".clear-guest").trigger("click");

	$(document).on("click",".find-guest-ktp",function(e){
		var ktpNum = $(".ktp-search-guest").val();
		if(!ktpNum){
			alert("Masukkan No.KTP!")
			return false;
		}

		$(".guest-table-search").css("display","block");
		$(".guest-table").css("display","none");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "search-guest-page",
            ktpNum : ktpNum,
          },
          complete: function(response){
          	$(".search-guest-table").html(response.responseText);
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	//Pegawai

	$(document).on("click",".btn-regist-pgw",function(e){
		var nip = $("#nip").val();
		var namapegawai = $("#namapegawai").val();
		var jeniskelamin = $("#jeniskelamin").val();
		var tgllahir = $("#tgllahir").val();
		var alamat = $("#alamat").val();

		if(!nip || !namapegawai || !alamat || jeniskelamin == "0"){
			alert("Isi Form dengan benar");
			return false;
		}

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "insert-pegawai",
            nip : nip,
            namapegawai : namapegawai,
            jeniskelamin : jeniskelamin,
            tgllahir : tgllahir,
            alamat : alamat,
          },
          complete: function(response){
          	$(".alert-add").html(response.responseText);
          	$(".clear-pegawai").trigger("click");
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	$(document).on("click",".clear-pegawai",function(e){
		$(".pegawai-search-nip").val("");
		$(".pegawai-table-search").css("display","none");
		$(".pegawai-table").css("display","block");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "pegawai-page",
          },
          complete: function(response){
          	$(".pegawai-table-show").html(response.responseText);
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	$(".clear-pegawai").trigger("click");

	$(document).on("click",".find-pegawai",function(e){
		var nip = $(".pegawai-search-nip").val();
		if(!nip){
			alert("Masukkan Nomer NIP dengan benar");
			return false;
		}

		$(".pegawai-table-search").css("display","block");
		$(".pegawai-table").css("display","none");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "pegawai-page-search",
            nip : nip,
          },
          complete: function(response){
          	$(".pegawai-table-search-show").html(response.responseText);
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

	$(document).on("click",".btn-delete-pgw",function(e){
		var nip = $(this).attr("data-id");

		$.ajax({
		  type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "pegawai-delete",
            nip : nip,
          },
          complete: function(response){
          	$(".clear-pegawai").trigger("click");
          },
          error: function(){
            alert("Connection to database failed!");
          }
		});
	});

  $(document).on("click",".btn-confirm-ckin", function(e){
    var bkCd = $(this).attr("data-id");

    $.ajax({
      type : 'POST',
          url : 'ajax-all-files.php',
          data : {
            txInd : "confirm-chckin-bt",
            bkCd : bkCd,
          },
          complete: function(response){
            $(".clear-search").trigger("click");
          },
          error: function(){
            alert("Connection to database failed!");
          }
    });    
  })
});