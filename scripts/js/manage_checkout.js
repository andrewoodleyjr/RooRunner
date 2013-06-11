jQuery(document).ready(function(){
   
   
   jQuery("#submit_card").live("click", function(){
      var FIRST_NAME = jQuery("#FIRST_NAME").val();
      var LAST_NAME = jQuery("#LAST_NAME").val();
      var CARD_TYPE = jQuery("#CARD_TYPE option:selected").val();
      var CARD_NUMBER = jQuery("#CARD_NUMBER").val();
      var MONTH = jQuery("#MONTH option:selected").val();
      var YEAR = jQuery("#YEAR option:selected").val();
      var CVV2 = jQuery("#CVV2").val();
       
       
       function IsNumeric(val)  
       {  
                return !isNaN(parseFloat(val)) && isFinite(val);  
       }  
      
      if(FIRST_NAME === '' || LAST_NAME === '' || CARD_TYPE === '' || CARD_NUMBER === '' ||
          MONTH === '' || YEAR === '' || CVV2 === '' ){
          jQuery("#error_card").html("Please fill out the form completely.");
          jQuery("#error_card").show('fast');
          return false;
          }

          if(!IsNumeric(CARD_NUMBER)){
              jQuery("#error_card").html("Plese use only number for the card");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!(CARD_NUMBER.length === 16)){
              jQuery("#error_card").html("Your cards should only contain 16 numbers.");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!(CVV2.length === 4) && !(CVV2.length === 3)){
              jQuery("#error_card").html("Your cvv2 should only contain 3 or 4 numbers.");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!IsNumeric(CVV2)){
              jQuery("#error_card").html("Please use only numbers for the cvv2");
              jQuery("#error_card").show('fast');
              return false;
          }

      var send = "FIRST_NAME=" + FIRST_NAME + "&LAST_NAME=" + LAST_NAME + "&CARD_TYPE=" + CARD_TYPE +
              "&CARD_NUMBER=" + CARD_NUMBER + "&MONTH=" + MONTH + "&YEAR=" + YEAR + "&CVV2=" + CVV2;
        jQuery("#error_card").html("");
              jQuery("#error_card").hide('fast');


        jQuery.ajax({
        
                url: "/checkout/process",
                type: 'POST',
                dataType: 'text',
                data: send,
                beforeSend: function () {
                
                           jQuery("#error_card").hide('fast');

                jQuery.blockUI({
                    css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } 
                });

                },
                success: function (data, textStatus, xhr) 
                {
                    
              
                  var json;
                  try{
                      json = JSON.parse(data);
                  }
                  catch(e){
                      alert("Error processing your card please contact support.");
                      console.log(data);
                  }
                  
                  if(json.error === 'no'){
                     // window.location.replace("http://artists.shwcase.co/checkout/thankyou/" + json.order_id);
                   var loc =  "http://artists.shwcase.co/checkout/thankyou/" + json.order_id;
                   location.assign(loc);
                  }
                  else{
                    jQuery("#error_card").html(json.message);
                    jQuery("#error_card").show('fast');
                  }
                  
                jQuery.unblockUI({ fadeOut: 200 }); 

                }
        });
                return true;

      });
   
   
    jQuery("#change_app").live("click", function(){
      var FIRST_NAME = jQuery("#FIRST_NAME").val();
      var LAST_NAME = jQuery("#LAST_NAME").val();
      var CARD_TYPE = jQuery("#CARD_TYPE option:selected").val();
      var CARD_NUMBER = jQuery("#CARD_NUMBER").val();
      var MONTH = jQuery("#MONTH option:selected").val();
      var YEAR = jQuery("#YEAR option:selected").val();
      var CVV2 = jQuery("#CVV2").val();
       
       
       function IsNumeric(val)  
       {  
                return !isNaN(parseFloat(val)) && isFinite(val);  
       }  
      
      if(FIRST_NAME === '' || LAST_NAME === '' || CARD_TYPE === '' || CARD_NUMBER === '' ||
          MONTH === '' || YEAR === '' || CVV2 === '' ){
          jQuery("#error_card").html("Please fill out the form completely.");
          jQuery("#error_card").show('fast');
          return false;
          }

          if(!IsNumeric(CARD_NUMBER)){
              jQuery("#error_card").html("Plese use only number for the card");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!(CARD_NUMBER.length === 16)){
              jQuery("#error_card").html("Your cards should only contain 16 numbers.");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!(CVV2.length === 4) && !(CVV2.length === 3)){
              jQuery("#error_card").html("Your cvv2 should only contain 3 or 4 numbers.");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!IsNumeric(CVV2)){
              jQuery("#error_card").html("Please use only numbers for the cvv2");
              jQuery("#error_card").show('fast');
              return false;
          }

      var send = "FIRST_NAME=" + FIRST_NAME + "&LAST_NAME=" + LAST_NAME + "&CARD_TYPE=" + CARD_TYPE +
              "&CARD_NUMBER=" + CARD_NUMBER + "&MONTH=" + MONTH + "&YEAR=" + YEAR + "&CVV2=" + CVV2;
        jQuery("#error_card").html("");
              jQuery("#error_card").hide('fast');


        jQuery.ajax({
        
                url: "/app/payment_process",
                type: 'POST',
                dataType: 'text',
                data: send,
                beforeSend: function () {
                
                           jQuery("#error_card").hide('fast');

                jQuery.blockUI({
                    css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } 
                });

                },
                success: function (data, textStatus, xhr) 
                {
                    
              
                  var json;
                  try{
                      json = JSON.parse(data);
                  }
                  catch(e){
                      alert("Error processing your card please contact support.");
                      console.log(data);
                  }
                  
                  if(json.error === 'no'){
                     // window.location.replace("http://artists.shwcase.co/checkout/thankyou/" + json.order_id);
                   var loc =  "http://artists.shwcase.co/checkout/thankyou/" + json.order_id;
                   location.assign(loc);
                  }
                  else{
                    jQuery("#error_card").html(json.message);
                    jQuery("#error_card").show('fast');
                  }
                  
                jQuery.unblockUI({ fadeOut: 200 }); 

                }
        });
                return true;

      });
      
      
   jQuery("#subscription").live("click", function(){
      var FIRST_NAME = jQuery("#FIRST_NAME").val();
      var LAST_NAME = jQuery("#LAST_NAME").val();
      var CARD_TYPE = jQuery("#CARD_TYPE option:selected").val();
      var CARD_NUMBER = jQuery("#CARD_NUMBER").val();
      var MONTH = jQuery("#MONTH option:selected").val();
      var YEAR = jQuery("#YEAR option:selected").val();
      var CVV2 = jQuery("#CVV2").val();
       
       
       function IsNumeric(val)  
       {  
                return !isNaN(parseFloat(val)) && isFinite(val);  
       }  
      
      if(FIRST_NAME === '' || LAST_NAME === '' || CARD_TYPE === '' || CARD_NUMBER === '' ||
          MONTH === '' || YEAR === '' || CVV2 === '' ){
          jQuery("#error_card").html("Please fill out the form completely.");
          jQuery("#error_card").show('fast');
          return false;
          }

          if(!IsNumeric(CARD_NUMBER)){
              jQuery("#error_card").html("Plese use only number for the card");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!(CARD_NUMBER.length === 16)){
              jQuery("#error_card").html("Your cards should only contain 16 numbers.");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!(CVV2.length === 4) && !(CVV2.length === 3)){
              jQuery("#error_card").html("Your cvv2 should only contain 3 or 4 numbers.");
              jQuery("#error_card").show('fast');
              return false;
          }
          if(!IsNumeric(CVV2)){
              jQuery("#error_card").html("Please use only numbers for the cvv2");
              jQuery("#error_card").show('fast');
              return false;
          }

      var send = "FIRST_NAME=" + FIRST_NAME + "&LAST_NAME=" + LAST_NAME + "&CARD_TYPE=" + CARD_TYPE +
              "&CARD_NUMBER=" + CARD_NUMBER + "&MONTH=" + MONTH + "&YEAR=" + YEAR + "&CVV2=" + CVV2;
        jQuery("#error_card").html("");
              jQuery("#error_card").hide('fast');


        jQuery.ajax({
        
                url: "/app/processSubscription",
                type: 'POST',
                dataType: 'text',
                data: send,
                beforeSend: function () {
                
                           jQuery("#error_card").hide('fast');

                jQuery.blockUI({
                    css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } 
                });

                },
                success: function (data, textStatus, xhr) 
                {
                    
              
                  var json;
                  try{
                      json = JSON.parse(data);
                  }
                  catch(e){
                      alert("Error processing your card please contact support.");
                      console.log(data);
                  }
                  
                  if(json.error === 'no'){
                     // window.location.replace("http://artists.shwcase.co/checkout/thankyou/" + json.order_id);
                   var loc =  "http://artists.shwcase.co/checkout/thankyou/" + json.order_id;
                   location.assign(loc);
                  }
                  else{
                    jQuery("#error_card").html(json.message);
                    jQuery("#error_card").show('fast');
                  }
                  
                jQuery.unblockUI({ fadeOut: 200 }); 

                }
        });
                return true;

      });
   
   
});
