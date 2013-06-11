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
										<h2><a href="#">Create a Task</a></h2>
                                        <span class="byline">
                                        Fill out the required information and post the job.
                                        </span>
                                        <span class="byline">
                                        
								<?php 
								
								 if(isset($error['error'])){echo $error['error'];}?>
                                
                                </span>	
									</header>
								</article>
                                
								<hr width="100%"/>	
									
		<!-- Put the required document here! -->							
								<article class="is-post is-post-excerpt">
                                <form action="/manage/createtask/" method="post" >
									<div class="row">
                                        <div class="2u">
                                        <label>Job Title</label>
                                        </div>
                                        <div class="9u">
                                        <input type="text" name="title" id="title" value="<?php if(isset($error['title2'])){echo $error['title2'];} ?>" style="width:100%; height:30px"/>
                                        </div>
                                    </div>
                                  
                                  <div class="row">
                                        <div class="2u">
                                        <label>Meeting Place</label>
                                        </div>
                                        <div class="9u">
                                        <input  value="<?php if(isset($error['location'])){echo $error['location'];} ?>" type="text" name="location" id="location" style="width:100%; height:30px"/>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="2u">
                                        <label>Reward</label>
                                        </div>
                                        <div class="9u">
                                        <input  value="<?php if(isset($error['reward'])){echo $error['reward'];} ?>" type="text" name="reward" id="reward" style="width:100%; height:30px"/>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="2u">
                                        <label>Description</label>
                                        </div>
                                        <div class="9u">
                                        <textarea name="description" id="description" style="width:100%; min-height:300px"><?php if(isset($error['description'])){echo $error['description'];} ?></textarea>
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
                                <li  class="current_page_item"><a href="#">Create Tasks</a></li>
                                	<li><a href="/manage/">Current Tasks</a></li>
                                   
									<li><a href="/manage/jobs/">All Tasks</a></li>
                                    
									
									<li><a href="/manage/profile/">Profile</a></li>
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