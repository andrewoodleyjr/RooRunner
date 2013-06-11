$(document).ready(function(){
    

$("#email_sendEmail").live('click', function(){
var body = $("#email_mess").val();

if(body == ''){
    
        $("#email_alertMessage").text('You forgot to type a message in the field.');
        $("#email_alertMessage").attr('style', '');
        $("#email_successMessage").attr('style', 'display: none;');
        return;
}    
    

var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST","/manage/ajaxEmail/" ,false);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    xmlhttp.send("body=" + body );
    var emailed = xmlhttp.responseText;
    console.log(xmlhttp.responseText);
    if(emailed == 'true'){
        $("#email_successMessage").html('Your message has been sent.');
        $("#email_successMessage").css('display', 'block');
        $("#email_alertMessage").css('display', 'none');
        return;
    }
    else{
        $("#email_alertMessage").html(emailed);
        $("#email_alertMessage").css('display', 'block');
       $("#email_successMessage").attr('display', 'none');

        return;
    }
    
    });
    
    
    });
