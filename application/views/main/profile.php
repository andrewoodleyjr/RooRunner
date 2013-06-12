 <body class="left-sidebar">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div id="content-inner">
					
							<!-- Post -->
								<article class="is-post is-post-excerpt">
									<header>
										<!--
											Note: Titles and bylines will wrap automatically when necessary, so don't worry
											if they get too long. You can also remove the "byline" span entirely if you don't
											need a byline.
										-->
										<h2><a href="#">Profile</a></h2>
                                        <span class="byline">
                                        <?php 	
												//if statement that tells users if they 
												//fill out this or that they will earn trust points
												//else do nothing
												
										?>
                                        View your trusted and reward points and update your RooRunner profile. 
                                        </span>
                                        <span class="byline">
                                        
								<?php 
								
								 if(isset($error['error'])){echo $error['error'];}?>
                                
                                </span>	
									</header>
								</article>
                                
								<hr width="100%"/>	
									
		<!-- Put the required document here! -->
        							
        						<?php 
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
								<article class="is-post is-post-excerpt">
                                <form action="/manage/UpdateProfile/" method="post" enctype="multipart/form-data" >
									<div class="row">
                                        <div class="4u" align="center">
                                        <label>Profile Picture</label>
                                        <img src="<?php if(isset($info->image)) echo $info->image; else echo '/images/apple-touch-icon-144-precomposed.png'; ?>" width="150" height="150" />
                                        <input type="file" name="picture" id="picture" />
                                        </div>
                                        <div class="7u" style="padding-top:35px">
                                        <h4>Roorunner Status</h4>
                                        <label>Trust Points: <?php $trust2 += $trust; echo $trust2; ?></label>
                                        <label>Reward Points:  <?php echo $reward; ?></label>
                                        <label>Crediablity Status: <?php if(($trust2 >= 0) && ($trust2 <= 5)) echo 'RooRunner Newbie'; elseif(($trust2 >= 6) && ($trust2 <= 10)) echo 'Verified RooRunner';  elseif(($trust2 >= 11) && ($trust2 <= 25)) echo 'Reliable RooRunner ';  elseif(($trust2 >= 26) /*&& ($trust2 <= 10)*/) echo 'Expert RooRunner';?></label>
                                        
                                        <label><input type="checkbox" name="type" id="type" value="1" <?php if(isset($info->type)): 
												 
													if($info->type == 1):
														echo 'checked';
													endif;
												
												endif;		
										?> > Check to become a Runner</label>
                                        <label><input type="checkbox" name="cansend" id="cansend" value="1" <?php if(isset($info->cansend)): 
												
													if($info->cansend == 1):
														echo 'checked';
													endif;
												
												endif;		
										?>> Accept SMS & Email Alerts for new Runs.</label>
                                        </div>
                                    </div>
                                  
                                  <div class="row">
                                        <div class="2u">
                                        <label>Name</label>
                                        </div>
                                        <div class="9u">
                                        <input placeholder="First and Last Name"  value="<?php if(isset($info->name)){echo $info->name;} ?>" type="text" name="name" id="name" style="width:100%; height:30px"/>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="2u">
                                        <label>Email</label>
                                        </div>
                                        <div class="9u">
                                        <input  placeholder="Email Address"  value="<?php if(isset($info->email)){echo $info->email;} ?>" type="text" name="email" id="email" style="width:100%; height:30px"/>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="2u">
                                        <label>Phone</label>
                                        </div>
                                        <div class="9u">
                                        <input placeholder="xxx-xxx-xxxx"  value="<?php if(isset($info->phone)){echo $info->phone;} ?>" type="text" name="phone" id="phone" style="width:100%; height:30px"/>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="2u">
                                        <label>Location</label>
                                        </div>
                                        <div class="9u">
                                        <input placeholder="Where do you live?" value="<?php if(isset($info->location)){echo $info->location;} ?>" type="text" name="location" id="location" style="width:100%; height:30px"/>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="2u">
                                        <label>Twitter</label>
                                        </div>
                                        <div class="9u">
                                        <input placeholder="Twitter Username" value="<?php if(isset($info->twitter)){echo $info->twitter;} ?>" type="text" name="twitter" id="twitter" style="width:100%; height:30px"/>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="2u">
                                        <label>Bio</label>
                                        </div>
                                        <div class="9u">
                                        <textarea placeholder="Brief description about yourself." name="description" id="description" style="width:100%; min-height:300px"><?php if(isset($info->description)){echo $info->description;} ?></textarea>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="2u">
                                        
                                        </div>
                                        <div class="9u">
                                       <input type="submit" class="button button-big next" name="submit" style="width:100%" value="Submit" />
                                        </div>
                                    </div>
                                   
								</form>
                                
								</article>
						
							
						
							
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
							<div id="logo">
								<h1>RooRunner</h1>
							</div>
					
						<!-- Nav -->
							<nav id="nav">
								<ul>
                                <li  class=""><a href="/manage/create/">Create Tasks</a></li>
                                	<li><a href="/manage/">Current Tasks</a></li>
                                   
									<li><a href="/manage/jobs/">All Tasks</a></li>
                                    
									
									<li class="current_page_item"><a href="#">Profile</a></li>
									<li><a href="/logout/">Sign Out</a></li>
								</ul>
							</nav>

						
					
						
					
						
					
						
							<div id="copyright">
								<p>
									&copy; 2013 An Untitled Site.<br />
									Images: <a href="http://n33.co">n33</a>, <a href="http://fotogrph.com">fotogrph</a>, <a href="http://iconify.it">Iconify.it</a>
									Design: <a href="http://html5up.net/">HTML5 UP</a>
								</p>
							</div>

					</div>

			</div>