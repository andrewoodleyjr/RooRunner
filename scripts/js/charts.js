function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
$(document).ready(function(){
    var chart_1;
    var chart_2;
    var chart_3;
    var chart_4;
  
    $.ajax({
        url: "/charts/ajaxUserCharts/" ,
        dataType: 'text',
        beforeSend: function () {
        },
        success: function (data, textStatus, xhr) {
            var json;
            try
            {
                json = JSON.parse(JSON.parse(data));
 
            }
            catch(e)
            {
                console.log(e);
            }
            console.log(json);
            if(json.series.data > 0){
                var chart_3 = new Highcharts.Chart(json); 
            }
            else{
                //alert('No data was found.');
            	document.getElementById('alert_chart').style.display = "block";
   			
		
            }
            
        },
        error: function(x, t, m) {
            console.log(t);
            console.log(x);
            console.log(m);
        }
});
   
  
    $("#submit_users").live('click', function(){
        var send_object = {}; 
        send_object.group_by = $("#demoChange_users option:selected").val();
        send_object.start_date = $("#start_date_demo_1").val();
        send_object.end_date = $("#end_date_demo_1").val();
        send_object.filter_state = $("#campaign_state_charts_users option:selected").val();
        send_object.filter_city = $("#campaign_city_charts_users option:selected").val();
        send_object.filter_sex = $("#campaign_sex_charts_users option:selected").val();
        send_object.anonymous_options = $("#anonymous_options_users option:selected").val();
        send_object.phone_type = $("#phone_type_users option:selected").val();
        send_object.App_ID = $("#Apps_users option:selected").val();
        send_object.chart_by = $("#graph_by_users option:selected").val();

        var nocheck = true;
        var age_array = [];
        if($("#all_age_charts_users").attr('checked') !== 'checked'){
            if($("#year1_charts_users").attr("checked") === "checked"){
                var age1 = {};
                age1.min = '14';
                age1.max = '17';
                age_array.push(age1);
                nocheck = false;
            }
            if($("#year2_charts_users").attr("checked") === "checked"){
                var age2 = {};
                age2.min = '18';
                age2.max = '20';
                age_array.push(age2);
                nocheck = false;
            }
            if($("#year3_charts_users").attr("checked") === "checked"){
                var age3 = {};
                age3.min = '21';
                age3.max = '24';
                age_array.push(age3);
                nocheck = false; 
            }
            if($("#year4_charts_users").attr("checked") === "checked"){
                var age4 = {};
                age4.min = '25';
                age4.max = '29';
                age_array.push(age4);
                nocheck = false; 
            }
            if($("#year5_charts_users").attr("checked") === "checked"){
                var age5 = {};
                age5.min = '30';
                age5.max = '34';
                age_array.push(age5);
                nocheck = false;
            }
            if($("#year6_charts_users").attr("checked") === "checked"){
                var age6 = {};
                age6.min = '35';
                age6.max = '44';
                age_array.push(age6);
                nocheck = false; 
            }
            if($("#year7_charts_users").attr("checked") === "checked"){
                var age7 = {};
                age7.min = '45';
                age7.max = '54';
                age_array.push(age7);
                nocheck = false;
            }
            if($("#year8_charts_users").attr("checked") === "checked"){
                var age8 = {};
                age8.min = '55';
                age8.max = '63';
                age_array.push(age8);
                nocheck = false; 
            }
            if($("#year9_charts_users").attr("checked") === "checked"){
                var age9 = {};
                age9.min = '64';
                age9.max = '190';
                age_array.push(age9);
                nocheck = false;
            }
        }
 
 
 
        if(nocheck === false){
            send_object.age_filter = age_array;
        }
        else{
            send_object.age_filter = 'all';
        }
 
        var send = "json=" + JSON.stringify(send_object);
        $.ajax({
            url: "/charts/ajaxUserCharts/" ,
            dataType: 'text',
            type: "POST",
            data: send,
            beforeSend: function () {
            },
            success: function (data, textStatus, xhr) {

                var json;
                try
                {
                    json = JSON.parse(data);
 
                }
                catch(e)
                {
                    console.log(e);
                }
                var real_json = JSON.parse(json);
                if(typeof real_json.series[0].data !== 'undefined'){

                    if(real_json.series[0].data.length > 0){
                        
                      
                        var chart_3 = new Highcharts.Chart(real_json); 
                        console.log(real_json);
                    }
                    else{
                        //alert('No data was found.');
            	document.getElementById('alert_chart').style.display = "block"; 
                    }
                }
                else{
                    //alert('No data was found.');
            	document.getElementById('alert_chart').style.display = "block";
                }
 
 
 
            },
            error: function(x, t, m) {
                console.log(t);
                console.log(x);
                console.lgo(m);
            }
});

    });

 


    $("#app_users_startdate").datepicker({
        format: 'mm/dd/yyyy'
    });

    $("#app_users_enddate").datepicker({
        format: 'mm/dd/yyyy'
    });

   

   

 

 


});