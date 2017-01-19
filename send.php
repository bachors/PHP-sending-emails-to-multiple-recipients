<?php

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	$result = array();
	if (!empty($_POST['to']) && !empty($_POST['subject']) && !empty($_POST['type']) && !empty($_POST['compose']) && isset($_POST['cc']) && isset($_POST['bcc'])) {
		if (filter_var($_POST['to'], FILTER_VALIDATE_EMAIL)) {
			
/* ############################ Sample with PHP mail(); #############################
# http://php.net/manual/en/function.mail.php

			# message header
			$headers = "From: " . $_POST['to'] . "\r\n";
			if(!empty($_POST['cc'])){
				$headers .= "CC: " . $_POST['cc'] . "\r\n";
			}
			if(!empty($_POST['bcc'])){
				$headers .= "BCC: " . $_POST['bcc'] . "\r\n";
			}
			if($_POST['type'] == 'html') {
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			}
			
			# send message
			if(mail($_POST['to'], $_POST['subject'], $_POST['compose'], $headers)) {
				$result['status'] = 'success';
			} else {
				$result['status'] = 'error';
			}
			
####################################################################################*/
			
/* ######################## Sample with codeigniter email library ################### 
# https://www.codeigniter.com/user_guide/libraries/email.html

			# config SMTP
			$config['protocol'] 	= 'smtp';
			$config['smtp_host'] 	= 'mail.host.com';
			$config['smtp_port'] 	= 123;
			$config['smtp_crypto']	= 'tls';
			$config['smtp_user'] 	= 'me@host.com';
			$config['smtp_pass'] 	= 'xxxxxxx';
			if($_POST['type'] == 'html'){
				$config['mailtype'] 	= 'html';
				$config['charset'] 		= 'iso-8859-1';
			}
			$this->load->library('email', $config);
			
			# message header
			$this->email->from('me@ibacor.com', 'iBacor');
			$this->email->to($_POST['to']);
			if(!empty($_POST['cc'])){
				$this->email->cc($_POST['cc']);
			}
			if(!empty($_POST['bcc'])){
				$this->email->bcc($_POST['bcc']);
			}
			$this->email->subject($_POST['subject']);
			$this->email->message($_POST['compose']);
			if($_POST['type'] == 'html'){
				$this->email->set_mailtype("html");
			}
			
			# send message
			if($this->email->send()) {
				$result['status'] = 'success';
			} else {
				$result['status'] = 'error';
			}
			
####################################################################################*/
			
/* ################################ Sample with PHPMailer ###########################
# https://github.com/PHPMailer/PHPMailer

			# config SMTP
			require 'PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->isSMTP(); 
			$mail->Host = 'smtp1.example.com;smtp2.example.com';
			$mail->SMTPAuth = true;         
			$mail->Username = 'user@example.com';  
			$mail->Password = 'secret';         
			$mail->SMTPSecure = 'tls';      
			$mail->Port = 587;           
			
			# message header
			$mail->setFrom('me@ibacor.com', 'iBacor');
			$mail->addReplyTo($_POST['to']);
			if(!empty($_POST['cc'])){
				$mail->addCC($_POST['cc']);
			}
			if(!empty($_POST['bcc'])){
				$mail->addBCC($_POST['bcc']);
			}
			if($_POST['type'] == 'html'){
				$mail->isHTML(true);                           
			}
			$mail->Subject = $_POST['subject'];
			if($_POST['type'] == 'html'){
				$mail->Body    = $_POST['compose'];
			}else{
				$mail->AltBody = $_POST['compose'];
			}
			
			# send message
			if(!$mail->send()) {
				$result['status'] = 'success';
			} else {
				$result['status'] = 'error';
			}
			
####################################################################################*/
			
			$result['status'] = 'success';
		} else {
			$result['status'] = 'error';
			$result['message'] = 'Email not valid.';
		}
		$result['to'] = $_POST['to'];
		$result['cc'] = $_POST['cc'];
		$result['bcc'] = $_POST['bcc'];
		$result['subject'] = $_POST['subject'];
		$result['type'] = $_POST['type'];
		$result['compose'] = $_POST['compose'];
	} else {
		$result['status'] = 'error';
		$result['message'] = 'Form input not empty.';
	}
	header('Content-Type: application/json');
	echo json_encode($result, JSON_PRETTY_PRINT);
}