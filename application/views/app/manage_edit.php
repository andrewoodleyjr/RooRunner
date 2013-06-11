<div class="container"   >
        
      <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" id="general_div_maincontent" style="margin-left: 5%; width: 80%; margin-right: 5%; margin-top: 40px;">
      
        <h1 >Edit Application Info</h1>
        <p>Here you can edit the information displayed in the App Store for your mobile application.
        </p>
     <br />
        <div class="row-fluid tab-pane active fade in" id="invoice" >
                           <form name="edit_form" action="/app/pay_change" enctype="multipart/form-data" method="post">

                               
                                  <div class="span4">
                    <label>App's Icon Image: </label> 

                    <img src='<?php if(isset($icon)) echo $icon; ?>' class='img-rounded' style="height: 150px; width: 150px;" />
                    
                    <input id="icon_picture" name="icon_picture" type="file" style="display:visible;">
                    <label>Recommendations:  </label>
                    <label>Size: 1024px x 1024px </label>
                    <label>Format: PNG, JPEG, JPG </label>
                    <br />
<br />

                    <label>App's Default Image: </label> 
                 
                    <img src='<?php if(isset($default)) echo $default; ?>' class='img-rounded' style="height: 225px; width: 150px;" />
                    <input id="default_picture" name="default_picture" type="file" style="display:visible;">
                    <label>Recommendations:  </label>
                    <label>Size: 640px x 960px  </label>
                    <label>Format: PNG, JPEG, JPG </label>

                    <br />
                </div>
           

           <div class="span7">
           		<div id="input_container">
                    <label>Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="name" placeholder="Type Name" value="<?php if(isset($name)) echo $name; ?>" />
                    <br />
                    <label>Nickname:</label> <input name="nickname" type="text" placeholder="Type Nickname" value="<?php if(isset($nickname)) echo $nickname; ?>" />
                    <br />
                    <label>Keywords:</label> <input name="keywords" type="text" placeholder="Type Keywords" value="<?php if(isset($keywords)) echo $keywords; ?>" maxlength="100" />
                    <br />
                    
                    <label>Description:</label> 
                 
                   <textarea name="description" id="description" placeholder="Change Me"><?php if(isset($description)) echo $description; ?></textarea>
                    <br />
                    <input type="submit" value="Submit" class="btn btn-large btn-danger" />
                    <br />
                    <br />
					<?php //if(isset($update_message)) echo $update_message; ?> 
                                 </div>      
           </div>
                             </form>

        </div>

     
</div>