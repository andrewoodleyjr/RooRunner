 <div class="container">
        
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" id="general_div_maincontent" >
      
        <h1 id="delete">Delete <?php if(isset($app_name)) echo $app_name; ?>?</h1>
        <p>Here you can confirm deleting <?php if(isset($app_name)) echo $app_name; ?>, removing all of its content and users.
        </p>
        <br />
     
        <div class="row-fluid tab-pane active fade in" id="invoice" >
           
           <div class="span4">
               		<img src="<?php if(isset($small_pic)) echo $small_pic; ?>" class="img-rounded" />
                                
              		
              
           </div>
           
           
           <div class="span6" >
           <h3>Deleting this app will do the following:</h3>
                
                <ul>
                    <li>Delete The App</li>
                    <li>Remove All Its Content</li>
                    <li>Disable Users from using the app</li>
                </ul>
            
            <a href="/manage/" class="btn btn-large" id="cancelBtn" >Cancel</a> 
            <a href="/app/delete_all/<?php if(isset($App_ID)) echo $App_ID; ?>" class="btn btn-large btn-danger" id="deleteBtn" >Delete</a> 	
           </div>
        
           
        </div>
        
     
</div>