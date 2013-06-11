<br />
<div class="container">

      <form action="/main/register/" class="form-signin front_panel" method="post" >
        <h2 class="form-signin-heading" style="color:#666; text-align:center; text-shadow:0px 2px 2px 0px #000;">Register</h2>
        <input id="name" type="text" name="name" class="input-block-level" 
               value="<?php if(isset($name)){echo $name;} ?>" placeholder="Name">
        <input id="email" type="text" name="email" class="input-block-level" 
               value="<?php if(isset($email)){echo $email;} ?>" placeholder="Email">
        <input id="phone" type="text" name="phone" class="input-block-level" 
               value="<?php if(isset($phone)){echo $phone;} ?>" placeholder="Phone Number">
        <input id="password" type="password" name="password" class="input-block-level" 
               value="" placeholder="Password">
        <input id="confirmpassword" type="password" name="confirmpassword" class="input-block-level" 
               value="" placeholder="Confirm Password">
               <p><i>By Registering You Accept Shwcase <a href="http://www.shwcase.co/terms.html" target="_blank">Terms of Service</a> and <a href="http://www.shwcase.co/privacy.html" target="_blank">Privacy Policy</a>.</i></p>
        <button id="submit_form" class="btn-danger btn-large btn-primary" name="submit" type="submit" style="width:100%">Submit</button>
        <br><br>

        <div id="error_message" class="alert alert-danger" style="display: none;"></div>
         
      
      </form>

    </div>