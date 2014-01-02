// JavaScript Document

function postData(){

var amount = '5';
var email = '';
var website = '';
var message = $('#message').val();

 var dataString = 'amount='+ name + '&email=' + email + '&website=' + website + '&message=' + message;  
 $("#error").html("Processing...");
 $.ajax({  
   type: "POST",  
   url: "tr.post.php",  
   data: dataString,  
   error: function(){
     //alert('Error loading document');
	 return false; 
   },
   success: function() {
     //place something here
   }
 });
return true;
}

function loadTr(offset){
$("#messages").html("Loading...").hide().fadeIn("slow");
$('#messages').load('../lib/pnp/board/messages.php?offset='+offset).hide().fadeIn("slow");
return false;
}

$(document).ready(function(){
$("#trtable").html("<img  src='../assets/img/blue-h-s.gif'/>").hide().fadeIn("slow");
setTimeout(function () {
       
             $('#trtable').load('tr.display.php').fadeIn("slow");
        }, 2000);
         
 //custom
 $("#tradd").click(function () {   
    $(this).removeClass("btn btn-warning");
    $(this).addClass("btn btn-danger");
    $(this).attr('disabled', 'disabled');
    $(this).html('Processing....');
$("#trtable").html("<img  src='../assets/img/blue-h-s.gif'/>").fadeIn("slow");

//

$.post("tr.post.php", { trdate: $('#date').val(),  trfrom: $('#trfrom').val() ,  trto: $('#trto').val() ,  amount: $('#amount').val() , memo: $('#memo').val(), trtype: $('#trtype').val()})
.done(function(data) {
 // alert("Data Loaded: " + data);
 $("#rmsg").html(data).fadeIn("slow");
 $('#trtable').load('tr.display.php').fadeIn("slow");
     setTimeout(function () {
        $("#tradd").removeClass("btn btn-danger");
    $("#tradd").addClass("btn btn-warning");
            
             
             $("#tradd").removeAttr('disabled');
             $("#tradd").html('Add Entry');
        }, 2000);
});
//


   
});
 // 
  
});