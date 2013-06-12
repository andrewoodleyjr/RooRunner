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
										<h2>Send Message</h2>
										<span class="byline">Communication is bridged between a Runner and User with out giving any personal info.</span>
									</header>		
										<hr width="100%">
										<form action="/manage/sendmessage/<?php if(isset($id)) echo $id; ?>" method="post">
										<textarea maxlength="50" style="width:75%; height:75px"></textarea>
                                        <input type="submit" class="button button-big" value="Send Message" style="width:75%" />
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
                                	<li class="current_page_item"><a href="/manage/">Home</a></li>
                                	<li><a href="/manage/create/">Post a Run</a></li>
                                	<li><a href="/manage/current/">Current Runs</a></li>
									<li ><a href="/manage/jobs/">Available Runs</a></li>
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