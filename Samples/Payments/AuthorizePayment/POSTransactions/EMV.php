<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function EMV()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	$cliRefInfoArr = [
		"code" => "123456"
	];
	$client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);


  $amountDetailsArr = [
    "totalAmount" => "100.00",
    "currency" => "usd"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);

  $billtoArr = [
    "country" => "US",
    "lastName" => "VDP",
    "address1" => "201 S. Division St.",
    "postalCode" => "48104-2201",
    "locality" => "Ann Arbor",
    "administrativeArea" => "MI",
    "firstName" => "RTS",
    "phoneNumber" => "999999999",
    "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);

  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);

  $emvArr = [
    "fallbackCondition" => "swiped",
    "fallback" => "Y"
  ];
  $emv = new CyberSource\Model\V2paymentsPointOfSaleInformationEmv($emvArr);

  $pointOfSaleInfoArr = [
    "cardPresent" => "Y",
    "catLevel" => "2",
    "emv" => $emv ,
    "terminalCapability" => "4"
  ];
  $pointOfSaleInformation = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInfoArr);

  $paymentCardInfo = [
    "expirationYear" => "2031",
    "number" => "372425119311008",
    "securityCode" => "123",
    "expirationMonth" => "12"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationTokenizedCard($paymentCardInfo);
  $fluidDataArr = [
   "value" => "%B373235387881007^SMITH/JOHN         ^31121019761100      00868000000?;373235387881007=31121019761186800000?"
  ];
  $fluidData = new CyberSource\Model\V2paymentsPaymentInformationCard($fluidDataArr);
  $paymentInfoArr = [
      'card' => $card,
      'fluidData' => $fluidData
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'pointOfSaleInformation' => $pointOfSaleInformation
  ];

	$paymentRequest = new CyberSource\Model\CreatePaymentRequest($paymentRequestArr);
  //echo "<pre>";print_r($paymentRequest);die;
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
	EMV();

}

?>	
