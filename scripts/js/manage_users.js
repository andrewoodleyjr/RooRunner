$(document).ready(function(){
    
    
    
        var chart;
        $("#message_push").html("");
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'demoChart',
                backgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
			title: {
				style: {
					color: '#666',
					fontWeight: 'light'
				}
			},
            tooltip: {
            	formatter: function() {
                            return '<b>'+ this.point.name +'</b><br />Percentage: '+ this.percentage.toFixed(1) +' %' + '<br />Total: ' +
                            this.point.y;
                        },
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#666',
                        connectorColor: '#666',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(1) +' %';
                        }
                    }
                }
            },
             loading: {
            hideDuration: 1000,
            showDuration: 1000,
            labelStyle: {
            },
            style: {
                background: 'url(/images/ajaxloader.gif) no-repeat center'

            }
        },
            series : [{
                    type: 'pie',
                    data: {}
            }]
       
        });
        
        
    $.ajax({
                url: "/app/ajax_updateUser/age/",
                type: 'GET',
                dataType: 'text',
                beforeSend: function () {
                
                chart.showLoading("Loading Chart");

                },
                success: function (data, textStatus, xhr) 
                {

                var chartInfo = JSON.parse(data);
                if(chartInfo.plot.data.length > 0){
                chart.series[0].setData(chartInfo.plot.data);
                chart.setTitle({"text" : chartInfo.title});
                }
                else{
                   $("#demoChart").html("<div class='alert alert-danger'>No Data for: " + chartInfo.title + "</div>")
                }
                chart.hideLoading();
                chart.redraw();  
                
                }
                
        });
    
    $("#submit_demo").live('click', function(){
    
        var option = $("#demoChange option:selected").text()
        var App_ID = $("#App_ID").val();
    
        $.ajax({
                url: "/app/ajax_updateUser/" + option + '/' + App_ID,
                type: 'GET',
                dataType: 'text',
                beforeSend: function () {
                
                chart.showLoading("Loading Chart");

                },
                success: function (data, textStatus, xhr) 
                {
                  if(IsJsonString(data)){
                      
                var chartInfo = JSON.parse(data);
                 if(chartInfo.plot.data.length > 0){
                     
                 console.log(chartInfo.plot.data)
                chart.series[0].setData(chartInfo.plot.data);
                chart.setTitle({"text" : chartInfo.title});
                 }
                else{
                    
                   $("#demoChart").html("<div class='alert alert-danger'>No Data for: " + chartInfo.title + "</div>")
                }
                chart.hideLoading();
                chart.redraw(); 
                  }
                  else{
                      alert(data);
                  } 
                }
                
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
    $("#submit_push").live('click', function(){
    
    var email = $("#email").is(':checked');
    var message =  $("#message_textarea").val();
    var data = 'message=' + message + '&email=';
    
    if(email === true){
        data += 'send';
    }
    else{
        data += 'no_send';
    }
    data += "&App_ID=" + $("#App_ID").val();
    
            $.ajax({
                url: "/app/ajax_sendPushEmail/",
                type: 'POST',
                data: data,
                dataType: 'text',
                beforeSend: function () {
                
                $("#success_message").hide();
                $("#error_message").hide();
				$("#loading").show();
                },
                success: function (data, textStatus, xhr) 
                {
                  if(IsJsonString(data)){
                       var info = JSON.parse(data);
                       if(info.error == 'yes'){
                           $("#error_message").css("display", "block");
                           $("#success_message").css("display", 'none');
                           $("#error_message").html(info.message);
                           $("#success_message").html("");
                       }
                       else{
                           $("#success_message").css("display", "block");
                           $("#error_message").css("display", 'none');
                           $("#success_message").html(info.message);
                           $("#error_message").html("");  
                       }
                  }
                  else{
                       $("#error_message").html(info.message);
                           $("#error_message").html(data);  
                  }
                }
                
        });



    });



});