<div class="container">
    <br />
    <!-- Main hero unit for a primary marketing message or call to action -->
    
   
        <div class="hero-unit tab-content" id="wizard">
            
         <div class="row-fluid tab-pane fade in active" id="intro" style="width:100%">
         	
            
            
            
            <div val style="width:100%; vertical-align:middle !important;">
            	<div class="span6" style="padding-top:40px" align="center">
                <h1 >Hey <?php if(isset($firstname)){echo $firstname;} ?>,</h1>
           		<p>
                   Welcome to Shwcase. We will walk you through creating your own personal music mobile app.
                </p>
                <!--<img src="http://artists.shwcase.co/images/video.png" width="300px"/>-->
                <iframe class="youtube-player" type="text/html" width="300" height="168" src="http://www.youtube.com/embed/VIDEO_ID" allowfullscreen frameborder="0">
</iframe>
                <br />
                <br />
                
               
                <a href="#step1" class="btn btn-large btn-danger" data-toggle="tab" style="width:80%;">  Start Creating Your App </a>
                </div>
                <div class="span6" align="left">
                
                        
             				

  <img src="http://artists.shwcase.co/images/iphone2.png"  />
                    <!--      <video src="http://www.shwcase.co/iphone3.mp4" poster="images/Default.png" preload="auto" autoplay="" loop="" muted="muted" class="video"></video>
                <video src="http://overgram.co/img/video.mp4" poster="http://overgram.co/img/poster.png" preload="auto" autoplay="autoplay" loop="loop" muted="muted" class="video"></video>-->
                       
                </div>
            </div> 
          </div>
         
         <div class="row-fluid tab-pane fade" id="step1" style="width:100%;">
         <div style="width:100%">
         	<div class="span6">
                <img src="http://artists.shwcase.co/images/step2.png" style="float:left; width:400px" />
                <br />
                <label style="position:absolute;"><a href="/process/skip_process/<?php if(isset($user_id)) echo $user_id; ?>" style="padding-left:35px">Skip</a></label>
            </div>
            <img src="http://artists.shwcase.co/images/video.png" width="100px" style="float:right;" />
            
         </div>
         <br/>
         <br/>
             <div style="width:100%; text-align:center">
                        <h1>App Info</h1>
                        <p>
                        	Fill out this information to be displayed on the app store. 
                        </p>
                            
                        
                            
                        <div align="center" style="width:100%; vertical-align:middle">
                        	<p>App Name: <input type="text" placeholder="Change Me" value="<?php if(isset($app_name)){echo $app_name;} ?>" /></p>
                            
                            <p>Nickname: <input type="text" placeholder="Change Me" value="<?php if(isset($app_nickname)){echo $app_nickname;} ?>"/></p>
                            
                            <p>Keywords: <input type="text" placeholder="Change Me" value="<?php if(isset($keywords)){echo $keywords;} ?>"/></p>
                            
                            <div id="home_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         	<div id="home_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                            
                            <div style="width:75%">
                            	<a href="#intro" class="btn btn-large btn-danger"  data-toggle="tab" style="float:left;">Prev</a>
                                <a href="#step2" class="btn btn-large btn-danger"  data-toggle="tab" style="float:right;">Next</a>
                            </div>
                             
                        </div>

                    </div>
          </div>
          
          <div class="row-fluid tab-pane fade" id="step2" style="width:100%;">
          <div style="width:100%">
          <div class="span6">
          		<img src="http://artists.shwcase.co/images/step3.png" style="float:left;  width:400px" />
                <br />
                <label style="position:absolute;"><a href="/process/skip_process/<?php if(isset($user_id)) echo $user_id; ?>" style="padding-left:35px">Skip</a></label>
            </div>
         	
            <img src="http://artists.shwcase.co/images/video.png" width="100px" style="float:right;" />
         </div>
         <br />
         <br />
             <div style="width:100%; text-align:center">
                        <h1>Upload Images</h1>
                        <p>
                        	Upload an icon and default image for your app. 
                        </p>
                            
                        
                            
                        <div align="center" style="width:100%; vertical-align:middle">
                        	<p>Icon Image &nbsp;&nbsp;: <input type="file" placeholder="Change Me"/></p>
                            <!--<label>Note: Its best to have a 1024 x 1024 px icon image.</label>-->
                            
                            
                            <p>Default Image: <input type="file" placeholder="Change Me"/></p>
                            <!--<label>Note: Its best to have a 960 x 640 px splash screen image.</label>-->
                            
                            
                            <div id="home_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         	<div id="home_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                            
                            <div style="width:75%">
                            	<a href="#step1" class="btn btn-large btn-danger"  data-toggle="tab" style="float:left;">Prev</a>
                                <a href="#step3" class="btn btn-large btn-danger"  data-toggle="tab" style="float:right;">Next</a>
                            </div>
                             
                        </div>

                    </div>
          </div>
          
          <div class="row-fluid tab-pane fade" id="step3" style="width:100%;">
          <div style="width:100%">
         	
            
            <div class="span6">
            	<img src="http://artists.shwcase.co/images/step4.png" style="float:left;  width:400px;" />
                <br />
                <label style="position:absolute;"><a href="/process/skip_process/<?php if(isset($user_id)) echo $user_id; ?>" style="padding-left:35px">Skip</a></label>
            </div>
            <img src="http://artists.shwcase.co/images/video.png" width="100px" style="float:right;" />
         </div>
         <br />
         <br />
             <div style="width:100%; text-align:center">
                        <h1>Color Theme</h1>
                        <p>
                        	Choose the color theme of your app. 
                        </p>
                            
                        
                            
                        <div align="center" style="width:100%; vertical-align:middle">
                        	<!-- Stuff Goes Here -->
                            
                              <div style="width: 100%;  ">
                       <div class="span10" align="center" style="float: left;  margin-top: 50px; " >
 
                             
             <label style="display:  block; clear: both; width:100%; text-align:right;">  
                 <span style="position: relative; top: 4px;font-size: 18px;font-weight: bold; margin-left: 30px;margin-right: 20px;">   TabBar:  </span> 
                 <div style="display: inline; position: relative; " class="input-append color" data-color="<?php if(isset($rgba_tabbar)) echo $rgba_tabbar; ?>" data-color-format="rgba" id="tabbar_div">
				 <input id="tabbar" type="text" value="<?php if(isset($hex_tabbar)) echo $hex_tabbar; ?>" class="span2" readonly="" style="width: 80px;">
				<span class="add-on"><i style="background-color: <?php if(isset($rgba_tabbar)) echo $rgba_tabbar; ?>"></i></span>
                                <input type="text" style="visibility:hidden;" class="box" id="tabbar_stored" value="<?php if(isset($json_tabbar)) echo $json_tabbar; ?>">
                        </div> 
             </label>
                           <label style="display:  block; clear: both; margin-top: 20px; width:100%; text-align:right;">  
                               <span style="position: relative; top: 4px;font-size: 18px;font-weight: bold; margin-left: 0px;margin-right: 0px;">   Tab Bar Select Button:  </span>  
                               <div style="display: inline; position: relative; " class="input-append color" data-color="<?php if(isset($rgba_tabbar_select_button)) echo $rgba_tabbar_select_button; ?>" data-color-format="rgba" id="tabbar_select_div">
				 <input id="tabbar_select_button" type="text" value="<?php if(isset($hex_tabbar_select_button)) echo $hex_tabbar_select_button; ?>" class="span2" readonly="" style="width: 80px;">
				<span class="add-on"><i style="background-color: <?php if(isset($rgba_tabbar_select_button)) echo $rgba_tabbar_select_button; ?>;"></i></span>
                                <input type="text" style="visibility:hidden;" class="box" id="tabbar_select_button_stored" value="<?php if(isset($json_tabbar_select_button)) echo $json_tabbar_select_button; ?>">
                        </div> </label>
                           <label style="display:  block; clear: both; width:100%; text-align:right; margin-top: 20px;">   
                               <span style="position: relative; top: 4px;font-size: 18px;font-weight: bold; margin-left: 20px;margin-right: 20px;">   Tab Bar Text:  </span> 
                               <div style="display: inline; position: relative; " class="input-append color" data-color="<?php if(isset($rgba_tabbar_select_text)) echo $rgba_tabbar_select_text; ?>" data-color-format="rgba" id="tabbar_select_text_div">
				 <input id="tabbar_select_text" type="text" value="<?php if(isset($hex_tabbar_select_text)) echo $hex_tabbar_select_text; ?>" class="span2" readonly="" style="width: 80px;">
				<span class="add-on"><i style="background-color: <?php if(isset($rgba_tabbar_select_text)) echo $rgba_tabbar_select_text; ?>;"></i></span>
                                <input type="text" style="visibility:hidden;" id="tabbar_select_text_stored" value="<?php if(isset($json_tabbar_select_text)) echo $json_tabbar_select_text; ?>">
                        </div> </label>
                          
                           <label style="display:  block; clear: both; width:100%; text-align:right; margin-top: 20px;">   
                               <span style="position: relative; top: 4px;font-size: 18px;font-weight: bold; margin-left: 20px;margin-right: 20px;">    Background:  </span> 
                               <div style="display: inline; position: relative; " class="input-append color" data-color="<?php if(isset($rgba_background)) echo $rgba_background; ?>" data-color-format="rgba" id="background_div">
				 <input id="background" type="text" value="<?php if(isset($hex_background)) echo $hex_background; ?>" class="span2" readonly="" style="width: 80px;">
				<span class="add-on"><i style="background-color: <?php if(isset($rgba_background)) echo $rgba_background; ?>;"></i></span>
                                <input type="text" style="visibility:hidden;" id="background_stored" value="<?php if(isset($json_background)) echo $json_background; ?>">
                        </div> </label>
                           <label style="display:  block; clear: both; width:100%; text-align:right; margin-top: 20px;">   
                               <span style="position: relative; top: 4px;font-size: 18px;font-weight: bold; margin-left: 20px;margin-right: 20px;">   List Background:  </span>  
                               <div style="display: inline; position: relative; " class="input-append color" data-color="<?php if(isset($rgba_list_background)) echo $rgba_list_background; ?>" data-color-format="rgba" id="list_background_div">
				 <input id="list_background" type="text" value="<?php if(isset($hex_list_background)) echo $hex_list_background; ?>" class="span2" readonly="" style="width: 80px;">
				<span class="add-on"><i style="background-color: <?php if(isset($rgba_list_background)) echo $rgba_list_background; ?>;"></i></span>
                                <input type="text" style="visibility:hidden;" id="list_background_stored" value="<?php if(isset($json_list_background)) echo $json_list_background; ?>">
                        </div> </label>
                           <label style="display:  block; clear: both; width:100%; text-align:right; margin-top: 20px;">   
                               <span style="position: relative; top: 4px;font-size: 18px;font-weight: bold; margin-left: 20px; margin-right: 20px;">   Text:  </span>  
                               <div style="display: inline; position: relative; " class="input-append color" data-color="<?php if(isset($rgba_text_color)) echo $rgba_text_color; ?>" data-color-format="rgba" id="text_color_div">
				 <input id="text_color" type="text" value="<?php if(isset($hex_text_color)) echo $hex_text_color; ?>" class="span2" readonly="" style="width: 80px;">
				<span class="add-on"><i style="background-color: <?php if(isset($rgba_text_color)) echo $rgba_text_color; ?>;"></i></span>
                                <input type="text" style="visibility:hidden;" id="text_color_stored" value="<?php if(isset($json_text_color)) echo $json_text_color; ?>">
                        </div> </label>
                        
                        <label style="display:  block; clear: both; width:100%; text-align:right; margin-top: 20px;">   
                        <span style="position: relative; top: -4px;font-size: 18px;font-weight: bold; margin-left: 30px; margin-right: 20px;">   Font:  </span>  
                         <select id="fonts">

<?php if($selected_font) echo $selected_font; ?>

<option value="AcademyEngravedLetPlain">AcademyEngravedLetPlain</option>





<option value="AmericanTypewriter">AmericanTypewriter</option>

<option value="AmericanTypewriter-Bold">AmericanTypewriter-Bold</option>

<option value="AmericanTypewriter-Condensed">AmericanTypewriter-Condensed</option>

<option value="AmericanTypewriter-CondensedBold">AmericanTypewriter-CondensedBold</option>

<option value="AmericanTypewriter-CondensedLight">AmericanTypewriter-CondensedLight</option>

<option value="AmericanTypewriter-Light">AmericanTypewriter-Light</option>







<option value="AppleColorEmoji">AppleColorEmoji</option>







<option value="AppleSDGothicNeo-Bold">AppleSDGothicNeo-Bold</option>

<option  value="AppleSDGothicNeo-Medium">AppleSDGothicNeo-Medium</option>







<option value="ArialMT">ArialMT</option>

<option value="Arial-BoldItalicMT">Arial-BoldItalicMT</option>

<option value="Arial-BoldMT">Arial-BoldMT</option>

<option value="Arial-ItalicMT">Arial-ItalicMT</option>







<option value="ArialHebrew">ArialHebrew</option>

<option value="ArialHebrew-Bold">ArialHebrew-Bold</option>

<option value="Arial Rounded MT Bold">Arial Rounded MT Bold</option>

<option value="ArialRoundedMTBold">ArialRoundedMTBold</option>









<option value="Avenir-Black">Avenir-Black</option>

<option value="Avenir-BlackOblique">Avenir-BlackOblique</option>

<option value="Avenir-Book">Avenir-Book</option>

<option value="Avenir-BookOblique">Avenir-BookOblique</option>

<option value="Avenir-Heavy">Avenir-Heavy</option>

<option value="Avenir-HeavyOblique">Avenir-HeavyOblique</option>

<option value="Avenir-Light">Avenir-Light</option>

<option value="Avenir-LightOblique">Avenir-LightOblique</option>

<option value="Avenir-Medium">Avenir-Medium</option>

<option value="Avenir-MediumOblique">Avenir-MediumOblique</option>

<option value="Avenir-Oblique">Avenir-Oblique</option>

<option value="Avenir-Roman">Avenir-Roman</option>







<option value="AvenirNext-Bold">AvenirNext-Bold</option>

<option value="AvenirNext-BoldItalic">AvenirNext-BoldItalic</option>

<option value="AvenirNext-DemiBold">AvenirNext-DemiBold</option>

<option value="AvenirNext-DemiBoldItalic">AvenirNext-DemiBoldItalic</option>

<option value="AvenirNext-Heavy">AvenirNext-Heavy</option>

<option value="AvenirNext-HeavyItalic">AvenirNext-HeavyItalic</option>

<option value="AvenirNext-Italic">AvenirNext-Italic</option>

<option value="AvenirNext-Medium">AvenirNext-Medium</option>

<option value="AvenirNext-MediumItalic">AvenirNext-MediumItalic</option>

<option value="AvenirNext-Regular">AvenirNext-Regular</option>

<option value="AvenirNext-UltraLight">AvenirNext-UltraLight</option>

<option value="AvenirNext-UltraLightItalic">AvenirNext-UltraLightItalic</option>







<option  value="AvenirNextCondensed-Bold">AvenirNextCondensed-Bold</option>

<option value="AvenirNextCondensed-BoldItalic">AvenirNextCondensed-BoldItalic</option>

<option value="AvenirNextCondensed-DemiBold">AvenirNextCondensed-DemiBold</option>

<option value="AvenirNextCondensed-DemiBoldItalic">AvenirNextCondensed-DemiBoldItalic</option>

<option value="AvenirNextCondensed-Heavy">AvenirNextCondensed-Heavy</option>

<option value="AvenirNextCondensed-HeavyItalic">AvenirNextCondensed-HeavyItalic</option>

<option value="AvenirNextCondensed-Italic">AvenirNextCondensed-Italic</option>

<option value="AvenirNextCondensed-Medium">AvenirNextCondensed-Medium</option>

<option value="AvenirNextCondensed-MediumItalic">AvenirNextCondensed-MediumItalic</option>

<option value="AvenirNextCondensed-Regular">AvenirNextCondensed-Regular</option>

<option value="AvenirNextCondensed-UltraLight">AvenirNextCondensed-UltraLight</option>

<option value="AvenirNextCondensed-UltraLightItalic">AvenirNextCondensed-UltraLightItalic</option>







<option value="BanglaSangamMN">BanglaSangamMN</option>

<option value="BanglaSangamMN-Bold">BanglaSangamMN-Bold</option>







<option value="Baskerville">Baskerville</option>

<option value="Baskerville-Bold">Baskerville-Bold</option>

<option value="Baskerville-BoldItalic">Baskerville-BoldItalic</option>

<option value="Baskerville-Italic">Baskerville-Italic</option>

<option value="Baskerville-SemiBold">Baskerville-SemiBold</option>

<option value="Baskerville-SemiBoldItalic">Baskerville-SemiBoldItalic</option>







<option value="BodoniOrnamentsITCTT">BodoniOrnamentsITCTT</option>







<option value="BodoniSvtyTwoITCTT-Bold">BodoniSvtyTwoITCTT-Bold</option>

<option value="BodoniSvtyTwoITCTT-Book">BodoniSvtyTwoITCTT-Book</option>

<option value="BodoniSvtyTwoITCTT-BookIta">BodoniSvtyTwoITCTT-BookIta</option>







<option value="BodoniSvtyTwoOSITCTT-Bold">BodoniSvtyTwoOSITCTT-Bold</option>

<option value="BodoniSvtyTwoOSITCTT-Book">BodoniSvtyTwoOSITCTT-Book</option>

<option  value="BodoniSvtyTwoOSITCTT-BookIt">BodoniSvtyTwoOSITCTT-BookIt</option>

<option value="BodoniSvtyTwoSCITCTT-Book">BodoniSvtyTwoSCITCTT-Book</option>







<option value="BradleyHandITCTT-Bold">BradleyHandITCTT-Bold</option>







<option value="ChalkboardSE-Bold">ChalkboardSE-Bold</option>

<option value="ChalkboardSE-Light">ChalkboardSE-Light</option>

<option value="ChalkboardSE-Regular">ChalkboardSE-Regular</option>







<option value="Chalkduster">Chalkduster</option>







<option value="Cochin">Cochin</option>

<option value="Cochin-Bold">Cochin-Bold</option>

<option value="Cochin-BoldItalic">Cochin-BoldItalic</option>

<option value="Cochin-Italic">Cochin-Italic</option>







<option value="Copperplate">Copperplate</option>

<option value="Copperplate-Bold">Copperplate-Bold</option>

<option value="Copperplate-Light">Copperplate-Light</option>







<option value="Courier">Courier</option>

<option value="Courier-Bold">Courier-Bold</option>

<option value="Courier-BoldOblique">Courier-BoldOblique</option>

<option value="Courier-Oblique">Courier-Oblique</option>







<option value="CourierNewPS-BoldItalicMT">CourierNewPS-BoldItalicMT</option>

<option value="CourierNewPS-BoldMT">CourierNewPS-BoldMT</option>

<option value="CourierNewPS-ItalicMT">CourierNewPS-ItalicMT</option>

<option value="CourierNewPSMT">CourierNewPSMT</option>














<option value="DevanagariSangamMN">DevanagariSangamMN</option>

<option value="DevanagariSangamMN-Bold">DevanagariSangamMN-Bold</option>







<option value="Didot">Didot</option>

<option value="Didot-Bold">Didot-Bold</option>

<option value="Didot-Italic">Didot-Italic</option>







<option value="EuphemiaUCAS">EuphemiaUCAS</option>

<option value="EuphemiaUCAS-Bold">EuphemiaUCAS-Bold</option>

<option value="EuphemiaUCAS-Italic">EuphemiaUCAS-Italic</option>







<option value="Futura-CondensedExtraBold">Futura-CondensedExtraBold</option>

<option value="Futura-CondensedMedium">Futura-CondensedMedium</option>

<option value="Futura-Medium">Futura-Medium</option>

<option value="Futura-MediumItalic">Futura-MediumItalic</option>









<option value="GeezaPro">GeezaPro</option>

<option value="GeezaPro-Bold">GeezaPro-Bold</option>







<option value="Georgia">Georgia</option>

<option value="Georgia-Bold">Georgia-Bold</option>

<option value="Georgia-BoldItalic">Georgia-BoldItalic</option>

<option value="Georgia-Italic">Georgia-Italic</option>







<option value="GillSans">GillSans</option>

<option value="GillSans-Bold">GillSans-Bold</option>

<option value="GillSans-BoldItalic">GillSans-BoldItalic</option>

<option value="GillSans-Italic">GillSans-Italic</option>

<option value="GillSans-Light">GillSans-Light</option>

<option value="GillSans-LightItalic">GillSans-LightItalic</option>







<option value="GujaratiSangamMN">GujaratiSangamMN</option>

<option value="GujaratiSangamMN-Bold">GujaratiSangamMN-Bold</option>







<option value="GurmukhiMN">GurmukhiMN</option>

<option value="GurmukhiMN-Bold">GurmukhiMN-Bold</option>







<option value="STHeitiSC-Light">STHeitiSC-Light</option>







<option value="STHeitiSC-Medium">STHeitiSC-Medium</option>







<option value="STHeitiTC-Light">STHeitiTC-Light</option>







<option value="STHeitiTC-Medium">STHeitiTC-Medium</option>









<option value="Helvetica">Helvetica</option>

<option value="Helvetica-Bold">Helvetica-Bold</option>

<option value="Helvetica-BoldOblique">Helvetica-BoldOblique</option>

<option value="Helvetica-Light">Helvetica-Light</option>

<option value="Helvetica-LightOblique">Helvetica-LightOblique</option>

<option value="Helvetica-Oblique">Helvetica-Oblique</option>







<option value="HelveticaNeue">HelveticaNeue</option>

<option value="HelveticaNeue-Bold">HelveticaNeue-Bold</option>

<option value="HelveticaNeue-BoldItalic">HelveticaNeue-BoldItalic</option>

<option value="HelveticaNeue-CondensedBlack">HelveticaNeue-CondensedBlack</option>

<option value="HelveticaNeue-CondensedBold">HelveticaNeue-CondensedBold</option>

<option value="HelveticaNeue-Italic">HelveticaNeue-Italic</option>

<option value="HelveticaNeue-Light">HelveticaNeue-Light</option>

<option value="HelveticaNeue-LightItalic">HelveticaNeue-LightItalic</option>

<option value="HelveticaNeue-Medium">HelveticaNeue-Medium</option>

<option value="HelveticaNeue-UltraLight">HelveticaNeue-UltraLight</option>

<option value="HelveticaNeue-UltraLightItalic">HelveticaNeue-UltraLightItalic</option>







<option value="HiraKakuProN-W3">HiraKakuProN-W3</option>







<option value="HiraKakuProN-W6">HiraKakuProN-W6</option>







<option value="HiraMinProN-W3">HiraMinProN-W3</option>

<option value="HiraMinProN-W6">HiraMinProN-W6</option>







<option value="HoeflerText-Black">HoeflerText-Black</option>

<option value="HoeflerText-BlackItalic">HoeflerText-BlackItalic</option>

<option value="HoeflerText-Italic">HoeflerText-Italic</option>

<option value="HoeflerText-Regular">HoeflerText-Regular</option>







<option value="Kailasa">Kailasa</option>

<option value="Kailasa-Bold">Kailasa-Bold</option>







<option value="KannadaSangamMN">KannadaSangamMN</option>

<option value="KannadaSangamMN-Bold">KannadaSangamMN-Bold</option>







<option value="MalayalamSangamMN">MalayalamSangamMN</option>

<option value="MalayalamSangamMN-Bold">MalayalamSangamMN-Bold</option>







<option value="Marion-Bold">Marion-Bold</option>

<option value="Marion-Italic">Marion-Italic</option>

<option value="Marion-Regular">Marion-Regular</option>







<option value="MarkerFelt-Thin">MarkerFelt-Thin</option>

<option value="MarkerFelt-Wide">MarkerFelt-Wide</option>







<option value="Noteworthy-Bold">Noteworthy-Bold</option>

<option value="Noteworthy-Light">Noteworthy-Light</option>







<option value="Optima-Bold">Optima-Bold</option>

<option value="Optima-BoldItalic">Optima-BoldItalic</option>

<option value="Optima-ExtraBlack">Optima-ExtraBlack</option>

<option value="Optima-Italic">Optima-Italic</option>

<option value="Optima-Regular">Optima-Regular</option>







<option value="OriyaSangamMN">OriyaSangamMN</option>

<option value="OriyaSangamMN-Bold">OriyaSangamMN-Bold</option>







<option value="Palatino-Bold">Palatino-Bold</option>

<option value="Palatino-BoldItalic">Palatino-BoldItalic</option>

<option value="Palatino-Italic">Palatino-Italic</option>

<option value="Palatino-Roman">Palatino-Roman</option>







<option value="Papyrus">Papyrus</option>

<option value="Papyrus-Condensed">Papyrus-Condensed</option>







<option value="PartyLetPlain">PartyLetPlain</option>







<option value="SinhalaSangamMN">SinhalaSangamMN</option>

<option value="SinhalaSangamMN-Bold">SinhalaSangamMN-Bold</option>







<option value="SnellRoundhand">SnellRoundhand</option>

<option value="SnellRoundhand-Black">SnellRoundhand-Black</option>

<option value="SnellRoundhand-Bold">SnellRoundhand-Bold</option>





<option value="Symbol">Symbol</option>







<option value="TamilSangamMN">TamilSangamMN</option>

<option value="TamilSangamMN-Bold">TamilSangamMN-Bold</option>







<option value="TeluguSangamMN">TeluguSangamMN</option>

<option value="TeluguSangamMN-Bold">TeluguSangamMN-Bold</option>







<option value="Thonburi">Thonburi</option>

<option value="Thonburi-Bold">Thonburi-Bold</option>







<option value="TimesNewRomanPS-BoldItalicMT">TimesNewRomanPS-BoldItalicMT</option>

<option value="TimesNewRomanPS-BoldMT">TimesNewRomanPS-BoldMT</option>

<option value="TimesNewRomanPS-ItalicMT">TimesNewRomanPS-ItalicMT</option>

<option value="TimesNewRomanPSMT">TimesNewRomanPSMT</option>







<option value="Trebuchet-BoldItalic">Trebuchet-BoldItalic</option>

<option value="TrebuchetMS">TrebuchetMS</option>

<option value="TrebuchetMS-Bold">TrebuchetMS-Bold</option>

<option value="TrebuchetMS-Italic">TrebuchetMS-Italic</option>







<option value="Verdana">Verdana</option>

<option value="Verdana-Bold">Verdana-Bold</option>

<option value="Verdana-BoldItalic">Verdana-BoldItalic</option>

<option value="Verdana-Italic">Verdana-Italic</option>







<option value="ZapfDingbatsITC">ZapfDingbatsITC</option>







<option value="Zapfino">Zapfino</option>

</select>        
                        <span style="font-family: arial; font-size: 18px; margin-left: 10px;" id="font_example">Hello World</span>
                       </label>
                           
                          
</div>
                         </div>
                            
                            
                            <div id="home_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         	<div id="home_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                            
                            <div style="width:75%">
                            	<a href="#step2" class="btn btn-large btn-danger"  data-toggle="tab" style="float:left;">Prev</a>
                                <a href="#step4" class="btn btn-large btn-danger"  data-toggle="tab" style="float:right;">Next</a>
                            </div>
                             
                        </div>

                    </div>
          </div>
          
          <div class="row-fluid tab-pane fade" id="step4" style="width:100%;">
          <div style="width:100%">
         	<div class="span6">
                <img src="http://artists.shwcase.co/images/step5.png" style="float:left; width:400px" />
                <br />
                <label style="position:absolute;"><a href="/process/skip_process/<?php if(isset($user_id)) echo $user_id; ?>" style="padding-left:35px">Skip</a></label>
            </div>
            <img src="http://artists.shwcase.co/images/video.png" width="100px" style="float:right;" />
         </div>
         <br />
         <br />
             <div style="width:100%; text-align:center">
                        <h1>Social Media</h1>
                        <p>
                        	Connect your social media accounts to the app. 
                        </p>
                            
                        
                            
                        <div align="center" style="width:100%; vertical-align:middle">
                        	<!-- Stuff Goes Here -->
                            
                            <p>Facebook Link:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" placeholder="Change Me" value="<?php if(isset($facebook)){echo $facebook;} ?>" /></p>
                            
                            <p>Instagram Username: <input type="text" placeholder="Change Me" value="<?php if(isset($instagram)){echo $instagram;} ?>"/></p>
                            
                            <p>Twitter Username:&nbsp;&nbsp;&nbsp; <input type="text" placeholder="Change Me" value="<?php if(isset($twitter)){echo $twitter;} ?>"/></p>
                            
                            <p>Youtube Username: <input type="text" placeholder="Change Me" value="<?php if(isset($youtube)){echo $youtube;} ?>"/></p>
                            
                            <div id="home_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         	<div id="home_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                            
                            <div style="width:75%">
                            	<a href="#step3" class="btn btn-large btn-danger"  data-toggle="tab" style="float:left;">Prev</a>
                                <a href="#step5" class="btn btn-large btn-danger"  data-toggle="tab" style="float:right;">Next</a>
                            </div>
                             
                        </div>

                    </div>
          </div>
          
          
             <div class="row-fluid tab-pane fade" id="step5" style="width:100%;">
          <div style="width:100%">
         	<div class="span6">
                <img src="http://artists.shwcase.co/images/step6.png" style="float:left; width:400px" />
                <br />
                <label style="position:absolute;"><a href="/process/skip_process/<?php if(isset($user_id)) echo $user_id; ?>" style="padding-left:35px">Skip</a></label>
            </div>
            <img src="http://artists.shwcase.co/images/video.png" width="100px" style="float:right;">
         </div>
         <br>
         <br>
             <div style="width:100%; text-align:center">
                        <h1>Your Information</h1>
                        <p>
                        	Add your basic information for fans to follow. 
                        </p>
                            
                        
                            
                        <div align="center" style="width:100%; vertical-align:middle">
                        	<!-- Stuff Goes Here -->
                             <p>Email:&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" placeholder="Change Me" value="andre_woodley@yahoo.com"></p>
                            
                            <p>Phone:&nbsp;&nbsp;&nbsp; <input type="text" placeholder="Change Me" value="6158787332"></p>
                            
                            <p>Website:&nbsp; <input type="text" placeholder="Change Me" value="http://www.justgoi.com"></p>
                            
                            <p>Bio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" placeholder="Change Me" value="Information about artist"></p>
                            
                            
                            <div id="home_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         	<div id="home_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                            
                            <div style="width:75%">
                            	<a href="#step4" class="btn btn-large btn-danger" data-toggle="tab" style="float:left;">Prev</a>
                                <a href="#step6" class="btn btn-large btn-danger" data-toggle="tab" style="float:right;">Next</a>
                            </div>
                             
                        </div>

                    </div>
          </div>
          
          
           <div class="row-fluid tab-pane fade" id="step6" style="width:100%;">
           <div style="width:100%">
         	<div class="span6">
                <img src="http://artists.shwcase.co/images/step7.png" style="float:left; width:400px" />
                <br />
                <label style="position:absolute;"><a href="/process/skip_process/<?php if(isset($user_id)) echo $user_id; ?>" style="padding-left:35px">Skip</a></label>
            </div>
            <img src="http://artists.shwcase.co/images/video.png" width="100px" style="float:right;" />
         </div>
         <br />
         <br />
             <div style="width:100%; text-align:center">
                        <h1>Preview</h1>
                        <p>
                        	Preview your app before it launches to the app store. 
                        </p>
                            
                        
                            
                        <div align="center"  style="width:100%; vertical-align:middle">
                        	<!-- Stuff Goes Here -->
                            <div class="row-fluid">
                           <div class="span4"> 
                            <img src="http://artists.shwcase.co/images/screen1.jpg" style="
    width: 200px;
" />
</div>

					<div class="span4">
			<img src="http://artists.shwcase.co/images/screen2.jpg" style="
    width: 200px;
" />
</div>

<div class="span4">
<img src="http://artists.shwcase.co/images/screen1.jpg" style="
    width: 200px;
" />
</div>

<br />
<br />

</div>
                            
                            <div id="home_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         	<div id="home_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                            
                            <div style="width:75%">
                            	<a href="#step5" class="btn btn-large btn-danger"  data-toggle="tab" style="float:left;">Prev</a>
                                <a href="#" class="btn btn-large btn-success"   style="float:right;">Submit</a>
                            </div>
                             
                        </div>

                    </div>
          </div>
         
      <div>
      
      	
      
      
      
      <div class="tabbable " style="display:none;"> 
  <ul class="nav nav-tabs">
    <li class='<?php if(isset($tab1)){echo $tab1; }?>' ><a href="#tab1" data-toggle="tab">Account</a></li>
    <li class='<?php if(isset($tab2)){echo $tab2; }?>' ><a href="#tab2" data-toggle="tab">Password</a></li>

  
  </ul>
  <div class="tab-content span9">
    <div class="tab-pane  span4 <?php if(isset($div1)){echo $div1;} ?>" id="tab1">
        <form class="pull-left" method="post" action="" enctype="multipart/form-data" >
        <label>First Name</label>
        <input type="text" name="firstname" value="<?php if(isset($firstname)){echo $firstname;} ?>" />
        <label>Last Name</label>
        <input type="text" name="lastname" value="<?php if(isset($lastname)){echo $lastname;} ?>" />
        <label>Email</label>
        <input type="text" name="email" value="<?php if(isset($email)){echo $email;} ?>" />
        <label>Mobile</label>
        <input type="text" name="mobile" value="<?php if(isset($phone)){echo $phone;} ?>" /><br />
        <button type="submit" name="submitprofile" class="btn btn-success">Save</button>
        </form>
        <br />
        <?php if(isset($userprofileerror)){echo $userprofileerror;}?>
    </div>
    <div class="tab-pane span4 <?php if(isset($div2)){echo $div2;} ?>" id="tab2">
        
        <form class="pull-left" method="post" action="" enctype="multipart/form-data" >
        <label>Old Password</label>
        <input type="password" name="oldpassword" value="" />
        <label>New Password</label>
        <input type="password" name="newpassword" value="" />
        <label>Retype New Password</label>
        <input type="password" name="confirmpassword" value="" /><br />
        <button type="submit" name="submitpass" class="btn btn-success">Save</button>
        </form>
        <br />
        <?php if(isset($userpassworderror)){echo $userpassworderror;}?>

    </div>
      
              <div class="span4 pull-right">
           <h3 style="color:#060">Account</h3>
           <p>
               From here you can change your basic account info.</p>
               <h4 style="color:#060">Tips:</h4>
              
            <p>
            Add your website for when others wish to get in contact with you regarding your application, product or service.
           </p>
            
           
           </div>  
  </div>
</div>
         
        

    </div>
</div>