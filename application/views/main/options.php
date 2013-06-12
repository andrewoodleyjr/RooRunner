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
		
						
						<a href="/manage/create/"><input type="submit" class="button button-big next" name="submit" style="width:100%; margin-bottom:15px;" value="Post a Run"></a>
                        <br/>
                        <a href="/manage/current/"><input type="submit" class="button button-big next" name="submit" style="width:100%; margin-bottom:15px;" value="Current Runs"></a>
                        <br/>
                        <a href="/manage/message_runners/"><input type="submit" class="button button-big next" name="submit" style="width:100%; margin-bottom:15px;" value="Message Your Runners"></a>
                        
                        <br/>
                        Choose between one of the following options.
						<?php //if(isset($tasks)) echo $tasks; ?>
	
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
                                <li ><a href="/manage/create/">Create Tasks</a></li>
                                	<li><a href="/manage/current/">Current Tasks</a></li>
                                    
									<!--<li ><a href="/manage/jobs/">All Tasks</a></li>-->
                                    
									
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