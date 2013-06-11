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
										<h2><a href="#">All Jobs</a></h2>
										<span class="byline"><?php if(isset($tasks)) echo 'Below all jobs on the market'; ?></span>
									</header>
								</article>	
									
							<hr width="100%">
		<!-- echo out every task in an article format HERE							
						<article class="is-post is-post-excerpt">
									
										<span class="byline">Feugiat interdum sed commodo ipsum consequat dolor nullam metus</span>
									
									
									
									<p>
										Quisque vel sapien sit amet tellus elementum ultricies. Nunc vel orci turpis. Donec id malesuada metus. 
										Nunc nulla velit, fermentum quis interdum quis, tate etiam commodo lorem ipsum dolor sit amet dolore. 
										Quisque vel sapien sit amet tellus elementum ultricies. Nunc vel orci turpis. Donec id malesuada metus. 
										Nunc nulla velit, fermentum quis interdum quis, convallis eu sapien. Integer sed ipsum ante.
									</p>
								</article>-->
						
						
						<?php if(isset($tasks)) echo $tasks; ?>
                        		
							
							
						
							
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
                                 <li ><a href="/manage/create/">Create Tasks</a></li>
                                	<li><a href="/manage/">Current Tasks</a></li>
                                   
									<li><a href="/manage/jobs/">All Tasks</a></li>
                                    
									
									<li><a href="/manage/profile/">Profile</a></li>
									
									
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