<br />
<div class="container">

      <form class="form-signin front_panel"  method="post" action="/main/login/">
        <h2 class="form-signin-heading" >Sign In</h2>
        <p>Why miss a moment when someone is willing to stand in line for you.</p>
        <input type="text" name="email" class="input-block-level" value="<?php if(isset($email)){echo $email;} ?>" placeholder="Email address">
        <input type="password" name="password" class="input-block-level" value="<?php if(isset($password)){echo $password;} ?>" placeholder="Password">
        <button class="btn-primary btn-large" type="submit" name="submit" style="width:100%">Sign in</button>
        <br><br>
        
        <a  href="/main/forgetpassword/"><button class="btn-danger btn-large" type="button" name="submit" style="width:100%">Forgot Password</button></a>
        <br /><br />
        <a  href="/main/Register/"><button class="btn-info btn-large" type="button" name="submit" style="width:100%">Register</button></a>
        <br><br>
        <?php if(isset($error)){echo $error;}?>
      
      </form>
    </div>