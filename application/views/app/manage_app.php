

<div class="row-fluid">
    <div class="span4" >
<!--        <ul class="nav nav-tabs nav-stacked firstmenu" style="background-color:#FFFFFF">-->
<!--        <li class="disabled" style="color:#006600; font-size:18px; text-decoration:none;"><a href="" style="text-decoration:none; color:#060">Menu</a></li>
            <li><a href=""><label><i class="icon-home"></i><i class="icon-chevron-right pull-right"></i> Home</label></a></li>
            <li><a><label ><i class="icon-music"></i><i class="icon-chevron-right pull-right"></i>  Music</label></a></li>
            <li><a><label ><i class="icon-facetime-video"></i><i class="icon-chevron-right pull-right"></i> Media</label></a></li>
            <li><a><label ><i class="icon-user"></i><i class="icon-chevron-right pull-right"></i>  Feed</label></a></li>
            <li class="disabled" style="color:#006600; font-size:18px; text-decoration:none;"><a href="" style="text-decoration:none; color:#060">More</a></li>
            <li><a><label><i class="icon-calendar"></i><i class="icon-chevron-right pull-right"></i>  Events</label></a></li>
            <li><a><label><i class="icon-play"></i><i class="icon-chevron-right pull-right"></i>  Youtube</label></a></li>
            <li><a><label><i class="icon-envelope"></i><i class="icon-chevron-right pull-right"></i>  Contact</label></a></li>
            <li><a><label><i class="icon-question-sign"></i><i class="icon-chevron-right pull-right"></i>  About</label></a></li>-->
       <?php if(isset($lis)) echo $lis; ?>
        
        
<!--        </ul>-->
    </div>
    
    <div class="span8 img-rounded" id="settings" style="background-color:#000; box-shadow:#CCC 0px 0px 0px 1px; padding:25px; background-color:#000; margin-left: 30px; margin-top: 40px;">
                        <div id="ajaxContent">	
                            <?php if(isset($content)) echo $content;  ?>	
                        </div>
        </div>
    
</div>