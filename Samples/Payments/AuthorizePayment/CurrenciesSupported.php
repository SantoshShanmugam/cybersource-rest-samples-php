<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function CurrenciesSupported()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	$cliRefInfoArr = [
    'code' => '1234567890'
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $pointOfSaleInfoArr = [
    "cardPresent" => "false",
    "catLevel" => "6",
    "terminalCapability" => "4"  
  ];

  $pointOfSaleInformation = new CyberSource\Model\V2paymentsPointOfSaleInformation($pointOfSaleInfoArr);

  $amountDetailsArr = [
    "totalAmount" => "100.00",
    "currency" => "INR"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
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
    'clientReferenceInformation' => $client_reference_information,
    'pointOfSaleInformation' => $pointOfSaleInformation,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information
  ];

  $paymentRequest = new CyberSource\Model\CreatePaymentRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->createPayment($paymentRequest, $id);
		//echo "<pre>";print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	CurrenciesSupported();

}

?>	
