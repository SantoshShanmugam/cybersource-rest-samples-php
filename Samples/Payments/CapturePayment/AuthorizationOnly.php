<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function AuthorizationOnly()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\CaptureApi($apiclient);
  $id = "5332058267566110304101";
	$cliRefInfoArr = [
		'code' => '1234567890'
	];
	$client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);
	$pointOfSaleInfoArr = [
    "cardPresent" => "false",
    "catLevel" => "6",
    "terminalCapability" => "4"  
  ];

  $ponitOfSaleInfo = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInfoArr);
 
  $amountDetailsArr = [
      "totalAmount" => "100.00",
      "currency" => "USD"
    ];
  $amountDetInfo = new CyberSource\Model\V2paymentsidcapturesOrderInformationAmountDetails($amountDetailsArr);
  $billtoArr = [
      "country" => "US",
      "firstName" => "RTS",
      "lastName" => "VDP",
      "address1" => "901 Metro Center Blvd",
      "postalCode" => "40500",
      "locality" => "Foster City",
      "administrativeArea" => "CA",
      "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsidcapturesOrderInformationBillTo($billtoArr);
  $orderInfoArry = [
      'amountDetails' => $amountDetInfo,
      'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsidcapturesOrderInformation($orderInfoArry);
  $paymentCardInfo = [
      'number' => '4111111111111111',
      'expiration_month' => '12',
      'expiration_year' => '2031',
      'security_code' => '123'
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);
  $paymentInfoArr = [
      'card' => $card
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $captureRequest = [
    'clientReferenceInformation' => $client_reference_information,
    'pointOfSaleInformation' => $ponitOfSaleInfo,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information
  ];

	$captureRequest = new CyberSource\Model\Request4($captureRequest);
	$api_response = list($response,$statusCode,$httpHeader)=null;
	try {
		$api_response = $api_instance->capturePayment($captureRequest, $id);
		echo "<pre>";print_r($api_response);

	} catch (Exception $e) {
		print_r($e);
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	AuthorizationOnly();

}
?>	
