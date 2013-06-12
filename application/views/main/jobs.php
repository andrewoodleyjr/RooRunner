 <body class="left-sidebar">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div id="content-inner">
					
							<!-- Post -->
								<article class="is-post is-post-excerpt" align="center">
									<header>
										<!--
											Note: Titles and bylines will wrap automatically when necessary, so don't worry
											if they get too long. You can also remove the "byline" span entirely if you don't
											need a byline.
										-->
										<h2>Hey <?php if(isset($name)) echo $name; ?></h2>
										<span class="byline">Welcome to RooRunner, a place for you to post what you want others to do for you.</span>
									</header>
									
									
							<hr width="100%">
		
                        Choose between one of the following options.
                        <br />
						<?php if(isset($usertype)): 
								if($usertype == 1):
									 echo '<a href="/manage/create/"><input type="submit" class="button button-big next" name="submit" style="width:100%; margin-bottom:15px;" value="Available Runs"></a>'; 
									endif;
								endif;
						?>
                        
						<a href="/manage/create/"><input type="submit" class="button button-big next" name="submit" style="width:100%; margin-bottom:15px;" value="Post a Run"></a>
                        
                        <a href="/manage/current/"><input type="submit" class="button button-big next" name="submit" style="width:100%; margin-bottom:15px;" value="Current Runs"></a>
                        
                        <a href="/manage/message_runners/"><input type="submit" class="button button-big next" name="submit" style="width:100%; margin-bottom:15px;" value="Message Your Runners"></a>
                        
                      
	
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
                                <li class="current_page_item"><a href="/manage/">Home</a></li>
                                <li ><a href="/manage/create/">Create Runs</a></li>
                                	<li><a href="/manage/current/">Current Runs</a></li>
                                    <li ><a href="/manage/jobs/">Available Runs</a></li>
									<li><a href="/manage/profile/">Profile</a></li>
                                    <li><a href="/logout/">Sign Out</a></li>
								</ul>
							</nav>

						
					
						
					
						
					
						
							<div id="copyright">
								<p>
									
									Feedback: <br /><a href="mailto:developer@roorunner.com">developer@roorunner.com</a>
                                    <br />
                                    Made with Love in Music City<br />
                                    &copy; 2013 GOI LLC.
								</p>
							</div>

					</div>

			</div>