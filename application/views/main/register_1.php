<div class="container"   >

    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" id="general_div_maincontent" style="margin-left: 5%; margin-right: 5%; margin-top: 40px; ">

        <h2 >Register and Create App </h2>
        <p>Create your application's information.
        </p>
        <br />


        <div class="row-fluid tab-pane active fade in"  id="invoice" >
            <form id="form" action="/main/register/" name="edit_form" enctype="multipart/form-data" method="post">

                <div class="span4">


                    <input id="icon_picture" name="icon_picture" type="file" style="display:none;">
                    <label class="edit_label">App's Icon Image: </label> 
                    <div  class="input-append">
                        <input style="width: 100px;" id="icon" class="input-large" type="text">
                        <a class="btn" onclick="$('input[id=icon_picture]').click();">Browse</a>
                    </div>               
                    <br />  
                    <img src='/images/512x512.png' class='img-rounded' style="height: 150px; width: 150px;" />
                    <br />

                    <input id="default_picture" name="default_picture" type="file" style="display:none;">
                    <label class="edit_label">App's Front Page: </label> 
                    <div  class="input-append">
                        <input style="width: 100px;" id="default" class="input-large" type="text">
                        <a class="btn" onclick="$('input[id=default_picture]').click();">Browse</a>
                    </div>   
                    <br />
                    <img src='/images/Default.png' class='img-rounded' style="height: 225px; width: 150px;" />
                    <br />
                </div>


                <div class="span7" style="padding-left: 10px;">
                    <div id="input_container">
                        First Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="first_name" name="first_name" type="text" placeholder="First Name" value="<?php if (isset($first_name)) echo $first_name; ?>" maxlength="128" />
                        <br />
                        Last Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="last_name" name="last_name" type="text" placeholder="Last Name" value="<?php if (isset($last_name)) echo $last_name; ?>" maxlength="128" />
                        <br />
                        Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="email" name="email" type="email" placeholder="email" value="<?php if (isset($email)) echo $email; ?>" maxlength="128" />
                        <br />
                        Phone:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="phone" name="phone" type="tel" placeholder="Phone Number" value="<?php if (isset($phone)) echo $phone; ?>" maxlength="128" />
                        <br />
                        Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="password" name="password" type="password" placeholder="password" value="<?php if (isset($password)) echo $password; ?>" maxlength="128" />
                        <br />                    
                        Confirm Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input id="confirm_password" name="confirm_password" type="password" placeholder="confirm password" value="<?php if (isset($confirm_password)) echo $confirm_password; ?>" maxlength="128" />
                        <br />
                        App Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" id="name" name="appname" placeholder="App Name" value="<?php if (isset($name)) echo $name; ?>" />
                        <br />
                        App Nickname: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nickname" name="App Nickname" type="text" placeholder="App Nickname" value="<?php if (isset($nickname)) echo $nickname; ?>" maxlength="10" />
                        <br />
                        Keywords:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input id="keywords" name="keywords" type="text" placeholder="Keywords" value="<?php if (isset($keywords)) echo $keywords; ?>" maxlength="128" />
                        <br />


                        Description: 
                        <br /> 
                        <textarea name="description" id="description" placeholder="Type the app description."><?php if (isset($description)) echo $description; ?></textarea>
                        <br />
                        <button id="submit_form" type="submit" name="submit"  class="btn btn-large btn-success" >Submit</button>

                        <br />
                        <div  id="error_message" class="alert alert-danger" style="display:none; margin-top: 30px;"></div>

                    </div>      
                </div>
            </form>

        </div>


    </div>
