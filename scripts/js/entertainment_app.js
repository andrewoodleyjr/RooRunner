$(document).ready(function() { 
    
    $('input[id=add_music_file]').change(function() {
         $('#add_music').val($(this).val());
    });
    $('input[id=edit_music_file]').change(function() {
         $('#edit_music').val($(this).val());
    });
  
    $("#event_add_startdate_div").datepicker({
        format: 'mm/dd/yyyy'
    });
    $("#event_add_enddate_div").datepicker({
        format: 'mm/dd/yyyy'
    });
    $('#event_add_endtime').timepicker({
                minuteStep: 5,
                showInputs: false,
                disableFocus: true
    }
        
    );
    $('#event_add_starttime').timepicker({
                minuteStep: 5,
                showInputs: false,
                disableFocus: true
    });
     $("#event_edit_startdate_div").datepicker({
        format: 'mm/dd/yyyy'
    });
    $("#event_edit_enddate_div").datepicker({
        format: 'mm/dd/yyyy'
    });
    $('#event_edit_endtime').timepicker({
                minuteStep: 5,
                showInputs: false,
                disableFocus: true
    });
    $('#event_edit_starttime').timepicker({
                minuteStep: 5,
                showInputs: false,
                disableFocus: true
    });
 
    $("#song_table").tableDnD();
    $("#hash_tag_table").tableDnD();
    $("#link_table").tableDnD();
    
    
    $(".delete_inApp").live('click', function (){
      var App_ID = $("#App_ID").val();
      var inApp_id = $(this).attr('data-id');
        $.ajax({
              
                    url: "/entertainment/delete_in_app_purchase/" + App_ID + '/' + inApp_id,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(!IsJsonString(data)){
                            alert(data);
                        }
                        else{
                            var json = JSON.parse(data);
                            if(json.error == 1){
                               alert(json.message);
                            }
                            if(json.error == 0){
                                $("#inApp_table tbody").html(json.table);
                            }
                            
                            }
                           
                            
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       }); 
    });
    
    $("#submit_inApp").live("click", function(){
                   var App_ID = $("#App_ID").val();
       var number_credit_inApp = $("#number_credit_inApp").val();

       var url = "/entertainment/create_in_app_purchase/" + App_ID + '/' + number_credit_inApp;
             
             $.ajax({
              
                    url: "/entertainment/create_in_app_purchase/" + App_ID + '/' + number_credit_inApp,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(!IsJsonString(data)){
                            alert(data);
                        }
                        else{
                            var json = JSON.parse(data);
                            if(json.error == 1){
                                $("#inApp_bad").html(json.message);
                                 $("#inApp_bad").show('fast');
                            }
                            if(json.error == 0){
                                $("#inApp_table tbody").html(json.table);
                                $("#inApp_bad").hide();
                                $('#add_inApp').modal('hide');

                            }
                            
                            }
                           
                            
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       }); 
       
    });
    
    
    
 $("#feed_submit").live('click', function(){
            var facebook = $("#facebook_input").val();
            var twitter = $("#twitter_input").val();
            var json_array = [];
            var obj_twitter = {};
            obj_twitter.name = "twitter";
            obj_twitter.value = twitter;
            json_array.push(obj_twitter);
            var obj_facebook = {};
            obj_facebook.name = "facebook";
            obj_facebook.value = facebook;
            json_array.push(obj_facebook);
           
           var send = "json=" + JSON.stringify(json_array);
            var App_ID = $("#App_ID").val();
               $.ajax({
                    url: "/entertainment/simple_record/" + App_ID,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 1){
                             $("#feeds_good").css("display", "block");
                             $("#feeds_warning").html(json.message);
                             $("#feeds_warning").css("display", "none");
                             
                            }
                            else{
                                
                                
                             $("#feeds_good").css("display", "block");
                             $("#feeds_good").html(json.message);
                             $("#feeds_warning").css("display", "none");
                             $("#feeds_good").css("display", "block");
                             $("#feeds_warning").html(json.message);
                             $("#feeds_warning").css("display", "none");

                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
            
        });
    $("#change_position_table").live('click', function(){
        
        var position = [];
        
        $("table#song_table tbody tr").each(function(index){
           var item = {};
           item.position = index +1;
           item.id = $(this).attr('id');
           position.push(item);
        });
        
       
        
        
        var App_ID = $("#App_ID").val();
        
        var send = "position=" + JSON.stringify(position);
            $.ajax({
                    url: "/entertainment/change_song_position/" + App_ID ,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(!IsJsonString(data)){
                            alert(data);
                        }
                        else{
                            var json_array = JSON.parse(data);
                            alert(json_array.message);
                            if(json_array.error === 0){
                               $("table#song_table tbody").html(json_array.table);
                               $("#song_table").tableDnD();
                            }
                           
                            }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       }); 
        
    });
//    var name =  $("#fonts option:selected").val();
//    var count = 1;
//    $("#fonts option").each(function(){
//        if(name === $(this).val()){
//            count += 1;
//            if(count === 2){
//                $(this).remove();
//            }
//        }
//        
//    });
    $("#fonts").live('change', function(){
       $("#font_example").css('font-family', $("#fonts option:selected").val()); 
    });
    $("#font_example").css('font-family', $("#fonts option:selected").val()); 
    
    
    $("#sumbit_theme").live("click", function(){
       var tabbar =  $("#tabbar_stored").val();
       var tabbar_select_button = $("#tabbar_select_button_stored").val();
       var tabbar_select_text_stored = $("#tabbar_select_text_stored").val();
       var background_stored = $("#background_stored").val();
       var list_background_stored = $("#list_background_stored").val();
       var text_color_stored = $("#text_color_stored").val();
       var font_style  = $("#fonts option:selected").val();
       var App_ID = $("#App_ID").val();

       
       var send = "tabbar=" + tabbar + "&tabbar_select_button=" + tabbar_select_button + "&tabbar_select_text=" + tabbar_select_text_stored;
       send += "&background=" + background_stored + "&list_background=" +list_background_stored + "&text_color=" + text_color_stored; 
       send += "&font=" + font_style;
       
       $.ajax({
                    url: "/entertainment/themechange/" + App_ID ,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                      alert(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }
                }); 
});
    
    $("#tabbar_div").colorpicker().on('changeColor', function(ev){
        
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_stored").val(JSON.stringify(color_object));
     $("#tabbar").val(ev.color.toHex());
     
     }).on('hide', function(ev){
                     
          var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_stored").val(JSON.stringify(color_object));
     $("#tabbar").val(ev.color.toHex());
     
            }).on('show',function(ev){
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_stored").val(JSON.stringify(color_object));
     $("#tabbar").val(ev.color.toHex()); 
            });
    $("#tabbar_select_div").colorpicker().on('changeColor', function(ev){
        
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_select_button_stored").val(JSON.stringify(color_object));
     $("#tabbar_select_button").val(ev.color.toHex());
     
     }).on('hide', function(ev){
                     
          var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_select_button_stored").val(JSON.stringify(color_object));
     $("#tabbar_select_button").val(ev.color.toHex());
     
            }).on('show',function(ev){
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_select_button_stored").val(JSON.stringify(color_object));
     $("#tabbar_select_button").val(ev.color.toHex()); 
            });
            
   $("#tabbar_select_text_div").colorpicker().on('changeColor', function(ev){
        
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_select_text_stored").val(JSON.stringify(color_object));
     $("#tabbar_select_text").val(ev.color.toHex());
     
     }).on('hide', function(ev){
                     
          var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_select_text_stored").val(JSON.stringify(color_object));
     $("#tabbar_select_text").val(ev.color.toHex());
     
            }).on('show',function(ev){
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#tabbar_select_text_stored").val(JSON.stringify(color_object));
     $("#tabbar_select_text").val(ev.color.toHex()); 
            });
     $("#background_div").colorpicker().on('changeColor', function(ev){
        
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#background_stored").val(JSON.stringify(color_object));
     $("#background").val(ev.color.toHex());
     
     }).on('hide', function(ev){
                     
          var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#background_stored").val(JSON.stringify(color_object));
     $("#background").val(ev.color.toHex());
     
            }).on('show',function(ev){
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#background_stored").val(JSON.stringify(color_object));
     $("#background").val(ev.color.toHex()); 
            });  
                 $("#list_background_div").colorpicker().on('changeColor', function(ev){
        
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#list_background_stored").val(JSON.stringify(color_object));
     $("#list_background").val(ev.color.toHex());
     
     }).on('hide', function(ev){
                     
          var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#list_background_stored").val(JSON.stringify(color_object));
     $("#list_background").val(ev.color.toHex());
     
            }).on('show',function(ev){
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#list_background_stored").val(JSON.stringify(color_object));
     $("#list_background").val(ev.color.toHex()); 
            });                 
            
   $("#text_color_div").colorpicker().on('changeColor', function(ev){
            
        
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#text_color_stored").val(JSON.stringify(color_object));
     $("#text_color").val(ev.color.toHex());
     
     }).on('hide', function(ev){
                     
          var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#text_color_stored").val(JSON.stringify(color_object));
     $("#text_color").val(ev.color.toHex());
     
            }).on('show',function(ev){
      var color_object = {};
      color_object.r = ev.color.toRGB().r;
      color_object.g = ev.color.toRGB().g;
      color_object.b = ev.color.toRGB().b;
      color_object.a = ev.color.toRGB().a;
      color_object.hex = ev.color.toHex();
     $("#text_color_stored").val(JSON.stringify(color_object));
     $("#text_color").val(ev.color.toHex()); 
            });
            
            
   
    
    $(".delete_song").live('click', function(){
        
        var confirm_it = confirm("Are You sure you want to delete this song?");
        if(!confirm_it){
            return false;
        }
        
        var App_ID = $(this).attr('date-app_id');
        var song_id = $(this).attr('data-id');
        
        $.ajax({
                    url: "/entertainment/delete_song/" + App_ID + '/' + song_id,
                    type: 'GET',
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(!IsJsonString(data)){
                            alert(data);
                        }
                        else{
                            var json_array = JSON.parse(data);
                            $("#song_table tbody").html(json_array.table);
                           $("#song_table").tableDnD();

                            alert(json_array.message);
                            
                            }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       }); 
       return true;
    });
    
    
    
    $(".edit_song_link").live('click', function(){
       
       
       var id = $(this).attr('data-id');
       $("#edit_song_id").val(id);
       $.ajax({
                    url: "/entertainment/get_song_edit/" + id,
                    type: 'GET',
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(!IsJsonString(data)){
                            alert(data);
                        }
                        else{
                            var json_array = JSON.parse(data);
                            $("#edit_song_name").val(json_array.song_name);
                            $("#edit_artist").val(json_array.song_artist);
                            $("#edit_song_affiliate_link").val(json_array.aff_link);
                        }
                        
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
       
       
       
    });
    
    
        $("#submit_youtube").live('click', function(){
       var youtube = $("#youtube_username").val();
       var json_array = [];
       var json_youtube = {};
       json_youtube.name = "youtube";
       json_youtube.value = youtube;
       json_array.push(json_youtube);
       var send = "json=" + JSON.stringify(json_array);
       var App_ID = $("#App_ID").val();
               $.ajax({
                    url: "/entertainment/simple_record/" + App_ID,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 1){
                             $("#youtube_warning").css("display", "block");
                             $("#youtube_warning").html(json.message);
                             $("#youtube_good").css("display", "none");
                             
                            }
                            else{
                             $("#youtube_good").css("display", "block");
                             $("#youtube_good").html(json.message);
                             $("#youtube_warning").css("display", "none");

                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
       
    });
    
    
    $("#submit_contact").live('click', function(){
       var App_ID = $("#App_ID").val();
        var json_array = [];
        var json_website = {};
        json_website.value = $("#website").val();
        json_website.name = "website";
        json_array.push(json_website);
        var json_phone = {};
        json_phone.value = $("#phone").val();
        json_phone.name = "phone";
        json_array.push(json_phone);
         var json_email = {};
        json_email.value = $("#email").val();
        json_email.name = "email";
        json_array.push(json_email);
		
		
        
        var send = "json=" + JSON.stringify(json_array);
        
         $.ajax({
                    url: "/entertainment/simple_record_main/" + App_ID,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 1){
                             
                             $("#contact_bad").css("display", "block");
                             $("#contact_bad").html(json.message);
                             $("#contact_good").css("display", "none");
                            }
                            else{
                             
                             
                             $("#contact_good").css("display", "block");
                             $("#contact_good").html(json.message);
                             $("#contact_bad").css("display", "none");
                                

                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
        
    });
    
    
  
        $("#home_submit").live('click', function(){
            
            var App_ID = $("#App_ID").val();
            var json_array = [];
            var json_login = {};
            json_login.name = "forced_signin";
            if($('#forced_signin').is(":checked")){
                json_login.value = "1";
                
            }
            else{
                json_login.value = '0';
            }
            json_array.push(json_login);
            
            
var send = "json=" + JSON.stringify(json_array);
         $.ajax({
                    url: "/entertainment/simple_record/" + App_ID,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 1){
                             
                             $("#home_warning").css("display", "block");
                             $("#home_warning").html(json.message);
                             $("#home_good").css("display", "none");
                            }
                            else{
                             
                             
                             $("#home_good").css("display", "block");
                             $("#home_good").html(json.message);
                             $("#home_warning").css("display", "none");
                                

                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

                });
        });
    
    
   
        
               $(".change_link").live('click',function(){
            var App_ID = $("#App_ID").val();
            var link_id = $(this).attr('data-id');
         var link_name = $(this).attr('data-link_name');
         var link_url = $(this).attr('data-link_url');
         $("#edit_link_name").val(link_name);
         $("#edit_link_url").val(link_url);
         $("#edit_link_id").val(link_id);
         
         return
        });
        
        $("#add_link").live('click', function(){
         
         var App_ID = $("#App_ID").val();
         var link_location = $("#link_location").val();
         var link_name = $("#link_webiste").val();
         if(!link_location.match(/((https?:\/\/)[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi))
         {
          $("#add_link_error").html("Please enter a valid url with the http:// or https://.");
          $("#add_link_error").css('display', 'block');
          return false;
         }
         
         
         var send = "link_location=" + link_location + "&link_name=" + link_name;
         
                 $.ajax({
                    url: "/entertainment/add_link/" + App_ID ,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 0)
                            {
                             $("#link_table tbody").html(json.table);
                                 $("#link_table").tableDnD();

                            }
                            else{
                                alert(json.message);
                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }
                });
                  
                  $("#add_link_error").css('display', 'none');

                 $("#link_location").val('');
                 $("#link_webiste").val('');
                 $("#addlink").modal('toggle');
                 return true;
        });
        
        
        
        
        $("#change_link_position").live("click", function(){
                    
                    
             var App_ID = $("#App_ID").val();

            var link_array = [];
            $("#link_table tbody tr").each(function(index){
               var link = {};
               link.position = index;
               link.id =$(this).attr('data-id');
               link_array.push(link);
            });
            
            var send = "json=" + JSON.stringify(link_array);
          
            $.ajax({
                    url: "/entertainment/position_link/" + App_ID  ,
                    type: 'POST',
                    dataType: 'text',
                    data: send,
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 0)
                            {
                             $("#link_table tbody").html(json.table);
                             $("#link_table").tableDnD();

                            }
                            else{
                                alert(json.message);
                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }
                });
            
            
        });
        
        
        $(".delete_link").live('click', function(){
            
                 var App_ID = $("#App_ID").val();
                 var link_id = $(this).attr('data-id');
            
            
            $.ajax({
                    url: "/entertainment/delete_link/" + App_ID + '/' + link_id ,
                    type: 'GET',
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 0)
                            {
                             $("#link_table tbody").html(json.table);
                                 $("#link_table").tableDnD();

                            }
                            else{
                                alert(json.message);
                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }
                });
        });
        
        
        
        
        $("#edit_link_button").live('click', function(){
                    var App_ID = $("#App_ID").val();

           var link_id = $("#edit_link_id").val();
           var link_name = $("#edit_link_name").val();
           var link_url = $("#edit_link_url").val();
           if(!link_url.match(/((https?:\/\/)[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi))
           {
          $("#edit_link_error").html("Please enter a valid url with the http:// or https://.");
          $("#edit_link_error").css('display', 'block');
          return false;
           }
             var send = "link_location=" + encodeURIComponent(link_url) + "&link_name=" + link_name + "&link_id=" + link_id; 
                
                $.ajax({
                 
                    url: "/entertainment/edit_link/" + App_ID ,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 0)
                            {
                             $("#link_table tbody").html(json.table);
                                 $("#link_table").tableDnD();

                            }
                            else{
                                alert(json.message);
                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }
                });
                
               $("#edit_link_id").val('');
            $("#edit_link_name").val('');
           $("#edit_link_url").val('');
           $("#editlink").modal('toggle');
           
           return true;
           
        });
    
       
    $(".delete_wall").live('click', function(){
       var comment_id = $(this).attr('data-id');
       var App_ID = $("#App_ID").val();
              $.ajax({
                    url: "/entertainment/delete_comment/" + App_ID + '/' + comment_id,
                    type: 'GET',
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 0)
                            {
                             $("#fanwall_table tbody").html(json.table);
                            }
                            alert(json.message);
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
    });
    
    
    $("#submit_about").live('click', function(){
        var App_ID = $("#App_ID").val();
        var json_array = [];
        var json_about = {};
        json_about.value = $("#about_textarea").val();
        json_about.name = "about";
        json_array.push(json_about);
        var send = "json=" + JSON.stringify(json_array);
        $.ajax({
                    url: "/entertainment/simple_record_main/" + App_ID,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 1){
                             
                             $("#about_bad").css("display", "block");
                             $("#about_bad").html(json.message);
                             $("#about_good").css("display", "none");
                            }
                            else{
                             
                             
                             $("#about_good").css("display", "block");
                             $("#about_good").html(json.message);
                             $("#about_bad").css("display", "none");
                                

                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
        
    });
    
    
    $("#submit_ustream").live('click', function(){
        
        var App_ID = $("#App_ID").val();
        var json_array = [];
        var json_ustream = {};
        json_ustream.value = $("#ustream_url").val();
        json_ustream.name = "ustream";
        json_array.push(json_ustream);
        var send = "json=" + JSON.stringify(json_array);
        $.ajax({
                    url: "/entertainment/simple_record/" + App_ID,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 1){
                             $("#ustream_bad").css("display", "block");
                             $("#ustream_bad").html(json.message);
                             $("#ustream_good").css("display", "none");
                             
                            }
                            else{
                             $("#ustream_good").css("display", "block");
                             $("#ustream_good").html(json.message);
                             $("#ustream_bad").css("display", "none");

                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
    });
    
      $("#save_picture").live('click', function(){
       
     
       
       var json_array = [];
       var json_instragram = {};
       json_instragram.value = $("#instagram").val();
       json_instragram.name = "instagram"
       json_array.push(json_instragram);

       var json_instragram = {};
       json_instragram.name = 'useinstagram';
       json_instragram.value = $('#useInstagram').val();

       if($("#useInstagram").prop('checked')){
           json_instragram.value = '1';
       }
       else{
           json_instragram.value = '0';
       }
           
       json_array.push(json_instragram);    
       var send = "json=" + JSON.stringify(json_array);
       var App_ID = $("#App_ID").val();
               $.ajax({
                    url: "/entertainment/simple_record/" + App_ID,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 1){
                             $("#picture_bad").css("display", "block");
                             $("#picture_bad").html(json.message);
                             $("#picture_good").css("display", "none");
                             
                            }
                            else{
                             $("#picture_good").css("display", "block");
                             $("#picture_good").html(json.message);
                             $("#picture_bad").css("display", "none");

                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
    });
    
    
        $(".edit_events_button").live('click', function(){
        
       var App_ID = $("#App_ID").val();
       var event_id = $(this).attr('date-id');
        var url = "/entertainment/getEventByID/" + App_ID + "/" + event_id;
       $.getJSON(url, function(data){

          var json_edit = data;
          $("#edit_events_name").val(json_edit.event_name);
          $("#edit_events_category").val(json_edit.category);
          $("#edit_events_venue").val(json_edit.venue_name);
          $("#edit_events_address").val(json_edit.street);
          $("#edit_events_city").val(json_edit.city);
          $("#edit_events_state").val(json_edit.state);
          $("#edit_events_startdate").val(json_edit.edit_events_startdate);
          $("#event_edit_starttime").val(json_edit.event_edit_starttime);
          $("#event_edit_enddate").val(json_edit.event_edit_enddate);
          $("#event_edit_endtime").val(json_edit.event_edit_endtime);
          $("#event_edit_description").val(json_edit.description);
          $("#event_id").val(json_edit.id);
       }); 
    });
    
    
    $("#show_hide_event_table").live('click', function(){
        
        var App_ID = $("#App_ID").val();
        var hd = $(this).attr('data-hd');
        $.ajax({
                    url: "/entertainment/get_table/" + App_ID + '/' + hd,
                    type: 'GET',
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 0)
                            {
                             $("#table_event tbody").html(json.table);
                             
                            }
                            else{
                                alert(data);
                            }
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }
                });
                if(hd === 'hide')
                {
                   $(this).attr("data-hd", "show");
                   $(this).html("Show Past Events");
                    alert("We are  hiding events that have already happend.");

                }
                else
                {
                    $(this).attr("data-hd", "hide");
                    $(this).html("Hide Past Events");
                    alert("We are no longer hiding events that have already happend.");

                }
    });
    
    
    
    
    $(".event_delete").live('click', function(){
        
        var go = confirm('Do you want to delete this event?');
        if(!go){
            return true;
        }
        var App_ID = $("#App_ID").val();
        var event_id = $(this).attr('date-id');
                $.ajax({
                    url: "/entertainment/delete_event/" + App_ID + '/' + event_id,
                    type: 'GET',
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 0)
                            {
                             $("#table_event tbody").html(json.table);
                            }
                            alert(json.message);
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }
                });
                return true;
    });
        
        
        $("#submit_pollstar").live('click', function(){
        
       
     
       
       var json_array = [];
       var json_pollstar = {};
       var pollstar = $("#submit_pollstar").html();
       var pollstar_url = $("#pollstar_url").val();
       console.log(pollstar);
       if(pollstar === 'Use Regular Events'){
           pollstar_url = '';
       }
       else{
           if(!pollstar_url.match(/((https?:\/\/)[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi)){
               alert("Please use a properly formatted url.");
               return false;
           }
       }
      
       json_pollstar.value = encodeURIComponent(pollstar_url);
       json_pollstar.name = "pollstar"
       json_array.push(json_pollstar);
       
       
       var send = "json=" + JSON.stringify(json_array);
       var App_ID = $("#App_ID").val();
               $.ajax({
                    url: "/entertainment/simple_record/" + App_ID,
                    type: 'POST',
                    data: send,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        if(IsJsonString(data))
                        {
                            var json = JSON.parse(data);
                            if(json.error === 1){
                             $("#events_warning").css("display", "block");
                             $("#events_warning").html(json.message);
                             $("#events_good").css("display", "none");
                            
                            }
                            else{
                             $("#events_good").css("display", "block");
                             $("#events_good").html(json.message);
                             $("#events_warning").css("display", "none");
                             $("#pollstar_url").val(pollstar_url);
                             if(pollstar_url === '')
                             {
                                 $("#submit_pollstar").html("Use Pollstar")
                             }
                             else
                             {
                                 $("#submit_pollstar").html("Use Regular Events")                                 
                             }
                            }
                           
                        }
                        else
                        {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
    });
    
});
    
function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}