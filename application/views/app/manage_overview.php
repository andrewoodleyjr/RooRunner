<div class="container">
    	<br />
    	<div class="row show-grid">
            <div class="span12" id="overview_top_general" >
                <div class="span9"   id="overview_top_bar" >
                
                <img src='<?php if($small_pic) echo $small_pic; ?>' class='img-rounded overview_top_bar_image' />                 
                    <p id="top_bar_info" >
                    <span id="overview_top_bar_app_name"><?php if(isset($app_name)) echo $app_name; ?></span>
                    
                    
                    <br />Nickname: <?php if(isset($app_nickname)) echo $app_nickname; ?>
                    <br />Keywords: <?php if(isset($keyword)) echo $keyword; ?> 
                   <!-- <br /><?php if(isset($subscription)) echo $subscription; ?> -->
                    </p>                    
                </div>
                
                <div class="span2" id="overview_sidebar_top" >
                
                       
                    	
					
                        <?php if(isset($status)) echo $status; ?>
                </div>
                
                
            </div>
         </div>
         <br />
       <div class="row-fluid">
               <div  class="span3" id="overview_sidebar" >
                
	                <h3 id="overview_sidebar_title">Overview</h3>
	                <p id="overview_sidebar_text" >
				Here you can view details regarding your application.
			</p>
          
          	<a  class="btn btn-success overview_a_buttons" href='/app/manage_app/' >                          
                    Manage Content
               </a>
                   
                       <br />
               <a class="btn btn-info overview_a_buttons" href='/app/users/'>							
                    My Users
               </a>
               <br />
	               <a href="/app/edit/"  class="btn btn-inverse overview_a_buttons" >
                           Edit App Store Info
                       </a>
            <?php if(isset($status3)) echo $status3; ?>          
            <?php if(isset($status4)) echo $status4; ?>
            <?php if(isset($status2)) echo $status2; ?>

	               <br />
		
      
                      

             
		 <!-- <a class="btn btn-primary overview_a_buttons"  href="/app/subscribe/"  >
                    Subscribe
                </a> --> 
                
           </div>
           
                <div class="span9" id="overview_description_container" >
                 <div id="settings" >
                     <div class="pull-left span3">
                    <img src='<?php if(isset($second_img)) echo $second_img; ?>' class='img-rounded' id="iphone_pic" />
                    </div>
                     <div class="span7">
                    <h3 id="overview_sidebar_title" >
                    Description </h3>
                    
                    <div id="overview_description_div" >
                        <?php if(isset($description)) echo nl2br($description); ?>
                    </div>
                     </div>
                </div> 

            </div>
         </div>
	</div>