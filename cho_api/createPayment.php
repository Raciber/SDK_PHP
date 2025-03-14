<?php
    // Step 1: Require the library from your Composer vendor folder and add Dotenv
    require_once '../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    use MercadoPago\Client\Common\RequestOptions;
    use MercadoPago\Client\Payment\PaymentClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;

    // Step 2: Set production or sandbox access token
    MercadoPagoConfig::setAccessToken($_ENV['ACCESS_TOKEN']);
    // Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
    // In case you want to test in your local machine first, set runtime enviroment to LOCAL
    MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

    // Step 3: Initialize the API client
    $client = new PaymentClient();

    try {

        // Step 4: Create the request array
        $request = [
            "transaction_amount" => 100,
            "token" => "",
            "description" => "Prueba MP Raciber",
            "external_reference" => "MPRaciber0001",
            "installments" => 1,
            "payment_method_id" => "visa",
            "payer" => [
                "email" => "test_user_949857347@testuser.com",
            ]
        ];

        // Step 5: Create the request options, setting X-Idempotency-Key
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: "]);

        // Step 6: Make the request
        $payment = $client->create($request, $request_options);
        echo "Id MP: {$payment->id} - status: {$payment->status} - status_detail: {$payment->status_detail} \n";
        print_r($payment->getResponse()->getContent());

    // Step 7: Handle exceptions
    } catch (MPApiException $e) {
        echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
        echo "Content: ";
        var_dump($e->getApiResponse()->getContent());
        echo "\n";
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
