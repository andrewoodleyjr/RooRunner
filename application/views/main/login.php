<?php $bodyClass = 'login'; ?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="form-wrapper form-wrapper-login">
                <div id="hackeroo-badge">
                    <a href="http://hackeroo.io" rel="nofollow" target="_blank"><img src="/img/layout/icon-winner-hackeroo.png" alt="Winner Hackeroo"></a>
                </div>
                <h2>Login</h2>
               
                <form method="post" action="/main/login/">
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                            <input type="text" id="email" name="email" class="input-block-level" value="<?php if(isset($email)){echo $email;} ?>" placeholder="Your Email Address">
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
                            <?php if(isset($error)){echo $error;}?>
                        </div>
                    </div>
                    
                    <div class="button-row">
                        <button type="submit" id="submit" name="submit" class="btn btn-large btn-primary">Submit</button>
                    </div>
                    
                    <div class="form-instruction">
                        <p><a href="/main/forgetpassword/">Forgot Password?</a></p>
                        <p>Not registered yet? <a href="/main/Register/">Click here</a> to get started.</p>
                    </div>
                </form>
            </div>
        </div><!-- /.span12 -->
    </div><!-- /.row -->
</div><!-- /.container -->