<div class="container" style="margin-top: 50px; width: 90%;">
	<div class="row-fluid">
        <div class="span4">
            <ul class="nav nav-tabs nav-stacked affix-top" style="background-color:rgb(245, 245, 245)">
                        
                          <li class="disabled" style="color:#006600; font-size:18px; text-decoration:none;"><a  style="text-decoration:none; color:#DC615A">Menu</a></li>
                           <li class="<?php if(isset($tab_home)) echo $tab_home; ?>"  ><a  href="#home" data-toggle="tab"><i class="icon-home"></i><i class="icon-chevron-right pull-right"></i>  Home</a></li> 
                           <li class="<?php if(isset($tab_music)) echo $tab_music; ?>" ><a  href="#music" data-toggle="tab"><i class="icon-music"></i><i class="icon-chevron-right pull-right"></i>  Music</a></li>
                           
                            <li class="<?php if(isset($tab_picture)) echo $tab_picture; ?>"  ><a  href="#pictures" data-toggle="tab"><i class="icon-picture"></i><i class="icon-chevron-right pull-right"></i> Photos</a></li>
<li class="<?php if(isset($tab_feeds)) echo $tab_feeds; ?>"  ><a  href="#feeds" data-toggle="tab"><i class="icon-user"></i><i class="icon-chevron-right pull-right"></i>  Feeds</a></li>
<li class="disabled" style="color:#006600; font-size:18px; text-decoration:none;"><a style="text-decoration:none; color:#DC615A">More</a></li>
<li class="<?php if(isset($tab_event)) echo $tab_event; ?>"  ><a  href="#calendar" data-toggle="tab"><i class="icon-calendar"></i><i class="icon-chevron-right pull-right"></i>  Events</a></li>
<li class="<?php if(isset($tab_fanwall)) echo $tab_fanwall; ?>"  ><a  href="#fanwall" data-toggle="tab"><i class="icon-comment"></i><i class="icon-chevron-right pull-right"></i>  Fan Wall</a></li>
                            <li class="<?php if(isset($tab_livevideo)) echo $tab_livevideo; ?>"  ><a  href="#livevideo" data-toggle="tab"><i class="icon-facetime-video"></i><i class="icon-chevron-right pull-right"></i>  Live Video</a></li>
<li class="<?php if(isset($tab_video)) echo $tab_video; ?>"   ><a  href="#videos" data-toggle="tab"><i class="icon-play-circle"></i><i class="icon-chevron-right pull-right"></i> Videos</a></li>
                           <li class="<?php if(isset($tab_links)) echo $tab_links; ?>"  ><a  href="#links" data-toggle="tab"><i class=" icon-folder-close"></i><i class="icon-chevron-right pull-right"></i>  Links</a></li>
                           
                            <li class="<?php if(isset($tab_about)) echo $tab_about; ?>"  ><a  href="#about" data-toggle="tab"><i class="icon-user"></i><i class="icon-chevron-right pull-right"></i>  About</a></li>
                            
                            
                            <li class="<?php if(isset($tab_contact)) echo $tab_contact; ?>"  ><a  href="#contact" data-toggle="tab"><i class="icon-envelope"></i><i class="icon-chevron-right pull-right"></i>  Contact</a></li>
                           
                           
                            <li class="disabled" style="color:#006600; font-size:18px; text-decoration:none;"><a  style="text-decoration:none; color:#DC615A">Theme</a></li>
                            <li class="<?php if(isset($tab_themes)) echo $tab_themes; ?>"  ><a  href="#theme" data-toggle="tab"><i class="icon-eye-open"></i><i class="icon-chevron-right pull-right"></i> Edit Color</a></li>
            </ul>  
         </div>
         
         <div class="span8 tab-content" id="settings" style="background-color:rgb(245, 245, 245); padding:20px">
         	
             
              <div class="<?php if(isset($tab_home)) echo $tab_home; ?>  row-fluid tab-pane fade" id="home" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>Manage Home</h1>
                        <p>Enter song and login information.
<br />
This allows you to contact followers keeping them updated
</p>
                            
                        
                            
                        <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">
                            
                            <!--<button class="btn btn-primary btn-large">
                            Users Sign in Using FaceBook:  
                        <input type="checkbox" <?php  if(isset($forced_signin) && $forced_signin == "1") echo "checked='checked'"; ?> id="forced_signin" />  
                        </button>  -->
                        
                            </div>
                             
                            </div>
                    <!--<button id="home_submit" style="margin-top: 5px;"  class="btn btn-success"  >Save</button>-->
                    
                    	 <div id="home_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         <div id="home_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>

                    </div>
                  </div>
             
             
             
                  <div class="<?php if(isset($tab_music)) echo $tab_music; ?> row-fluid tab-pane fade in" id="music" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>Manage Music</h1>
                        <p>Here you can add, view and delete music on your app.</p>
                          <div class="tabbable"> <!-- Only required for left/right tabs -->
                              <ul class="nav nav-tabs">
                                <li class="active"><a href="#currentmusic" data-toggle="tab">Songs</a></li>
                                <li><a href="#addmusic" data-toggle="tab">Add Music</a>
                                </li>
                              </ul>
                              <div class="tab-content">
                                <div class="tab-pane active" id="currentmusic">
                                  <table class="table table-striped" id="song_table" width="100%">
                                  	<thead>
                                        <tr>
                                            <th width="10%">
                                            #
                                            </th>
                                            <th width="35%">
                                            Song and Artist
                                            </th>
                                            <th width="40" >Preview</th>
                                            <th width="15%">
                                            Options
                                            </th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                    	<?php if(isset($music_table)) echo $music_table; ?>
                                    </tbody>
                                 </table>
                                    <button class="btn btn-success" id="change_position_table">Change Position</button>
                                    <div id="music_position_warning" class="alert alert-danger" style="display: none;"></div>
                                    <div id="music_position_good" class="alert alert-success" style="display: none;"></div>

                                </div>
                                <div class="tab-pane" id="addmusic">
                                    <form action="/entertainment/add_record_songs/<?php if(isset($App_ID)) echo $App_ID; ?>" enctype="multipart/form-data" method="POST" >
                                <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Song's Name <input name="add_song_name" id="add_song_name" placeholder="Song's Name" type="text"  style="margin-left:10px; color:#666">
                                </div>
                             
                            </div>
                                    <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Artist's Name <input name="add_artist" id="add_artist" placeholder="Artist's Name" type="text"  style="margin-left:10px; color:#666">
                                </div>
                             
                            </div>
                            
                            
                                                               <input type="hidden"  id="App_ID"  value="<?php if(isset($App_ID)) echo $App_ID; ?>" />
  
               		<div style="width:100%; vertical-align:middle; font-size:18px; font-weight:bold;"> 
Song's File: 
<input id="add_music_file" name="add_music_file" type="file" style="display:visible;" style="color:#FFF"></div>
                        
                        
                        <!--<div class="input-append" style="display: inline; margin-left: 10px;">
                        <input id="add_music" class="" type="text" style="width: 135px;margin-left: 10px;" />                        
                         <a class="btn" onclick="$('input[id=add_music_file]').click();">Browse</a>
                        </div> --> 

<div style="margin-top: 20px;">
                        <button type="submit" class="btn btn-success btn-large">Save</button> 
                        </div>
                                    </form>
                                </div>
                              </div>
                           
                        
                        <div id="editmusic" class="modal hide fade" tabindex="-1" role="dialog"  aria-hidden="false" style="display: block;">
                              
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 >Edit Music</h3>
                              </div>
                      <form action="/entertainment/edit_song/<?php if(isset($App_ID)) echo $App_ID; ?>" enctype="multipart/form-data" method="POST" > 
                              <div class="modal-body">
                                

                        <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Song's Name <input id="edit_song_name" name="edit_song_name" placeholder="Song's Name" type="text"  style="margin-left:10px; color:#666">
                                </div>
                             
                            </div>
                                    <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Artist's Name <input id="edit_artist" name="edit_artist" placeholder="Artist's Name" type="text" style="margin-left:10px; color:#666">
                                </div>
                             <input type="hidden" name="song_id" id="edit_song_id"  value="" />
                            </div>
                            
                         
                                    
               		<input id="edit_music_file" name="edit_music_file" type="file" style="display:none;">
                        <span style="width:100%; vertical-align:middle; font-size:18px; font-weight:bold;">Song's File: </span> 
                        <div class="input-append" style="display: inline; margin-left: 10px;">
                        <input id="edit_music" class="" type="text" style="width: 135px;margin-left: 10px;">                        
                        <a class="btn" onclick="$('input[id=edit_music_file]').click();">Browse</a>
                        </div>  
                        
                        <div class="modal-footer" style="margin-top: 20px;">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button class="btn btn-success"  type="submit" >Save</button>
                        </div>
                          
                      </form>
                        
                          
                        <!------->
                        
                              </div>
                       
                     </div>  
                  </div>
                        </div>
                  </div>
           
             
                  <div class="<?php if(isset($tab_themes)) echo $tab_themes; ?> row-fluid tab-pane fade" id="theme" style="width:100%;">
                         <div style="width:100%; text-align:center; padding-bottom: 300px;">
                            <h1>Theme Manager</h1>
                            <p>Here you can change content colors of your application.</p>
                           
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
                           
                           <button class="btn btn-success" id="sumbit_theme" style="
    clear: both;
    margin-top: 30px;
    float: right;
    
">Submit Theme</button>
                         </div>
                                
                       
                         </div>
                         </div>

                  </div>
                                         
                  <div class="<?php if(isset($tab_feeds)) echo $tab_feeds; ?>  row-fluid tab-pane fade" id="feeds" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>Manage Feeds</h1>
                        <p>Enter your twitter and facebook information.</p>
                            
                        
                            <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">FaceBook Link&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input  id="facebook_input" placeholder="facebook" type="text" value="<?php if(isset($facebook)) echo $facebook; ?>"  style="margin-left:10px; color:#666"/>
                                </div>
                             
                            </div>
                        <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Twitter Username
                                <input  id="twitter_input" placeholder="Twiiter" type="text" value="<?php if(isset($twitter)) echo $twitter; ?>"  style="margin-left:10px; color:#666"/>
                                </div>
                             
                            </div>
                    <button id="feed_submit"  class="btn btn-success"  >Save</button>
                    
                    	 <div id="feeds_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         <div id="feeds_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>

                    </div>
                  </div>
                 
                  <div class="<?php if(isset($tab_video)) echo $tab_video; ?>  row-fluid tab-pane fade" id="videos" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>Manage Videos</h1>
                        <p>Here you can declare your the YouTube account you wish to associate with your app.</p>
                            <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Youtube Username 
                                <input  id="youtube_username" placeholder="Youtube Username" type="text" value="<?php if(isset($youtube)) echo $youtube; ?>"  style="margin-left:10px; color:#666"/>
                                </div>
                             
                            </div>
                    <button id="submit_youtube"  class="btn btn-success"  >Save</button>
                    
                    	 <div id="youtube_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         <div id="youtube_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>

                    </div>
                  </div>
                  
                  <div class="<?php if(isset($tab_picture)) echo $tab_picture; ?> row-fluid tab-pane fade" id="pictures" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>Manage Pictures</h1>
                       <p>Manage your Instagram Info</p>
                        
                            <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Instagram&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input  id="instagram" placeholder="Instagram User Name" type="text" value="<?php if(isset($instagram)) echo $instagram; ?>"  style="margin-left:10px; color:#666"/>
                                </div>
                             
                            </div>
                         <!-- <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Use 
                                Instagram:  <input id="useInstagram" type="checkbox" <?php if(isset($useinstagram) && $useinstagram == '1') echo "checked"; ?> />
                            </div>
                            </div>
                       <br />
                       <br />-->
                    <button id="save_picture"  class="btn btn-success "  >Save</button>
                     
                    
                    
                    
                        <div id="picture_bad" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         <div id="picture_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                    
                 
                    </div>
                
         </div>    
                                  
             
                  
             <div id="add_inApp" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Add In App Purchase</h3>
                </div>
                <div class="modal-body">
                
                 <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Number of Credits 
                                         
                                          <input type="number" id="number_credit_inApp" min="1" value="250"/>
                
                
                   </div>
                </div>
                <div id="inApp_bad" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>

                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button id="submit_inApp" id="submit_app_credits" class="btn btn-primary">Save changes</button>
                </div>
                </div>

             
                  <div class="<?php if(isset($tab_event)) echo $tab_event; ?> row-fluid tab-pane fade" id="calendar" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>Manage Calendar</h1>
                        <p>Here you can add, view and delete events on your calendar.</p>
                            <div class="tabbable"> <!-- Only required for left/right tabs -->
                              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">Current Events</a></li>
                                <li><a href="#addevent" data-toggle="modal">Add Event</a>
                                </li>
                              </ul>
                              <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <!--<button id="show_hide_event_table" data-hd="show" style="margin-bottom: 25px; margin-top: 25px; margin-left: 20px;" class="btn btn-info btn-large pull-left">Show Past Events</button>
                                    
                                       <div class="span8" style="vertical-align:middle; float: left;">
                                       
										<div class="pull-left span12 offset1" >	
										<label style="font-size:18px; font-weight:bold; width: 100%;">Pollstar Url <input  id="pollstar_url" placeholder="PollStar Url" type="url" value="<?php if(isset($pollstar)) echo $pollstar; ?>"  style="margin-left:10px; color:#666"/></label> 
                            			</div>
                         
                             
                            </div>-->
                                   
                                    
                                    <table id="table_event" class="table table-striped" style="width: 100%; text-align: center;" >
                                  	<thead>
                                        <tr >
                                            <th width="10%">
                                            #
                                            </th>
                                            <th width="25%">
                                            Events
                                            </th>
                                            <th width="25%">
                                            Location
                                            </th>
                                             <th width="25%">
                                            Start Date
                                            </th>
                                            
                                            <th width="15%">
                                            Options
                                            </th>
                                         </tr>
                                    </thead>
                                    <tbody >
                                        <?php if(isset($event_table)) echo $event_table; ?>
                                    </tbody>
                                 </table>
                                    
                                   
                    <!--<button id="submit_pollstar"   class="btn btn-success btn-large"  ><?php if(isset($pollstar_info)) echo $pollstar_info; ?></button>-->
                    
                    	 <div id="events_warning" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>
                         <div id="events_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>

                    
                        
                                </div>
                                </div>
                              </div>
                       </div>
                       
                       <!---- --->
                        
                        <div id="addevent" class="modal hide fade" tabindex="-1" role="dialog"  style="z-index: 500;" aria-hidden="true">
                              
                              <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Add an Event</h3>
                              </div>
                         <form style="margin: 0px;" action="/entertainment/add_event/<?php if(isset($App_ID)) echo $App_ID; ?>" method="POST">
                              <div class="modal-body">
                                
                                        <div style="width:100%" align="center">
                                            <span style="font-size:18px; font-weight:bold;">Event Name </span> <input type="text" name="add_events_name" id="add_events_name" placeholder="Event Name" value="">
                                            <br>
                                            <span style="font-size:18px; font-weight:bold;">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> <input type="text" name="add_events_category" id="add_events_category" placeholder="Category" value="">
                                            <br>
                                            <span style="font-size:18px; font-weight:bold;">Venue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> <input type="text" name="add_events_venue" id="add_events_venue" placeholder="Venue Name" value="">
                                            <br>
                                            <input type="text" name="add_events_address" id="add_events_address" placeholder="Address" style="margin-left:105px" class="row4" value="">
                                            <br>
                                            <input type="text" name="add_events_city" class="row5" id="add_events_city" placeholder="City"  style="width:90px; margin-left:100px" value=""> 
                                            <input type="text" name="add_events_state" id="add_events_state" placeholder="St"  style="width:30px" maxlength="2" value=""> 
                                            <input type="text" name="add_events_zip" id="add_events_zip" placeholder="Zip" maxlength="5"  style="width:50px" value=""> 
                                            <br>
                                
                                            <div class="row-fluid" style="width: 390px;">
                                				<span  style="font-size:18px; font-weight:bold; float:left; width: 100px;margin-right: 30px;">Start</span>
                                        		
                                                <div style="float:left; margin-right:1px" class="input-append date" id="event_add_startdate_div" data-date="<?php echo date('m/d/Y'); ?>" data-date-format="dd-mm-yyyy">
                                            		<input class="span2" name="add_events_startdate" id="add_events_startdate" size="8" style="width:90px" type="text" value="<?php echo date('m/d/Y'); ?>" readonly="readonly">
                                            		<span class="add-on">
                                                    	<i class="icon-calendar">
                                                        </i>
                                                    </span>
                                          		</div>


                                    			<div style="float:left" id="add_events_starttime_div" class="input-append bootstrap-timepicker-component">
                                                    <input class="input-small timepicker-default" name="event_add_starttime" style="width:75px" id="event_add_starttime" type="text" readonly="readonly" value="12:00 AM">
                                                    <span class="add-on">
                                                    	<i class="icon-time">
                                                        </i>
                                                   	</span>
                                     			</div>
                                 			</div>
                                            
                                        <div class="row-fluid"  style="width: 391px; margin-left: -1px;">
                                            <span  style="font-size:18px; font-weight:bold; float:left; width: 100px;margin-right: 30px;">End </span>
                                            <div style="float:left; margin-right:1px;" class="input-append date" id="event_add_enddate_div" data-date="<?php echo date('m/d/Y'); ?>" data-date-format="dd-mm-yyyy">
                                              <input class="span2" size="8" name="event_add_enddate" id="event_add_enddate" style="width:90px" type="text" value="<?php echo date('m/d/Y'); ?>" readonly="readonly">
                                              <span class="add-on">
                                              	<i class="icon-calendar">
                                                </i>
                                              </span>
                                            </div>
                                
                             			<div style="float:left" id="event_add_endtime_div" class="input-append bootstrap-timepicker-component">
                                                <input class="input-small timepicker-default" name="event_add_endtime" style="width:75px" type="text" readonly="readonly" id="event_add_endtime" value="12:00 AM">
                                                <span class="add-on">
                                                <i class="icon-time">
                                                </i>
                                                </span>
                                 			</div>
     

                                 			<textarea  id="event_add_description" name="event_add_description" placeholder="Motivate people to go by leaving a description of the event. Details such as age limit, attire, theme, as well as prices and contact info will be very useful. " rows="3"  style="margin-left:100px; width: 240px; color:#000; resize:none;"></textarea>
                            
                                		</div>
                              		</div>
                                    
                            
                              </div>
                              <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button class="btn btn-success" >Add Event</button>
                              </div>
                         </form>
                          
                            
                        
                     </div>
                        
                        <div id="editevent" class="modal hide fade" tabindex="-1" role="dialog"  style="z-index: 500;" aria-hidden="true">
                              
                              <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Edit an Event</h3>
                              </div>
                         <form style="margin: 0px;" action="/entertainment/edit_event/<?php if(isset($App_ID)) echo $App_ID; ?>" method="POST">
                              <div class="modal-body">
                                
                                        <div style="width:100%" align="center">
                                            <span style="font-size:18px; font-weight:bold;">Event Name </span> <input type="text" id="edit_events_name" name="edit_events_name" placeholder="Event Name" value="">
                                            <br>
                                            <span style="font-size:18px; font-weight:bold;">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> <input type="text" name="edit_events_category" id="edit_events_category" placeholder="Category" value="">
                                            <br>
                                            <span style="font-size:18px; font-weight:bold;">editress&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> <input name="edit_events_venue" type="text" id="edit_events_venue" placeholder="Venue Name" value="">
                                            <br>
                                            <input type="text" name="edit_events_address" id="edit_events_address" placeholder="address" style="margin-left:105px" class="row4" value="">
                                            <br>
                                            <input type="text" class="row5" name="edit_events_city" id="edit_events_city" placeholder="City"  style="width:90px; margin-left:100px" value=""> 
                                            <input type="text" id="edit_events_state" name="edit_events_state" placeholder="St"  style="width:30px" maxlength="2" value=""> 
                                            <input type="text" id="edit_events_zip" name="edit_events_zip" placeholder="Zip" maxlength="5"  style="width:50px" value=""> 
                                            <br>
                                <input type="hidden" id="event_id" value="" name="event_id" />
                                            <div class="row-fluid" style="width: 390px;">
                                				<span  style="font-size:18px; font-weight:bold; float:left; width: 100px;margin-right: 30px;">Start</span>
                                        		
                                                <div style="float:left; margin-right:1px" class="input-append date" id="event_edit_startdate_div" data-date="<?php echo date('m/d/Y'); ?>" data-date-format="dd-mm-yyyy">
                                            		<input class="span2" name="edit_events_startdate" id="edit_events_startdate" size="8" style="width:90px" type="text" value="<?php echo date('m/d/Y'); ?>" readonly="readonly">
                                            		<span class="add-on">
                                                    	<i class="icon-calendar">
                                                        </i>
                                                    </span>
                                          		</div>


                                    			<div style="float:left" id="edit_events_starttime_div" class="input-append bootstrap-timepicker-component">
                                                    <input class="input-small timepicker-default" name="event_edit_starttime" style="width:75px" id="event_edit_starttime" type="text" readonly="readonly" value="12:00 AM">
                                                    <span class="add-on">
                                                    	<i class="icon-time">
                                                        </i>
                                                   	</span>
                                     			</div>
                                 			</div>
                                            
                                        <div class="row-fluid"  style="width: 391px; margin-left: -1px;">
                                            <span  style="font-size:18px; font-weight:bold; float:left; width: 100px;margin-right: 30px;">End </span>
                                            <div style="float:left; margin-right:1px;" class="input-append date" id="event_edit_enddate_div" data-date="<?php echo date('m/d/Y'); ?>" data-date-format="dd-mm-yyyy">
                                              <input class="span2" size="8" id="event_edit_enddate" name="event_edit_enddate" style="width:90px" type="text" value="<?php echo date('m/d/Y'); ?>" readonly="readonly">
                                              <span class="add-on">
                                              	<i class="icon-calendar">
                                                </i>
                                              </span>
                                            </div>
                                
                             			<div style="float:left" id="event_edit_endtime_div" class="input-append bootstrap-timepicker-component">
                                                <input class="input-small timepicker-default" name="event_edit_endtime" style="width:75px" type="text" readonly="readonly" id="event_edit_endtime" value="12:00 AM">
                                                <span class="add-on">
                                                <i class="icon-time">
                                                </i>
                                                </span>
                                 			</div>
     

                                 			<textarea  id="event_edit_description" name="event_edit_description" placeholder="Motivate people to go by leaving a description of the event. Details such as age limit, attire, theme, as well as prices and contact info will be very useful. " rows="3"  style="margin-left:100px; width: 240px; color:#000; resize:none;"></textarea>
                            
                                		</div>
                              		</div>
                                    
                              
                                                        </div>

                              <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button type="submit" class="btn btn-success" >Edit Event</button>
                              </div>
                              
                         </form>
                        
                     </div>    
                        
                  </div>
                          
                  <div class="<?php if(isset($tab_fanwall)) echo $tab_fanwall; ?> row-fluid tab-pane fade" id="fanwall" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>Manage Fan Wall</h1>
                        <p>Here you can view and delete comments on your fan wall.</p>
                           <table id="fanwall_table" class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th width="70%">Comments</th>
                                      <th width="15%">Date</th>
                                      <th width="15%">Options</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                <!--<tr>
                                      <td>
                                      		"I Love This Application"<br />
                                            - <a href="http://www.facebook.com/andrewoodleyjr" target="_blank">Andre D. Woodley</a> 
                                      </td>
                                      
                                      <td>
                                      		9/19/2012
                                      </td>
                                      
                                      <td>
                                            <img  src="/images/delete.png" style="width:30px"  />
                                      </td>
                                    </tr>-->
                                      <?php if(isset($fanwall)) echo $fanwall; ?>
                                 </tbody>
                                </table>
                    
                    	
                     </div>
                  </div>
                  
                  <div class="<?php if(isset($tab_livevideo)) echo $tab_livevideo; ?>row-fluid tab-pane fade" id="livevideo" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>Manage Ustream</h1>
                        <p>Here you can connect your uStream account.</p>
                            <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">uStream<input id="ustream_url" placeholder="uStream Username" type="text" value="<?php if(isset($ustream)) echo $ustream; ?>"  style="margin-left:10px; color:#000"/>
                            </div>
                            </div>
                    
                    
                    
                        <button type="button" class="btn btn-success" id="submit_ustream">Save</button>                    
                    	 <div id="ustream_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                         <div id="ustream_bad" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>

                     </div>
                  </div>
                  
                  <div class="<?php if(isset($tab_about)) echo $tab_about; ?> row-fluid tab-pane fade" id="about" style="width:100%;">
                  	<div style="width:100%; text-align:center">
                        <h1>About</h1>
                        <p>Here you change your about section.</p>
                            <div style="width:100%; vertical-align:middle">
                            <textarea class="myMess" id="about_textarea" style="margin-left:1px; color:#000; resize:none;"><?php if(isset($about)) echo $about; ?></textarea>
                            
                            </div>
                    
                    
                              <button id="submit_about" class="btn btn-success" id="" >Save</button>
                    
                         <div id="about_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                         <div id="about_bad" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>

                  </div>
                  </div>
                  
                  <div class="<?php if(isset($tab_contact)) echo $tab_contact; ?> tab-pane fade" id="contact" style="width:100%;">
                  <div style="width:100%; text-align:center">
                        <h1>Manage Contact</h1>
                        <p>Here you change your contact information.</p>           
                           <div style="width:100%; vertical-align:middle;">
                            <div style="font-size:18px; font-weight:bold;">Email &nbsp;&nbsp;&nbsp;<input id="email" placeholder="email" type="email" value="<?php if(isset($email)) echo $email; ?>"  style="margin-left:10px; color:#666"/> </div>
                    
                            </div>
                        
                            <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Phone &nbsp;&nbsp;<input id="phone" placeholder="Phone Number" type="tel" value="<?php if(isset($phone)) echo $phone; ?>"  style="margin-left:10px; color:#666"/>
                                </div>
                             
                            </div>
                    
                            <div style="width:100%; vertical-align:middle">
                            <div style="font-size:18px; font-weight:bold;">Website <input id="website" placeholder="Website Link" type="url" value="<?php if(isset($website)) echo $website; ?>"  style="margin-left:10px; color:#000"/>
                            </div>
                            </div>
                    
                    
                    
                              <button id="submit_contact" class="btn btn-success" id="" >Save</button>
                    
                     
                         <div id="contact_good" class="alert alert-success" style="display: none; margin-top: 20px;"></div>
                         <div id="contact_bad" class="alert alert-danger" style="display: none; margin-top: 20px;"></div>

                    </div>
                  </div>
                  
                  <div class="<?php if(isset($tab_links)) echo $tab_links; ?> row-fluid tab-pane fade" id="links" style="width:100%;">
                   <div style="width:100%; text-align:center">
                        <h1>Manage Links</h1>
                        <p>Here you add edit and delete website links.</p>
                        <div class="tabbable"> <!-- Only required for left/right tabs -->
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#linker" data-toggle="tab">Links</a></li>
                            <li><a href="#addlink" data-toggle="modal">Add Link</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane active" id="linker">
                              <table id="link_table" class="table table-bordered">
                                  <thead>
                                    <tr>
                                       <th width="5%">#</th>
                                      <th width="80%">Web Links</th>
                                      <th width="15%">Options</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <?php if(isset($link_table)) echo $link_table; ?>

                                 </tbody>
                                </table>
                            
                                <button class="btn btn-success" id="change_link_position" >Change Link Position</button>
                            </div>
                            <!-- Modal -->
                            <div id="addlink" class="modal hide fade" tabindex="-1" role="dialog"  aria-hidden="true">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Add Link</h3>
                              </div>
                              
                              <div class="modal-body">
                                	<div style="width:100%; vertical-align:middle;">
                                        <div style="font-size:18px; font-weight:bold;">
                                        Website<input id="link_webiste" placeholder="Website" type="text" value=""  style="margin-left:10px; color:#666"/> 
                                        </div>
                              		</div>
                        
                                    <div style="width:100%; vertical-align:middle">
                                        <div style="font-size:18px; font-weight:bold;">
                                        Link &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="link_location" placeholder="Link" type="url" value=""  style="margin-left:10px; color:#666"/>
                                        </div>
                                    </div>
                                    <div id="add_link_error" class="alert alert-danger" style="display: none;" ></div>
                              </div>
                              
                              <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button id="add_link" class="btn btn-primary">Add</button>
                              </div>
                            </div>
                            
                            
                            <!-- Modal -->
                            <div id="editlink" class="modal hide fade" tabindex="-1" role="dialog"  aria-hidden="true">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Edit Link</h3>
                              </div>
                              
                              <div class="modal-body">
                                	<div style="width:100%; vertical-align:middle;">
                                        <div style="font-size:18px; font-weight:bold;">
                                        Website<input id="edit_link_name" placeholder="Website" type="text" value=""  style="margin-left:10px; color:#666"/> 
                                        </div>
                              		</div>
                                  <input type="hidden" id="edit_link_id" />
                                    <div style="width:100%; vertical-align:middle">
                                        <div style="font-size:18px; font-weight:bold;">
                                        Link &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="edit_link_url" placeholder="Link" type="url"   style="margin-left:10px; color:#666"/>
                                        </div>
                                    </div>
                         <div id="edit_link_error" class="alert alert-danger" style="display: none;" ></div>

                              </div>
                              
                              <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button id="edit_link_button" class="btn btn-primary">Save</button>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                       	 
                    </div>
                  </div>
                  
		</div> 

  
</div>
</div>