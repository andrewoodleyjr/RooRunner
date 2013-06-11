<div class="container">
    <br />
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" id="general_div_maincontent">
        <h1>Settings</h1>
       
     <p>
               From here you can change your basic account info.</p>
      <div class="tabbable "> 
  <ul class="nav nav-tabs">
    <li class='<?php if(isset($tab1)){echo $tab1; }?>' id="account"><a href="#tab1" data-toggle="tab">Account</a></li>
    <li class='<?php if(isset($tab2)){echo $tab2; }?>' id="password"><a href="#tab2" data-toggle="tab">Password</a></li>
    <li class='<?php if(isset($tab3)){echo $tab3; }?>' id="website"><a href="#tab3" data-toggle="tab">Website</a></li>

  
  </ul>
  <div class="tab-content span9">
    <div class="tab-pane  span4 <?php if(isset($div1)){echo $div1;} ?>" id="tab1">
        <form class="pull-left" method="post" action="" enctype="multipart/form-data" >
        <label>First Name</label>
        <input type="text" name="firstname" value="<?php if(isset($firstname)){echo $firstname;} ?>" />
        <label>Last Name</label>
        <input type="text" name="lastname" value="<?php if(isset($lastname)){echo $lastname;} ?>" />
        <label>Email</label>
        <input type="text" name="email" value="<?php if(isset($email)){echo $email;} ?>" />
        <label>Mobile</label>
        <input type="text" name="mobile" value="<?php if(isset($phone)){echo $phone;} ?>" /><br />
        <button type="submit" name="submitprofile" class="btn btn-success">Save</button>
        </form>
        <br />
        <?php if(isset($userprofileerror)){echo $userprofileerror;}?>
    </div>
    <div class="tab-pane span4 <?php if(isset($div2)){echo $div2;} ?>" id="tab2">
        
        <form class="pull-left" method="post" action="" enctype="multipart/form-data" >
        <label>Old Password</label>
        <input type="password" name="oldpassword" value="" />
        <label>New Password</label>
        <input type="password" name="newpassword" value="" />
        <label>Retype New Password</label>
        <input type="password" name="confirmpassword" value="" /><br />
        <button type="submit" name="submitpass" class="btn btn-success">Save</button>
        </form>
        <br />
        <?php if(isset($userpassworderror)){echo $userpassworderror;}?>

    </div>
    <div class="tab-pane span4 <?php if(isset($div3)){echo $div3;} ?>" id="tab3">
        
        <form class="pull-left" method="post" action="" enctype="multipart/form-data" >
        <label>Specify Your Website</label>
        <input type="text" name="website_ext" value="<?php if(isset($website)){echo $website;} ?>" />.shwcase.co
        <label style="color:#A7271C">No Spaces!</label>
		<!--<br />
        <label>Background Image</label>
        
        <input type="file" name="backgroundImage" value="" />
        <label><input type="checkbox" name=""/> Check here to use background image.</label>
        
        <br />--><br />
        <button type="submit" name="submitweb" class="btn btn-success">Save</button>
        </form>
        <br />
        <?php if(isset($userwebsite)){echo $userwebsite;}?>

    </div>
    
      
              <div class="span4 pull-right">
           
               <h3>Tips:</h3>
              
            <p>
            Add your website for when others wish to get in contact with you regarding your application, product or service.
           </p>
            
            <h4>Recommendations:</h4>
        <p>In the event you choose to upload a background image we recommend upload an image with a background size of 1440px (width) by 900px (height) your choice of format, as long as it works.</p>
     
           
           </div>  
  </div>
</div>
         
        

    </div>
</div>

<script type="text/javascript">		 						
		var hash = window.location.hash;
		
		if(hash == "#website") 
		{
				document.getElementById("website").className = "active";
				document.getElementById("tab3").className = "tab-pane span4 active";
				document.getElementById("password").className = "";
				document.getElementById("tab2").className = "tab-pane span4 ";
				document.getElementById("account").className = "";
				document.getElementById("tab1").className = "tab-pane span4";
		}
</script>

