<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function StandaloneCredit()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\CreditApi($apiclient);
	$cliRefInfoArr = [
    "code" => "TC12345"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $buyerInformationArr = [
    "merchantCustomerId" => "123456abcd"
  ];
  $buyerInformation = new CyberSource\Model\V2paymentsBuyerInformation($buyerInformationArr);

  $subMerchantArr = [
    "cardAcceptorId" => "1234567890",
    "country" => "US",
    "phoneNumber" => "650-432-0000",
    "address1" => "900 Metro Center",
    "postalCode" => "94404-2775",
    "locality" => "Foster City",
    "name" => "Visa Inc",
    "administrativeArea" => "CA",
    "region" => "PEN",
    "email" => "test@cybs.com"
  ];

  $subMerchant = new CyberSource\Model\V2paymentsAggregatorInformationSubMerchant($subMerchantArr);

  $aggregatorInformationArr = [
    "subMerchant" => $subMerchant,
    "name" => "V-Internatio",
    "aggregatorId" => "123456789"
  ];
  $aggregatorInformation = new CyberSource\Model\V2paymentsAggregatorInformation($aggregatorInformationArr);


  $merchantInformationArr = [
    "categoryCode" => "1234"
  ];
  $merchantInformation = new CyberSource\Model\V2paymentsMerchantInformation($merchantInformationArr);

  $shippingDetailsArr = [
      "shipFromPostalCode" => "47404"
    ];
  $shippingDetails = new CyberSource\Model\V2paymentsOrderInformationShippingDetails($shippingDetailsArr);

  $invoiceDetailsArr = [
      "purchaseOrderDate" => "20111231",
      "purchaseOrderNumber" => "CREDIT US"
  ];
  $invoiceDetails = new CyberSource\Model\V2paymentsOrderInformationInvoiceDetails($invoiceDetailsArr);

  $amountDetailsArr = [
      "totalAmount" => "100",
      "exchangeRate" => "0.5",
      "exchangeRateTimeStamp" => "2.01304E+13",
      "currency" => "usd"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);

  $billtoArr = [
    "country" => "US",
    "firstName" => "John",
    "lastName" => "Deo",
    "phoneNumber" => "9999999",
    "address2" => "test2credit",
    "address1" => "testcredit",
    "postalCode" => "48104-2201",
    "locality" => "Ann Arbor",
    "company" => "Visa",
    "administrativeArea" => "MI",
    "email" => "test2@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);
  $orderInfoArry = [
    "amountDetails" => $amountDetInfo,
    "billTo" => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $paymentCardInfo = [
    "expirationYear" => "2031",
    "number" => "5555555555554444",
    "securityCode" => "123",
    "expirationMonth" => "12",
    "type" => "002"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);
  $paymentInfoArr = [
      "card" => $card
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information,
    "aggregatorInformation" => $aggregatorInformation,
    "orderInformation" => $order_information,
    "paymentInformation" => $payment_information,
    "merchantInformation" => $merchantInformation
  ];

  $paymentRequest = new CyberSource\Model\CreateCreditRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->createCredit($paymentRequest);
		echo "<pre>";print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	StandaloneCredit();

}

?>	
