<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_faq
 *
 * @author GOI LLC
 */
class model_faq extends CI_Model {

    function getYoutubePlayList() {
        $playlist_data = array();

        $feedURL = 'http://gdata.youtube.com/feeds/api/playlists/PLfdtiltiRHWHzDIakTiWxVrYFSLDQv_WB';
        $sxml = simplexml_load_file($feedURL);
        $playlist_data['title'] = $sxml->title;
        $html = '<div class="item active"> 
              <ul class="thumbnails" >';

        $i = 0;
        $videoCount = 0;
        // iterate over entries in feed
        foreach ($sxml->entry as $entry):

            if ($videoCount / 4 == 1):
                $html .= '</ul></div><div class="item"><ul class="thumbnails">';
                $videoCount = 0;
            endif;
            // get nodes in media: namespace for media information
            $media = $entry->children('http://search.yahoo.com/mrss/');

            // get video player URL
            $attrs = $media->group->player->attributes();
            $watch = $attrs['url'];
            $videoTitle = $entry->title;
            $content = $entry->content;

            // get video thumbnail
            $attrs = $media->group->thumbnail[0]->attributes();
            $thumbnail = $attrs['url'];

            // get <yt:duration> node for video length
            $yt = $media->children('http://gdata.youtube.com/schemas/2007');
            $attrs = $yt->duration->attributes();
            $length = $attrs['seconds'];

            // get <yt:stats> node for viewer statistics
            $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
            $attrs = $yt->statistics->attributes();
            $viewCount = $attrs['viewCount'];

            // get <gd:rating> node for video ratings
            $gd = $entry->children('http://schemas.google.com/g/2005');
            if ($gd->rating):
                $attrs = $gd->rating->attributes();
                $rating = $attrs['average'];
            else:
                $rating = 0;
            endif;

            $watch = str_replace('&feature=youtube_gdata_player', '', $watch);
            $watch = str_replace('http://www.youtube.com/watch?v=', '', $watch);

        $html .= "<li class=\"span3\">";
        $html .= "<a data-toggle='modal' role='button' href='#faq_vid_$i' class='thumbnail'>";
        $html .= "<img src='$thumbnail' alt=''></a> </li>";
        $html .= "<div id='faq_vid_$i' class='modal hide fade' tabindex='-1' role='dialog'  aria-hidden='true'>";  
        $html .= "<div class='modal-header'> <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>"; 
        $html .= "<h3 class='faq_vidtitle' >$videoTitle</h3></div><div class='modal-body'>";
        $html .= "<iframe title='YouTube video player' type='text/html' src='http://www.youtube.com/embed/$watch' frameborder='0' class='faq_vidsize'></iframe>'";
        $html .= $content . "</div><div class='modal-footer'>";
        $html .= "<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button> </div></div>";
        $videoCount += 1;
        $i += 1;
        endforeach;
        
        $html .= '</ul></div>';
        
        $playlist_data['playlist'] = $html;
        return $playlist_data;
    }

}

