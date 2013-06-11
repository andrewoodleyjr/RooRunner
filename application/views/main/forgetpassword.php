<br />
<div class="container">

      <form class="form-signin front_panel" method="post" action="">
        <h2 class="form-signin-heading" style="color:#666; text-shadow:0px 2px 2px 0px #000;">Forgot Password</h2>
        
        <input type="email" name="email" class="input-block-level" placeholder="Email address">
        
        <button class="btn-danger btn-large btn-primary" name="submit" type="submit" style="width:100%">Submit</button>
        <p><i>Type in the email address associated with your shwcase account and we will send you a new password.</i></p>
        
        <?php if(isset($message)){echo $message;}?>
          <?php
        $this->load->library('form_validation');
        echo validation_errors(); ?>
        <a href="/main/login/" style="color:#666;">Sign in</a>
      
      </form>

    </div>
