
$(document).ready(function(){
   var chart_2;
   var campaign_id;
   $(".revoke").live('click', function(){
      
   
    campaign_id =  $(this).attr('data-id');
      $('#revokeAdd').modal('show');
   });
   
   $(".deny").live('click', function(){
       
        $('#revokeAdd_1').modal('show');
        campaign_id =  $(this).attr('data-id');

   });
   
   $(".approve").live('click', function(){
               campaign_id =  $(this).attr('data-id');

        $.ajax({
                    url: "/ad_approval/approve_ads/" + campaign_id,
                    dataType: 'text',
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        var json;
                        try{
                            json = JSON.parse(data);
                        }
                        catch(e){
                            console.log(e);
                            console.log(data);
                        }
                         
                        $("#current_table tbody").html(json.table_current);
                        $("#approve_table tbody").html(json.table_approve);    
                        location.reload();
                        
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
        
   });
       $("#charts_startdate").datepicker({
        format: 'mm/dd/yyyy'
    });

    $("#charts_enddate").datepicker({
        format: 'mm/dd/yyyy'
    });
   
   
   
   $("#submit_demo").live('click', function(){
       var startdate = $("#start_date_demo").val();
   var enddate = $("#end_date_demo").val();
   var obj = {};
   obj.startdate = startdate;
   obj.enddate = enddate;
   var type = $("#chart_type option:selected").val();
   var send = "json=" + JSON.stringify(obj);
   
    $.ajax({
                    url: "/ad_approval/getChartData/" + type,
                    dataType: 'text',
                    type : 'POST',
                    data : send,
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        console.log(data);
                        var json;
                        try{
                            json = JSON.parse(data);
                        }
                        catch(e){
                            console.log(e);
                            console.log(data);
                        }
                         
                        if(chart_2 !== 'undefined'){
                            delete chart_1;
                        }
                        console.log(json);
                        chart_2 = new Highcharts.Chart(json);
                        
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
   });
   
   
   
   var startdate = $("#start_date_demo").val();
   var enddate = $("#end_date_demo").val();
   var obj = {};
   obj.startdate = startdate;
   obj.enddate = enddate;
   var send = "json=" + JSON.stringify(obj);
   
    $.ajax({
                    url: "/ad_approval/getChartData/use",
                    dataType: 'text',
                    type : 'POST',
                    data : send,
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        var json;
                        try{
                            json = JSON.parse(data);
                        }
                        catch(e){
                            console.log(e);
                            console.log(data);
                        }
                         
                        if(chart_2 !== 'undefined'){
                            delete chart_1;
                        }
                        console.log(json);
                        chart_2 = new Highcharts.Chart(json);
                        
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
   
   
   $("#send_current_revoked_1").live("click", function(){
       var message = $("#message_1").val();
      var sender = {};
      sender.deny = true;
       sender.message = message;
       sender.id = campaign_id;
       var send = "json=" + JSON.stringify(sender);
             $.ajax({
                    url: "/ad_approval/revoke_current_ad/",
                    type: 'POST',
                    dataType: 'text',
                    data : send,
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        var json;
                        try{
                            json = JSON.parse(data);
                        }
                        catch(e){
                            console.log(e);
                            console.log(data);
                        }
                         
                        $("#approve_table tbody").html(json.table);
                        $('#revokeAdd_1').modal('hide');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
   });
   
   $("#send_current_revoked").live('click', function(){
       
      var message = $("#message").val();
      var sender = {};
       sender.message = message;
       sender.id = campaign_id;
       var send = "json=" + JSON.stringify(sender);
             $.ajax({
                    url: "/ad_approval/revoke_current_ad/",
                    type: 'POST',
                    dataType: 'text',
                    data : send,
                    beforeSend: function () {

                    },
                    success: function (data, textStatus, xhr) 
                    {
                        var json;
                        try{
                            json = JSON.parse(data);
                        }
                        catch(e){
                            console.log(e);
                            console.log(data);
                        }
                         
                        $("#current_table tbody").html(json.table);
                        $('#revokeAdd').modal('hide');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
      
      
   });
   
});

