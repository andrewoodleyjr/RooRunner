$(document).ready(function(){
        
    $("#submit_form").live('click',function(){
       
       var email = $("#email").val();
       var password = $("#password").val();
       var confirmpassword = $("#confirmpassword").val();
       var firstname = $("#firstname").val();
       var lastname = $("#lastname").val();


        if(  email === '' || password === '' || lastname === '' || firstname === '' 
            || confirmpassword === ''){
           $("#error_message").html("Please fill out the form completely");
           $("#error_message").show('fast');
           return false;
         }
     if(password.length < 6){
           
           $("#error_message").html("Please make your password larger then six characters.");
           $("#error_message").show('fast');
           return false;
       }    
      if(password !== confirmpassword){
           $("#error_message").html("Your passwords do not match.");
           $("#error_message").show('fast');
           return false;
       }
       
       if(!email.match(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)){
           $("#error_message").html("Please enter a valid email address.");
           $("#error_message").show('fast');
           return false;
       }

      $("form").submit();
       
       
    });
   
});


