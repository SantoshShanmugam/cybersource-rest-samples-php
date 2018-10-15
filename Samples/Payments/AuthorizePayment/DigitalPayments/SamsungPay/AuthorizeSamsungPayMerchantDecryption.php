<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function AuthorizeSamsungPayMerchantDecryption()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	$cliRefInfoArr = [
		"code" => "TC_MPOS_Paymentech_3"
	];
	$client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  
  $processingInformationArr = [
    "commerceIndicator" => "vbv",
    "paymentSolution" => "008"
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);

  $amountDetailsArr = [
    "totalAmount" => "100",
    "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);

  $billtoArr = [
    "country" => "US",
    "firstName" => "RTS",
    "lastName" => "VDP",
    "phoneNumber" => "6504327113",
    "address2" => "Desk M3-5573",
    "address1" => "901 Metro Center Blvd",
    "postalCode" => "94404",
    "locality" => "Foster City",
    "company" => "Visa",
    "administrativeArea" => "CA",
    "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);

  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $tokenizedCardArr = [
    "expirationYear" => "2031",
    "number" => "4111111111111111",
    "expirationMonth" => "12",
    "transactionType" => "1",
    "cryptogram" => "020000000000064e03599e02dbcc944000000000"
  ];
  $tokenizedCard = new CyberSource\Model\V2paymentsPaymentInformationTokenizedCard($fluidDataArr);
  $paymentInfoArr = [
      'tokenizedCard' => $tokenizedCard
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);
  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'processingInformation' => $processingInformation
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
	AuthorizeSamsungPayMerchantDecryption();

}

?>	
