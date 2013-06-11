    <div class="container">
	<br />
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit" id="general_div_maincontent">
        <h1 >Users</h1>
        <p>Here you can view your current users, demographics as well as send emails and notifying your users through push notifications.</p>
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#demographics" data-toggle="tab">Demographics</a>
          </li>
          <li><a href="#users" data-toggle="tab">Users</a></li>
          <li><a href="#message" data-toggle="tab">Message</a></li>
         
        </ul>
        <input type="hidden" id="App_ID" value="<?php if(isset($App_ID)) echo $App_ID; ?>" />
        <div id="myTabContent" class="tab-content">
        
        <div class="row-fluid tab-pane active fade in" id="demographics">
           <div class="span7">
               <div id="demoChart">
                   
               </div>
               
              
               <div class="span13 manage_user_center" > 
	               	<select id="demoChange">
	                   <option value="age">Age</option>
	                   <option value="location">Location</option>
	                   <option value="gender" >Sex</option>
                           <option value="Push" >Subscribers</option>

	               </select>
           		<button class="btn btn-success" id="submit_demo">View</button>
           	</div>
           </div>
           
              <div class="span4">
		
                <h3 >Demographics</h3>
                <p>Here you can view data and statistics of the users using your mobile application. </p>
                <h3 >Reminder</h3>
                <p>You can use this information to determine who your average users are.</p>
                <h3 >Tips</h3>
                <p>Use this information to determine how and what message to send your users.</p>
              
              </div>
                 <br />
         
              
           </div>
           
       
            

        <div class="row-fluid tab-pane fade" id="users" >
           
           <div class="span10">

               <table id="userTable" class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Location</th>
                  <th>Age</th>
                  <th>Sex</th>
                  <th>Email</th>
                  <th>Push</th>
                </tr>
              </thead>
              <tbody>

                  <?php if(isset($app_table)){echo $app_table;} ?>
              </tbody>
            </table>
            
           
           </div>

           <div class="span2">
	        <h3 >Users</h3>
                <p>Here you can view all current users on your apps as well as their basic information</p>
                <h3 >Reminders</h3>
                <p>User contact information is not provided! However you can contact them through email and phone using the GOI message system.</p>
                
           </div>
           
        </div>
        
        <div class="row-fluid tab-pane fade" id="message" >
           
             <div class="span7">
               
                 <div class="messsage_toptext_data" > 
			Type a message and click the submit button to send. Limit: 100 Characters.        
		</div>

                 <textarea id="message_textarea" onkeypress="return imposeMaxLength(this, 100);">​</textarea>
  
            
                 <div id="checkBox"><input type="checkbox" id="email" /> Check this box to send emails as well. </div>
                 <br />
                 <div class="row-fluid">
                 	<div class="span3">
                    	<button class="btn btn-success" id="submit_push">Submit</button>
                    </div>
                    <div class="span9">
                    	<div style="display: none;" id="success_message" class="alert alert-success">
                        </div>
                        <div style="display: none;" id="error_message" class="alert alert-danger">
                        </div>
                    </div>
                  </div>
           
             </div>
           
              <div class="span4">
		
                <h3>Message</h3>
                <p>Here you can send emails and push notifications to your users.</p>
                <h3 >Reminders</h3>
                <p>
                Its best to stay in contact with your users by keeping them updated.
                </p>
              <h3 >Tips</h3>
              <p>Be Mindful of How Many Messages You Send! Users quickly annoyed by spam messages.</p>
                </div>
               <br />
           
        </div>
     
        </div>
        
      </div>
    </div>