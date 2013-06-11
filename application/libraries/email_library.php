<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class email_library {
            public function sendEmail($subject, $message, $email) {

            $CI = & get_instance();
            $CI->load->library('email');
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'mail.justgoi.com',
                'validation' => TRUE,
                'smtp_timeout' => 30,
                'smtp_port' => 26,
                'smtp_user' => 'test@justgoi.com', // your email
                'smtp_pass' => '$;9c_EDUu~{G', // your email password
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );

            $CI->email->initialize($config);



            $CI->email->from('noreply@shwcase.co', 'Shwcase');
            $CI->email->to(strtolower($email));

            $CI->email->subject($subject);
            $CI->email->message($message);


            $emial = $CI->email->send(); //returns true if the email was sent
            if ($emial):
                return true;
            else:
                throw new Exception("Email was not sent");

            endif;
       
    }
    
    
    public function registerEmail($message, $link, $user_first_name){
        return '<html>
	<head>
       <title>Shwcase</title>
    </head>

<body>
      <center>
      <!-- pseudo body table -->
      <table border="0" cellpadding="0" cellspacing="0" bgcolor="#000" background="http://shwcase.co/images/black.png" width="85%">
        <tbody>
          <tr>
           <td align="center"><br>
             <!-- wrapper table for email -->
             <table border="0" cellpadding="0" cellspacing="0" width="100%">
               <tbody>
                 <tr>
                  <td align="center">
                    
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
                         <td align="center"><img src="http://shwcase.co/images/header.png" height="40" width="85%" style="float:inherit;"></td>
                        </tr>
                     </table>

					<table cellpadding="0" cellspacing="0" bgcolor="#000" width="85%">
                      <tbody>
                        <tr>
                          <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0" width="90%">
                               <tbody>
                                 <tr>
                                  <td align="left">
                                  </td>
                                  <th align="left">
									<img src="http://shwcase.co/images/Logo.png" width="150">
                                    <p> 
                                    	<font style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size:16px; font-weight:lighter; font-weight: 100; margin-bottom: 0; color:#FFF;">
											Hey  ' .  $user_first_name . '.
                                            <br>
                                            <br>
'. $message .'                                            <br>
                                            <br>                                        
                                            <a href="'. $link . '">
                                            	<img src="http://shwcase.co/images/NewUserBtn.png" alt="Sign In" longdesc="http://shwcase.co">
                                            </a>
										</font>                                         
									</p>
                                    <br>
									<div align="center" style="width:100%; text-align:center">
										<p style="line-height:0px;"> 
                                        	<font style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size:12px; font-weight:lighter; font-weight: 100; margin-bottom: 0; color:#FFF; ">
                                            	Add Us On
                                            </font>
                                        </p>
                                        <a href="http://twitter.com/shwcase">
                                        	<img src="http://justgoi.com/img/twitter.png" width="25" style="width:25px; height:25px;">
                                        </a>
                                        <a href="http://instagram.com/shwcase/">
                                        	<img src="http://justgoi.com/img/instagram.png" width="26" style="width:26px; height:26px;">
                                        </a>
                                        <a href="https://www.facebook.com/pages/Shwcase/">
                                        	<img src="http://justgoi.com/img/facebook.png" width="25" style="width:25px; height:25px;">
                                        </a>
									</div>
                                   </th>
                                 </tr>
                                </tbody>
                               </table></td>
                        </tr>
                      </tbody>
                     </table>
                         
                         <table width="100%" style="margin-bottom:0px !important;" border="0" cellpadding="0" cellspacing="0" >
                          <tbody>
                           <tr>
                            <td align="center" height="40">
                             <img src="http://shwcase.co/images/footer.png" height="40" width="85%"></td>
                           </tr>
                          </tbody>
                         </table>

				   </td>
                 </tr>
               </tbody>
             </table>
                                                                <!-- closed wrapper table -->
                                                                <table border="0" cellpadding="0" cellspacing="0" width="500px">
                                                                                        <tbody>
                                                                                                                                        <tr>
                                                                                                                                        <td align="center">
                                                <p style="color:#FFF; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size:10px ">
                                                                Please do not reply to this message.<br>
                                                                This message is a service email related to your use with Shwcase.
                                                                For general inquiries or support request with your Shwcase account, please <a href="mailto:contact@shwcase.co" style="color:#DC615A">Contact Us</a>.
                                                                <br>
                                                                <br>
Product of Music City:  
<br><a href="">315 #102 10th Ave N, Nashville, TN 37203</a>
<br>
<br>
                                                                </p>
                                                            </td>                                                
                                                                                            </tr>
                                                                                        </tbody>
                                                </table>

            </td></tr>
                                                    </tbody>
                                                </table>
                                               

   	</center>                                            
</body>
</html>';
    }
    
    public function regularEmail($user_first_name, $message){
        
        return '<html>
	<head>
       <title>Shwcase</title>
    </head>

<body>
      <center>
      <!-- pseudo body table -->
      <table border="0" cellpadding="0" cellspacing="0" bgcolor="#000" background="http://shwcase.co/images/black.png" width="85%">
        <tbody>
          <tr>
           <td align="center"><br>
             <!-- wrapper table for email -->
             <table border="0" cellpadding="0" cellspacing="0" width="100%">
               <tbody>
                 <tr>
                  <td align="center">
                    
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
                         <td align="center"><img src="http://shwcase.co/images/header.png" height="40" width="85%" style="float:inherit;"></td>
                        </tr>
                     </table>

					<table cellpadding="0" cellspacing="0" bgcolor="#000" width="85%">
                      <tbody>
                        <tr>
                          <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0" width="90%">
                               <tbody>
                                 <tr>
                                  <td align="left">
                                  </td>
                                  <th align="left">
									<img src="http://shwcase.co/images/Logo.png" width="150">
                                    <p> 
                                    	<font style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size:16px; font-weight:lighter; font-weight: 100; margin-bottom: 0; color:#FFF;">
											Hey ' .  $user_first_name . '.
                                            <br>
                                            <br>
'. $message . '                                            <br>
                                            <br>                                        
                                            <a href="http://artists.shwcase.co">
                                            	<img src="http://shwcase.co/images/RegularBtn.png" alt="Sign In" longdesc="http://shwcase.co">
                                            </a>
										</font>                                         
									</p>
                                    <br>
									<div align="center" style="width:100%; text-align:center">
										<p style="line-height:0px;"> 
                                        	<font style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size:12px; font-weight:lighter; font-weight: 100; margin-bottom: 0; color:#FFF; ">
                                            	Add Us On
                                            </font>
                                        </p>
                                        <a href="http://twitter.com/shwcase">
                                        	<img src="http://justgoi.com/img/twitter.png" width="25" style="width:25px; height:25px;">
                                        </a>
                                        <a href="http://instagram.com/shwcase/">
                                        	<img src="http://justgoi.com/img/instagram.png" width="26" style="width:26px; height:26px;">
                                        </a>
                                        <a href="https://www.facebook.com/pages/Shwcase/">
                                        	<img src="http://justgoi.com/img/facebook.png" width="25" style="width:25px; height:25px;">
                                        </a>
									</div>
                                   </th>
                                 </tr>
                                </tbody>
                               </table></td>
                        </tr>
                      </tbody>
                     </table>
                         
                         <table width="100%" style="margin-bottom:0px !important;" border="0" cellpadding="0" cellspacing="0" >
                          <tbody>
                           <tr>
                            <td align="center" height="40">
                             <img src="http://shwcase.co/images/footer.png" height="40" width="85%"></td>
                           </tr>
                          </tbody>
                         </table>

				   </td>
                 </tr>
               </tbody>
             </table>
                                                                <!-- closed wrapper table -->
                                                                <table border="0" cellpadding="0" cellspacing="0" width="500px">
                                                                                        <tbody>
                                                                                                                                        <tr>
                                                                                                                                        <td align="center">
                                                <p style="color:#FFF; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size:10px ">
                                                                Please do not reply to this message.<br>
                                                                This message is a service email related to your use with Shwcase.
                                                                For general inquiries or support request with your Shwcase account, please <a href="mailto:contact@shwcase.co" style="color:#DC615A">Contact Us</a>.
                                                                <br>
                                                                                                                               <br>
Product of Music City:  
<br><a href="">315 #102 10th Ave N, Nashville, TN 37203</a>
<br>
<br>
                                                                
                                                                </p>
                                                            </td>                                                
                                                                                            </tr>
                                                                                        </tbody>
                                                </table>

            </td></tr>
                                                    </tbody>
                                                </table>
                                               

   	</center>                                            
</body>
</html>';
    }
}

?>