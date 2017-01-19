# PHP-sending-emails-to-multiple-recipients
PHP sending emails to multiple recipients with AJAX (client side).

<h3>Sample PHP sending email:</h3>
<h4><a href="http://php.net/manual/en/function.mail.php">PHP mail()</a></h4>
<pre># message header
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
}</pre>

<h4><a href="https://www.codeigniter.com/user_guide/libraries/email.html">Codeigniter email library</a></h4>
<pre># config SMTP
$config['protocol']     = 'smtp';
$config['smtp_host']     = 'mail.host.com';
$config['smtp_port']     = 123;
$config['smtp_crypto']    = 'tls';
$config['smtp_user']     = 'me@host.com';
$config['smtp_pass']     = 'xxxxxxx';
if($_POST['type'] == 'html'){
    $config['mailtype']     = 'html';
    $config['charset']         = 'iso-8859-1';
}
$this-&gt;load-&gt;library('email', $config);

# message header
$this-&gt;email-&gt;from('me@ibacor.com', 'iBacor');
$this-&gt;email-&gt;to($_POST['to']);
if(!empty($_POST['cc'])){
    $this-&gt;email-&gt;cc($_POST['cc']);
}
if(!empty($_POST['bcc'])){
    $this-&gt;email-&gt;bcc($_POST['bcc']);
}
$this-&gt;email-&gt;subject($_POST['subject']);
$this-&gt;email-&gt;message($_POST['compose']);
if($_POST['type'] == 'html'){
    $this-&gt;email-&gt;set_mailtype("html");
}

# send message
if($this-&gt;email-&gt;send()) {
    $result['status'] = 'success';
} else {
    $result['status'] = 'error';
}</pre>

<h4><a href="https://github.com/PHPMailer/PHPMailer">PHPMailer</a></h4>
<pre># config SMTP
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail-&gt;isSMTP(); 
$mail-&gt;Host = 'smtp1.example.com;smtp2.example.com';
$mail-&gt;SMTPAuth = true;         
$mail-&gt;Username = 'user@example.com';  
$mail-&gt;Password = 'secret';         
$mail-&gt;SMTPSecure = 'tls';      
$mail-&gt;Port = 587;           

# message header
$mail-&gt;setFrom('me@ibacor.com', 'iBacor');
$mail-&gt;addReplyTo($_POST['to']);
if(!empty($_POST['cc'])){
    $mail-&gt;addCC($_POST['cc']);
}
if(!empty($_POST['bcc'])){
    $mail-&gt;addBCC($_POST['bcc']);
}
if($_POST['type'] == 'html'){
    $mail-&gt;isHTML(true);                           
}
$mail-&gt;Subject = $_POST['subject'];
if($_POST['type'] == 'html'){
    $mail-&gt;Body    = $_POST['compose'];
}else{
    $mail-&gt;AltBody = $_POST['compose'];
}

# send message
if(!$mail-&gt;send()) {
    $result['status'] = 'success';
} else {
    $result['status'] = 'error';
}</pre>

<h3>This form builth with:</h3>
- bootstrap
- fontawesome
- select2
- tinymce

<h3><a href="http://ibacor.com/email.php">LIVE DEMO</a></h3>
