<?php
$config = array(
  'url'=>'https://xxx.supportsystem.com/api/tickets.json',
	'key'=> '' // Put API key here
);
	
$data = array(
	'name'      	=>      $_POST['name'],
	'email'		=>      $_POST['email'],
  	'subject'	=>      $_POST['subject'],
  	'message'	=>      $_POST['message'],
  	'topicId'	=>      $_POST['topicId'],
  	'HubAM'		=>	$_POST['HubAM'],
	'HubSpouseId'	=>	$_POST['HubSpouseId'],
	'HubAddress'	=>	$_POST['HubAddress'],
	'HubBilling'	=>	$_POST['HubBilling'],
	'HubFrequency'	=>	$_POST['HubFrequency'],
	'HubAdditionalNotes'	=>	$_POST['HubAdditionalNotes'],
	'HubFidName'	=>	$_POST['HubFidName'],
	'HubTax'	=>	$_POST['HubTax'],
	'HubOffice'	=>	$_POST['HubOffice'],
	'HubRelationship'	=>	$_POST['HubRelationship'],
	'alert'		=>	$_POST['alert'],
	'HubAddForms'	=>	$_POST['HubAddForms'],
	'HubFidTitle'	=>	$_POST['HubFidTitle'],
	'HubDate'	=>	$_POST['HubDate'],
	'HubAmount'	=>	$_POST['HubAmount'],
	'HubEndDate'	=>	$_POST['HubEndDate'],
	'HubTaxAdvisor'	=>	$_POST['HubTaxAdvisor'],
	'HubTypeofClient'	=>	$_POST['HubTypeofClient'],
	'HubAccounting'	=>	$_POST['HubAccounting'],
	'HubLanguage'	=>	$_POST['HubLanguage'],
	'HubOther'	=>	$_POST['HubOther'],
	'HubContactName'	=>	$_POST['HubContactName'],
	'HubQuarterly'	=>	$_POST['HubQuarterly'],
	'HubTaxYear'	=>	$_POST['HubTaxYear'],
	'HubOwnerName'	=>	$_POST['HubOwnerName'],
	'HubServices'	=>	$_POST['HubServices'],
	'HubStateFilings'	=>	$_POST['HubStateFilings'],
	'HubCountry'	=>	$_POST['HubCountry'],
	'HubIdentifier'	=>	$_POST['HubIdentifier'],
	'HubServiceType'	=>	$_POST['HubServiceType'],
	'HubNameofReferrer'	=>	$_POST['HubNameofReferrer'],
	'HubContactNumber'	=>	$_POST['HubContactNumber'],
	'HubName'	=>	$_POST['HubName'],
	'HubFilingAs'	=>	$_POST['HubFilingAs'],
	'HubPartnerCountry'	=>	$_POST['HubPartnerCountry'],
	'HubForeignPartner'	=>	$_POST['HubForeignPartner'],
	'HubReferral'	=>	$_POST['HubReferral'],
	'HubSalesTax'	=>	$_POST['HubSalesTax'],
	'HubContactEmail'	=>	$_POST['HubContactEmail'],
	'HubSalesFrequency'	=>	$_POST['HubSalesFrequency'],
	'HubPartnership'	=>	$_POST['HubPartnership']
);
set_time_limit(30);
$options = array(
  'http' => array(
    'header'  => "X_API_Key: ".$config['key'],
    'method'  => 'POST',
		'content' => json_encode($data)
   )
);
$context  = stream_context_create($options);
$result = file_get_contents($config['url'], false, $context);
if ($result === FALSE) { die("FAILED"); }
echo($result);
?>
