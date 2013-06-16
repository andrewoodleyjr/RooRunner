 <body class="container">
			<div class="row">
					<div class="span12">
						<div class="form-wrapper form-wrapper-login">
							<h2>Update your Task</h2>
                            <h3>Fill out the required information and update the task.</h3>
							
							
                                <form action="/manage/updatetask/<?php echo $info[0]->id; ?> " method="post" >
									
                                    
                                        <label>Job Title</label>
                                       
                                        <input type="text" name="title" id="title" value="<?php if(isset($info[0]->title)){echo $info[0]->title;} ?>" style="width:100%; height:30px"/>
                                      
                                  
                                  
                                        <label>Location</label>
                                        
                                        <input  value="<?php if(isset($info[0]->location)){echo $info[0]->location;} ?>" type="text" name="location" id="location" style="width:100%; height:30px"/>
                                        
                                    
                                    
                                        <label>Reward</label>
                                        
                                        <input  value="<?php if(isset($info[0]->reward)){echo $info[0]->reward;} ?>" type="text" name="reward" id="reward" style="width:100%; height:30px"/>
                                       
                                        <label>Description</label>
                                        
                                        <textarea name="description" id="description" style="width:100%;"><?php if(isset($info[0]->description)){echo $info[0]->description;} ?></textarea>
                                       
                                       <input type="submit" class="btn btn-large btn-primary" name="submit" style="width:100%" value="Submit" />
                                      
                                   
								</form>
                               
								<?php if(isset($error)){echo $error;}?>						
							
						</div>
							
						</div>
					</div>

			

			</div>