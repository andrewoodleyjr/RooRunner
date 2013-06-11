function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}






$(document).ready(function(){
   
    var startdate = $("#charts_start").val();
    var enddate = $("#charts_end").val();
    var send = "startDate=" + startdate + "&EndDate=" + enddate + "&app_name=all&Interval=day&Moving=none";
    
  
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'charts_chart',
			backgroundColor: null,//'#000',
            type: 'line',
            height: 500,
            spacingRight: 10,
            style: {
                fontFamily: 'serif'
            }
               
        },
        title: {
            text: 'Total Trends and Sales',
            x: -20, //center
            y: 60
        },
          
        xAxis: {
            title: {
                text: 'Dates'
            },
            tickPixelInterval: 90  ,
            style: {
                color: '#6D869F',
                fontWeight: 'bold',
                margin: '40px'
               
            },
            labels : {
                step: 5
            },
            offset: 10

            


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
        yAxis: {
            title: {
                text: 'Application Statistics'
            },
            offset: 20,
            min: 0

        },
        tooltip: {
            formatter: function() {
                var sign = '';
                if(this.series.name == 'Sales' || this.series.name == 'MAS') { 
                    sign = '$';
                    this.y = this.y.toFixed(2);
                }
                return '<b>'+ this.series.name +'</b><br/>Dates: '+
                this.x +' <br />'+  sign + this.y ;
            }
        },
        legend: {
            layout: 'horizontal',
            y: 5,
            borderWidth: 1
        }

    });
    $.ajax({
                url: "/charts/ajaxGetDataChart/",
                type: 'POST',
                dataType: 'text',
                data : send,
                beforeSend: function () {
                             chart.showLoading("Loading Chart");

                },
                success: function (data, textStatus, xhr) {
                     
            if(!IsJsonString(data)){
                alert("Error loading chart please refresh page");
                chart.hideLoading();
                console.log(json);
                return;
            }
            
            
                    var   json = JSON.parse(data);
            console.log(json);
            if(typeof(json.sales != 'undefined') ){
              var  sales = {
                    'name' : 'Sales', 
                    'data' : json.sales
                    };
                chart.addSeries(sales);
            }
            if(typeof(json.downloads != 'undefined')){
             var   downloads = {
                    'name' : 'Downloads', 
                    'data' : json.downloads
                    }
                chart.addSeries(downloads);
            }

            if(typeof(json.downloads != 'undefined')){
             var   push = {
                    'name' : 'Push Notifications', 
                    'data': json.pushNotifications
                    }
                chart.addSeries(push);
            }
            if(typeof(json.category != 'undefined')){
                            chart.xAxis[0].setCategories(json.category);
                 }
            var destroy = Math.floor(json.category.length/5);
            chart.xAxis[0].labels = {
                step: destroy
            };
            
            chart.hideLoading();
            chart.redraw();           
            return;
        },
        error: function(x, t, m) {
        if(t==="timeout") {
            alert("got timeout");
        } else {
            alert(t);
        }
        }
        });
   
  
    
   
    $("#charts_startdate").datepicker({
        format: 'mm/dd/yyyy'
    });
    $("#charts_enddate").datepicker({
        format: 'mm/dd/yyyy'
    });
    $("#charts_interval").live('change', function(){
        if($(this).val() == 'Day'){
            $("#charts_moving_average").removeAttr('disabled');
        }
        else{
            $("#charts_moving_average").attr('disabled', 'disabled');
            $("#charts_moving_average").prop('selectedIndex',0);
        }
    }) 
   
    $("#charts_submit").live('click', function(){
      
        var interval = $("#charts_interval").val();
        var app_name = $("#charts_App_Name").val();
        var moving_average = $("#charts_moving_average").val();
        var startdateNew = $("#charts_start").val();
        var enddateNew = $("#charts_end").val();
        var send = '';
        if(interval != 'day'){
            send = "startDate=" + startdateNew + "&EndDate=" + enddateNew + "&app_name=" + app_name + "&Interval=" + interval +"&Moving=" + moving_average;
        }
        else{
            send = "startDate=" + startdateNew + "&EndDate=" + enddateNew + "&app_name=" + app_name + "&Interval=" + interval +"&Moving=none" ;          
        }
        $.ajax({
                    url: "/charts/ajaxGetDataChart/",
                    type: 'POST',
                    dataType: 'text',
                    data : send,
                    beforeSend: function () {
                                 chart.showLoading("Loading Chart");

                    },
                    success: function (data, textStatus, xhr) {

                if(!IsJsonString(data)  || !typeof(data === 'object')){
                    alert("Error loading chart please refresh page");
                    chart.hideLoading();
                    console.log(data);
                    return;
                }
                           json = JSON.parse(data);
                while(chart.series.length > 0){
                    chart.series[0].remove();
                }
  
                if(typeof(json.sales != 'undefined') ){
                    sales = {
                        'name' : 'Sales', 
                        'data' : json.sales
                        };
                    chart.addSeries(sales);
                }
                if(typeof(json.downloads != 'undefined')){
                    downloads = {
                        'name' : 'Downloads', 
                        'data' : json.downloads
                        }
                    chart.addSeries(downloads);
                }
                if(typeof(json.downloads != 'undefined')){
                    push = {
                        'name' : 'Push Notifications', 
                        'data': json.pushNotifications
                        }
                    chart.addSeries(push);
                }
                if(typeof(json.category != 'undefined')){
                    chart.xAxis[0].setCategories(json.category);
                }
                if(json.MovingAverageSales){
        
                    movingAverageSale = {
                        'name': 'MAS', 
                        'data' : json.MovingAverageSales
                        };
                    chart.addSeries(movingAverageSale);
                }
                if(json.MovingAverageDownloads){
                    MovingAverageDownloads = {
                        'name': 'MAD', 
                        'data' : json.MovingAverageDownloads
                        };
                    chart.addSeries(MovingAverageDownloads);
                }
                if(json.MovingAveragePush){
                    MovingAveragePush = {
                        'name': 'MAP', 
                        'data' : json.MovingAveragePush
                        };
                    chart.addSeries(MovingAveragePush);
                }
    
                if(app_name != 'all')
                {        
                    chart.setTitle({
                        text: app_name + " : Trends and Sales"
                        });
                }
                else
                {
                    chart.setTitle({
                        text: "Total Trends and Sales"
                    });
                }
            var destroy = Math.floor(json.category.length/5);
            chart.xAxis[0].labels = {
                step: destroy
            };
                chart.hideLoading();
                chart.redraw();
                return;
                    }

            });
    
   
    });
   
});