<?php $bodyClass = 'login'; ?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="form-wrapper form-wrapper-login">
                <h2>Register</h2>
                <p>So you're at the festival enjoying the show, and you need something ... <strong>anything</strong>. Problem is that you don't want to lose your coveted place at the front of the stage! Or maybe you just don't feel like standing in line? <strong>RooRunner is for you!</strong></p>
                <p>Sign up for RooRunner and you can request that other people at the festival get your stuff! <strong>You benefit by not having to navigate the crowds, and your personal RooRunner benefits from your eternal thanks (and your generous rewards)!</strong></p>
                <form method="post" action="/main/register/">
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input type="text" id="name" name="name" class="input-block-level" value="<?php if(isset($name)){echo $name;} ?>" placeholder="Your Name">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                            <input type="text" id="email" name="email" class="input-block-level" value="<?php if(isset($email)){echo $email;} ?>" placeholder="Your Email Address">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-phone"></i></span>
                            <input type="text" id="phone" name="phone" class="input-block-level" value="<?php if(isset($phone)){echo $phone;} ?>" placeholder="Your Phone Number">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <input type="password" id="password" name="password" class="input-block-level" value="<?php if(isset($password)){echo $password;} ?>" placeholder="Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-repeat"></i></span>
                            <input type="password" id="confirmpassword" name="confirmpassword" class="input-block-level" value="" placeholder="Repeat Password">
                        </div>
                    </div>
                    <div class="button-row">
                        <button type="submit" id="submit_form" name="submit" class="btn btn-large btn-primary" >Submit</button>
                    </div>
                    <div class="form-instruction">
                        <p>Already registered? <a href="/main/login/">Click here</a> to login.</p>
                        <p>By Registering You Accept Shwcase <a href="http://www.shwcase.co/terms.html" rel="nofollow" target="_blank">Terms of Service</a> and <a href="http://www.shwcase.co/privacy.html" target="_blank">Privacy Policy</a>.</p>
                    </div>
                    <div id="error_message" class="alert alert-danger" style="display: none;"></div>
                </form>
            </div>
        </div><!-- /.span12 -->
    </div><!-- /.row -->
</div><!-- /.container -->