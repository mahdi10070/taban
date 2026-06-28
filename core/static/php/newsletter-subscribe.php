<?php
/*
Name: 			Newsletter Subscribe
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	8.0.0
*/

include('./mailchimp/mailchimp.php'); 

use \DrewM\MailChimp\MailChimp;

if (isset($_POST['email'])) {
	$email = $_POST['email'];
} else if (isset($_GET['email'])) {
	$email = $_GET['email'];
} else {
	$email = '';
}

$MailChimp = new MailChimp($apiKey);

$result = $MailChimp->post('lists/' . $listId . '/members', array(
	'email_address' => $email,
	'merge_fields'  => array('FNAME'=>'', 'LNAME'=>''), // Step 3 (Optional) - Vars - More Information - http://kb.mailchimp.com/merge-tags/using/getting-started-with-merge-tags
	'status' 		=> 'subscribed'
));

if ($result['id'] != '') {
	$arrResult = array('response'=>'success');	
} else {
	$arrResult = array('response'=>'error','message'=>$result['detail']);
}

echo json_encode($arrResult);