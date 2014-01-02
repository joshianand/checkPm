<?php header('Content-type: text/javascript');
$msgposter= $_GET['_x'];
 ?>
// JavaScript Document
function limitChars(limit){

var text = $('#message').val(); 
var textlength = text.length;

$('#count').html(textlength);

if(textlength > limit){
return false;
}else{
return true;
}

}

function isValidEmail(str) {
return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
}

function postData(){

var name = '<?php 

echo $msgposter;

?>';
var email = '';
var website = '';
var message = $('#message').val();

 var dataString = 'name='+ name + '&email=' + email + '&website=' + website + '&message=' + message;  
 $("#error").html("Processing...");
 $.ajax({  
   type: "POST",  
   url: "../lib/pnp/board/post.php",  
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

function loadMessages(offset){
$("#messages").html("Loading...").hide().fadeIn("slow");
$('#messages').load('../lib/pnp/board/messages.php?offset='+offset).hide().fadeIn("slow");
return false;
}

$(document).ready(function(){

  loadMessages(0);
  


  $("#message").keyup(function() {
     limitChars(20);
  });

  //$("form").submit(function() {
  $("#submit").click(function() {
  

     if($('#message').val()==''||$('#name').val()==''){
        $('#error').html("Name and Message cannot be empty").addClass('error').hide().fadeIn("slow");
        return false; 
	 };	 
	 
	
	 if($('#message').val().length>300){
	 $('#error').html("Message must not exceed 300 characters.").addClass('error').hide().fadeIn("slow");
	 return false; 
	 };
	
	 if(postData()){
	 $('#error').html("Processing.....").removeClass('error').hide().fadeIn("slow");
	 $.timer(3000,function(){
	 $('#error').html("Message inserted!").addClass('success').hide().fadeIn("slow");
	 loadMessages(0);
	 
	 //$('input[@type="text"]').val("");
	var name = '<?php 

echo $msgposter;

?>';
var email = '';
var website = '';
var message = $('#message').val();
	 });
	 }else{
	 $('#error').html("Database Error.").fadeIn("slow");
	 return false; 
	 }
	 return false;

  });
  
  
});