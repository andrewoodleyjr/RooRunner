<?php $bodyClass = 'login'; ?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="form-wrapper form-wrapper-login">
                <h2>Forgot Password?</h2>
                <p>Enter the email address that you used to register with RooRunner and we will send you a new password.</p>
                <form method="post" action="">
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                            <input type="text" id="email" name="email" class="input-block-level" placeholder="Your Email Address">
                        </div>
                    </div>
                    <div class="button-row">
                        <button type="submit" id="submit" name="submit" class="btn btn-large btn-primary" >Submit</button>
                    </div>
                    <div class="form-instruction">
                        <p><a href="/main/login/">Login</a> or <a href="/main/Register/">Register</a></p>
                    </div>
                    <?php if(isset($message)){echo $message;}?>
                    <?php 
                        $this->load->library('form_validation'); 
                        echo validation_errors(); 
                    ?>
                </form>
            </div>
        </div><!-- /.span12 -->
    </div><!-- /.row -->
</div><!-- /.container -->