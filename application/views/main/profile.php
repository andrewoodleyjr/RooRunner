<?php 
    $bodyClass = 'internal';
    $trust2 = 0;
    //Calculate Points Here
    if(strlen($info->image)):
        $trust2++;
    endif;
    if(strlen($info->name)):
        $trust2++;
    endif;
    if(strlen($info->description)):
        $trust2++;
    endif;
    if(strlen($info->twitter)):
        $trust2++;
    endif;
    if(strlen($info->phone)):
        $trust2++;
    endif;
    if(strlen($info->location)):
        $trust2++;
    endif;
?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="form-wrapper form-wrapper-login">
                <h2>Your Profile</h2>
                <h3>Modify your profile, trust points and reward points.</h3>
                <?php if(isset($error['error'])){echo $error['error'];} ?>

                <form method="post" enctype="multipart/form-data" action="/manage/UpdateProfile/">

                    <h4>Profile Picture</h4>
                    <input type="file" name="picture" id="picture" placeholder="Upload a Picture" style="display:block !important"	/>
                    <div id="profile-pic">
                        <?php 
                            if(strlen($info->image) > 0) echo '<img src="' . $info->image . '" alt="Profile Pic">'; 
                            else echo '<div class="no-pic"></div>';
                        ?>
                       
                    </div>
                   

                    <h4>Profile Status</h4>
                    <p><strong>Trust Points:</strong> <?php $trust2 += $trust; echo $trust2; ?></p>
                    <p><strong>Reward Points:</strong>  <?php echo $reward; ?></p>
                    <p><strong>Crediblity:</strong> <?php if(($trust2 >= 0) && ($trust2 <= 5)) echo 'RooRunner Newbie'; elseif(($trust2 >= 6) && ($trust2 <= 10)) echo 'Verified RooRunner';  elseif(($trust2 >= 11) && ($trust2 <= 25)) echo 'Reliable RooRunner ';  elseif(($trust2 >= 26) /*&& ($trust2 <= 10)*/) echo 'Expert RooRunner';?></p>

                    <!--<h4>Profile Preferences</h4>
                    <label class="checkbox" for="type">
                        <input type="checkbox" name="type" id="type" value="1" 
                        <?php 
                           /* if(isset($info->type)): 
                                if($info->type == 1):
                                    echo 'checked';
                                endif;
                            endif;*/      
                        ?>> I want to be a RooRunner!
                    </label>

                    <label class="checkbox" for="cansend">
                        <input type="checkbox" name="cansend" id="cansend" value="1" 
                        <?php 
                            /*if(isset($info->cansend)): 
                                if($info->cansend == 1):
                                    echo 'checked';
                                endif;
                            endif;*/
                        ?>> Accept SMS &amp; Email Alerts when a new RooRun is available
                    </label>-->

                    <h4>Profile Details</h4>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input type="text" id="name" name="name" class="input-block-level" value="<?php if(isset($info->name)){echo $info->name;} ?>" placeholder="Your Name">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                            <input type="text" id="email" name="email" class="input-block-level" value="<?php if(isset($info->email)){echo $info->email;} ?>" placeholder="Your Email Address">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-phone"></i></span>
                            <input type="text" id="phone" name="phone" class="input-block-level" value="<?php if(isset($info->phone)){echo $info->phone;} ?>" placeholder="Your Phone Number">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-map-marker"></i></span>
                            <input type="text" id="location" name="location" class="input-block-level" value="<?php if(isset($info->location)){echo $info->location;} ?>" placeholder="Location">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-twitter"></i></span>
                            <input type="text" id="twitter" name="twitter" class="input-block-level" value="<?php if(isset($info->twitter)){echo $info->twitter;} ?>" placeholder="Twitter Handle">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="description">Your Bio</label>
                        <div class="controls">
                            <textarea id="description" name="description" class="input-block-level" placeholder="Enter a brief description about yourself"><?php if(isset($info->description)){echo $info->description;} ?></textarea>
                        </div>
                    </div>
                    <div class="button-row">
                        <button type="submit" id="submit_form" name="submit" class="btn btn-large btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div><!-- /.span12 -->
    </div><!-- /.row -->
</div><!-- /.container -->