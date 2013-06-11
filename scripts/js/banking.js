$(document).ready(function(){
 
   $("#banking_history_startdate").datepicker({
        format: 'mm/dd/yyyy'
    });
    $("#banking_history_enddate").datepicker({
        format: 'mm/dd/yyyy'
    });
   
   $("#banking_invoice_modalbuyingpushcredits").submit(function(){
      
       if ($('input[name=sales_item_id]:checked').length) {
           
           
           // at least one of the radio buttons was checked
           return true; // allow whatever action would normally happen to continue
      }
      else {
            alert("Please select a push notification.")
            return false; // stop whatever action would normally happen
      }
      
   });
var htable  =   $('.dTables').dataTable( {
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		}
	} );
   
   
   $("#banking_invoice_ajaxInvoiceTable").live("click", function(){
      var month = $("#banking_invoice_month").val();
      var year = $("#banking_invoice_year").val();
      if(year == '' || isNaN(year) || month == '' || isNaN(month)){
          alert("Month and date month be set");
          return;
      }
      var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];

      var send = "month=" + month + "&year=" + year;
      
       $.ajax({
                    url: "/banking/invoice_table/",
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
                            alert(data);
                        }
                        $("table#banking_invoice_table tbody").html(json.table);
                        var date = monthNames[month - 1] + ", " + year;
                        $("#banking_invoice_invoicedate").text(date);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
    
   });
   
    
      $("#banking_history_ajaxhistorychange").live("click", function(){
      var startdate = $("#banking_history_startdatejs").val();
      var endDate = $("#banking_history_enddatejs").val();
      if(endDate == '' ||  startdate == '' ){
          alert("Month and date month be set");
          return;
      }
      var send = "startdate=" + startdate + "&enddate=" + endDate;
       $.ajax({
                    url: "/banking/getHistoryTable/",
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
                        catch(e)
                        {
                            alert(data);
                        }
                        htable.fnClearTable();
                        htable.fnAddData(json.table);
                        htable.fnDraw();
                     },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                    alert(XMLHttpRequest.responseText);
                    }

       });
    
   });
   
});