<br />
<div class="container">

      <form action="/main/register/" class="form-signin" style="background-color:#FFF;  margin-top: 40px;" method="post" >
        <h2 class="form-signin-heading" style="color:#666; text-shadow:0px 2px 2px 0px #000;">Register</h2>
        <input id="firstname" type="text" name="firstname" class="input-block-level" 
               value="<?php if(isset($firstname)){echo $firstname;} ?>" placeholder="First Name">
        <input id="lastname" type="text" name="lastname" class="input-block-level" 
               value="<?php if(isset($lastname)){echo $lastname;} ?>" placeholder="Last Name">
        <input id="email" type="text" name="email" class="input-block-level" 
               value="<?php if(isset($email)){echo $email;} ?>" placeholder="Email address">
        <input id="password" type="password" name="password" class="input-block-level" 
               value="" placeholder="Password">
        <input id="confirmpassword" type="password" name="confirmpassword" class="input-block-level" 
               value="" placeholder="Confirm Password">
        <button class="btn-success btn-large btn-primary" name="submit" type="submit" style="width:100%">Submit</button>
        <br><br>
        <div id="error_message" style="display: none;"></div>
         
      
      </form>

    </div>