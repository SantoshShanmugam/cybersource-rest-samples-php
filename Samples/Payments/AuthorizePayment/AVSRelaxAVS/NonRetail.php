<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function NonRetail()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	
	$cliRefInfoArr = [
    "code" => "TC1102345"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $deviceInfoArr = [
    "hostName" => "cybersource.com",
    "ipAddress" => "66.185.179.2" 
  ];

  $deviceInformation = new CyberSource\Model\V2paymentsDeviceInformation($deviceInfoArr);

  $authorizationOptionsArr = [
    "ignoreAvsResult" => "Y",
    "ignoreCvResult" => "N"
  ];
  $authorizationOptions = new CyberSource\Model\V2paymentsProcessingInformationAuthorizationOptions($authorizationOptionsArr);

  $processingInformationArr = [
    "authorizationOptions" => $authorizationOptions
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);

  $idArr = [
    "id" => "123* 4sÆ"
  ];
  $id[] = new CyberSource\Model\V2paymentsBuyerInformationPersonalIdentification($idArr);

  $personalIdentificationArr = [
    "personalIdentification" => $id
  ];
  $buyerInformation = new CyberSource\Model\V2paymentsBuyerInformation($personalIdentificationArr);
  
  $billtoArr = [
    "country" => "US",
    "lastName" => "Deo",
    "address2" => "test",
    "address1" => "201 S. Division St.",
    "postalCode" => "48104-2201",
    "locality" => "Ann Arbor",
    "administrativeArea" => "MI",
    "firstName" => "John",
    "phoneNumber" => "999999999",
    "district" => "MI",
    "buildingNumber" => "123",
    "company" => "Visa",
    "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);
  $amountDetailsArr = [
    "totalAmount" => "2401",
    "currency" => "usd"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $paymentCardInfo = [
    "expirationYear" => "2031",
    "number" => "372425119311008",
    "securityCode" => "1111",
    "expirationMonth" => "12",
    "type" => "003",
    "securityCodeIndicator" => "1"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);
  $paymentInfoArr = [
      'card' => $card
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'deviceInformation' => $deviceInformation,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'buyerInformation' => $buyerInformation,
    'processingInformation' => $processingInformation
  ];

  $paymentRequest = new CyberSource\Model\CreatePaymentRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->createPayment($paymentRequest);
		print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	NonRetail();

}

?>	
