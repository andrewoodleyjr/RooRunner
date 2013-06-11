<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generalLibrary
 *
 * @author GOI LLC
 */
class general_library {

    
    public function __construct() {
        
    }
    
   public function getUserAppID($session)
    {
       try{
    $CI = & get_instance();
    $CI->db->where('artist_id', $session['userid']);
    $query_applications = $CI->db->get('applications');
    if($query_applications->num_rows != 1):
        throw new Exception("Sorry you don't have application anymore, please contact support if you would like to continue.");
        return false;
    endif;
    $result = $query_applications->result();
    return $result[0]->App_ID;
       }
       catch(Exception $e){
           
       }
    }
    
    public function isLoggedInCustomer(){
        
        $CI = & get_instance();

        $CI->load->library('session');
        $session =& $CI->session->all_userdata();
        
        if(!isset($session['logged_in']) || $session['logged_in'] != true):
            return false;
        endif;
        //customer_user
        if(!isset($session['type']) || !((strpos($session['type'], 'user') > -1 )
                || (strpos($session['type'], 'admin') > -1))):
            throw new Exception("You do not have access to the customer area, please sign up as a customer.");
            return false;
        endif;
     
        return $session;
    }
    
       public function send_appication($emailarr) {

            $CI = & get_instance();
            $CI->load->library('email');
            if(!isset($emailarr['from_email'])):
                $emailarr['from_email'] = 'noreply@shwcase.co';
            endif;
            if(!isset($emailarr['from_display'])):
                $emailarr['from_display'] = 'Shwcase';
            endif;
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
            
            $this->email->attach($emailarr['path']);



            $email = $emailarr['email'];
            $CI->email->initialize($config);



            $subject = $emailarr['subject'];
            $message = $emailarr['message'];
            $CI->email->from(strtolower($emailarr['from_email']), $emailarr['from_display']);
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
    
    public function sendEmail($emailarr) {

            $CI = & get_instance();
            $CI->load->library('email');
            if(!isset($emailarr['from_email'])):
                $emailarr['from_email'] = 'noreply@justgoi.com';
            endif;
            if(!isset($emailarr['from_display'])):
                $emailarr['from_display'] = 'Shwcase';
            endif;
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

            $email = $emailarr['email'];
            $CI->email->initialize($config);



            $subject = $emailarr['subject'];
            //$message = $emailarr['message'];
			$message = $this->email_to_user($emailarr);
            $CI->email->from(strtolower($emailarr['from_email']), $emailarr['from_display']);
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
    
	
	    public function email_to_user($emailVariables) {
    	$email = "<html><head>
<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
<title>Email Template - Classic</title>
<style type='text/css'>
a:hover { text-decoration: underline !important; }
.issue p {font-size: 36px; font-family: Georgia, Times, serif; color: #ffffff; margin-top: 0px; margin-bottom: 0px; text-shadow: 1px 1px 1px #333;}
.title h1 { color: #333 !important; margin-top: 0px; margin-bottom: 0px; font-weight: normal; font-size: 48px; font-family: Georgia, Times, serif }
.date p { font-size: 24px; font-family: Georgia,  Times, serif; color: #ffffff; margin-top: 0px; margin-bottom: 0px;}
.content h1 { font-size: 24px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333333 !important; margin-top: 0px; margin-bottom: 12px;}
.content p { font-size: 16px; line-height: 22px; font-family: Georgia, Times, serif; color: #333; margin: 0px;}
.content a { color: #bc1f31; text-decoration: none;}
.address p {font-size: 14px; line-height: 24px; font-family: Georgia, Times, serif; color: #b0a08b; margin: 0px;}
</style>
</head>

<body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #f7f2e4;' bgcolor='#f7f2e4' leftmargin='0'>
<!--100% body table-->
<table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#f7f2e4'>
	<tbody><tr>
		<td>
			<!--top links-->
			<table width='100%' border='0' cellspacing='0' cellpadding='0'>
				<tbody><tr>
					<td valign='middle' align='center' height='45'>
						<p style='font-size: 14px; line-height: 24px; font-family: Georgia, ' times='' new='' roman',='' times,='' serif;='' color:='' #b0a08b;='' margin:='' 0px;'=''>
							Is this email not displaying correctly? <webversion style='color: #bc1f31; text-decoration: none;'>Try the web version.</webversion></p></td>
						</tr>
					</tbody></table>
					<!--header-->
					<table style=' background-repeat: no-repeat; background-position: center; background-color: #fffdf9;' width='684' border='0' align='center' cellpadding='0' cellspacing='0'>
						<tbody><tr>
							<td>
								<table width='100%' border='0' cellspacing='0' cellpadding='0'>
									<tbody><tr>
										<td valign='top' width='173'>
											<!--ribbon-->
											<table border='0' cellspacing='0' cellpadding='0'>
												<tbody><tr>
													<td height='120' width='45'></td>
													<td background='images/ribbon.jpg' valign='top' bgcolor='#c72439' height='120' width='80'>
														<table width='100%' border='0' cellspacing='0' cellpadding='0'>
															<tbody><tr>
																<td valign='bottom' align='center' height='35'>
																	<p style='font-size: 14px; font-family: Georgia, ' times='' new='' roman',='' times,='' serif;='' color:='' #ffffff;='' margin-top:='' 0px;='' margin-bottom:='' 0px;'=''>ISSUE</p>
																</td>
															</tr>
															<tr>
																<td valign='top' align='center' class='issue'>
																	<p><singleline label='Title'>31</singleline></p>
																</td>
															</tr>
														</tbody></table>
													</td>
												</tr>
											</tbody></table><!--ribbon-->
										</td>
										<td valign='middle' width='493'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
											<tbody><tr>
												<td height='60'></td>
											</tr>
											<tr>
												<td class='title'>
													
												</td>
											</tr>
											<tr>
												
											</tr>
										</tbody></table>
										<!--date-->
										<table border='0' cellspacing='0' cellpadding='0'>
											<tbody><tr>
												
											</tr>
										</tbody></table><!--/date-->
									</td>
									<td width='18'></td>
								</tr>
							</tbody></table>
						</td>
					</tr>
				</tbody></table><!--/header-->
				<!--email container-->
				<table bgcolor='#fffdf9' cellspacing='0' border='0' align='center' cellpadding='30' width='684'>
					<tbody><tr>
						<td>
							<!--email content-->
							<table cellspacing='0' border='0' id='email-content' cellpadding='0' width='624'>
								<tbody><tr>
									<td>
										<!--section 3-->
										<table cellspacing='0' border='0' cellpadding='0' width='100%'>
											<tbody><tr>
												<td class='content'>
													<!--line break-->
													<table cellspacing='0' border='0' cellpadding='0' width='100%'>
														</table><!--/line break-->
													<repeater>
														<table cellspacing='0' border='0' cellpadding='0' width='100%'>
															<tbody><tr>
																<td valign='top' width='378'>
																	<h1><singleline label='Title'>".$emailVariables['subject']."</singleline></h1>
																
																<multiline label='Description'><p>".$emailVariables['message']."</p></multiline>
																</td>
															</tr>
														</tbody></table>
														<!--line break-->
														<table width='100%' border='0' cellspacing='0' cellpadding='0'>
															<tbody><tr>
																<td valign='bottom' height='50'><img src='images/line-break.jpg' width='622' height='27'></td>
															</tr>
														</tbody></table><!--/line break-->
													</repeater>

													<table cellspacing='0' border='0' cellpadding='0' width='100%'>
														<tbody><tr>
															<td height='72'>
															</td>
														</tr>
													</tbody></table><!--/line break-->
												</td>
											</tr>
										</tbody></table><!--/section 3-->
									</td>
								</tr>
							</tbody></table><!--/email content-->
						</td>
					</tr>
				</tbody></table><!--/email container-->
				<!--footer-->
				<table width='680' border='0' align='center' cellpadding='30' cellspacing='0'>
					<tbody><tr>
						<td valign='top'>
							<p style='font-size: 14px; line-height: 24px; font-family: Georgia, ' times='' new='' roman',='' times,='' serif;='' color:='' #b0a08b;='' margin:='' 0px;'=''>
								<singleline label='Title'>You are receiving this email because sometime or another you requested service or sipped something and accidentally did so.</singleline><br></p>
							</td>
							<td valign='top' class='address' width='245'><multiline label='Description'><p>A. Woodley Jr. 315 10th Ave North #102A, Nashville, TN, 37203</p></multiline>
							</td>
						</tr>
						<tr>
							<td height='30'></td>
							<td height='30'></td>
						</tr>
					</tbody></table><!--/footer-->
				</td>
			</tr>
		</tbody></table><!--/100% body table-->

</body></html>";

return $email;
    }
	
    

    public function generate_key() {
        //generates a random key of letters and numbers
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $len = 6;
        $num_chars = strlen($chars);
        $ret = '';
        for ($i = 0; $i < $len; ++$i) {
            $ret .= $chars[mt_rand(0, $num_chars - 1)];
        }
        return $ret;
    }

    public function uploadpic($fileArray) {

        if (isset($fileArray['filename'], $fileArray['folder'], $fileArray['nameOfPostVariable'])):
//$fileArray['nameOfPostVariable']
//$fileArray['filename']
//$fileArray['folder']
//$fileArray['size']
//$fileArray['filetype']
//$fileArray['filename']
            

                if ($_FILES[$fileArray['nameOfPostVariable']]['error'] != 0):
                    throw new Exception("There was an error uploading the file." . $_FILES[$fileArray['nameOfPostVariable']]['error']);
                endif;
                $CI = & get_instance();
                if(!isset($fileArray['size'])):
                    $fileArray['size'] = 6000;
                endif;
                
                if(!isset($fileArray['filetype'])):
                    $fileArray['filetype'] = 'gif|jpg|png|jpeg';
                endif;
                
               
            $config = array();
            $config['upload_path'] =  $fileArray['folder'];
            $config['allowed_types'] = $fileArray['filetype'];
            $config['max_size'] = $fileArray['size'];
            $config['file_name'] = $fileArray['filename'];
            $config['overwrite'] = true;

            $CI->load->library('upload');
            $CI->upload->initialize($config);

            $uploaded = $CI->upload->do_upload($fileArray['nameOfPostVariable']);
            if ($uploaded):
                return $CI->upload->data();

            else:
                $error =  $CI->upload->display_errors('<p>', '</p>');
                throw new Exception($error);


            endif;
        else:

            throw new Exception("There was an error when uploading the file.");

        endif;
    }

}

?>
