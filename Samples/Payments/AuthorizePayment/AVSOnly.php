<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function AVSOnly()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	
  $authorizationOptionsArr = [
    "declineAvsFlags" => "N"
  ];
  $authorizationOptions = new CyberSource\Model\V2paymentsProcessingInformationAuthorizationOptions($authorizationOptionsArr);

  $processingInformationArr = [
    "authorizationOptions" => $authorizationOptions
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);

  $amountDetailsArr = [
    "totalAmount" => "2861",
    "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  $billtoArr = [
    "country" => "US",
    "firstName" => "RTS",
    "lastName" => "VDP",
    "address2" => "Desk M3-5573",
    "address1" => "901 Metro Center Blvd",
    "postalCode" => "48104",
    "locality" => "Foster City",
    "administrativeArea" => "CA",
    "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);
  $orderInfoArry = [
      'amountDetails' => $amountDetInfo,
      'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $paymentCardInfo = [
    "expirationYear" => "2031",
    "number" => "4111111111111111",
    "securityCode" => "123",
    "expirationMonth" => "12"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);
  $paymentInfoArr = [
      'card' => $card
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'deviceInformation' => $deviceInformation,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'processingInformation' => $processingInformation
  ];

	$paymentRequest = new CyberSource\Model\CreatePaymentRequest($paymentRequestArr);
	$api_response = list($response,$statusCode,$httpHeader)=null;
	try {
		$api_response = $api_instance->createPayment($paymentRequest);
		//echo "<pre>";print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	AVSOnly();

}
?>	
