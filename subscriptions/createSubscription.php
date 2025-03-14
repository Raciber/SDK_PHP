<?php
    // Step 1: Require the library from your Composer vendor folder and add Dotenv
    require_once '../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    use MercadoPago\Client\PreApproval\PreApprovalClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;

    // Step 2: Set production or sandbox access token
    MercadoPagoConfig::setAccessToken($_ENV['ACCESS_TOKEN']);
    // Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
    // In case you want to test in your local machine first, set runtime enviroment to LOCAL
    MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

    // Step 3: Initialize the API client
    $client = new PreApprovalClient();

    try {

        // Step 4: send data
        $autoRecurring = array(
            "frequency" => 1,
            "frequency_type" => "months",
            "start_date" => "2025-01-01T00:00:00.000-06:00",
            "end_date" => "2025-12-01T00:00:00.000-06:00",
            "transaction_amount" => 500,
            "currency_id" => "MXN",
        );

        $request = [
            "auto_recurring" => $autoRecurring,
            "back_url" => "https://www.yoursite.com",
            "external_reference" => "Internet-1234",
            "payer_email" => "test_user_949857347@testuser.com",
            "reason" => "Servicio de internet",
            "status" => "pending"
        ];
        
        // Step 5: Make the request
        $plan = $client->create($request);
        print_r($plan->getResponse()->getContent());

    // Step 7: Handle exceptions
    } catch (MPApiException $e) {
        echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
        echo "Content: ";
        var_dump($e->getApiResponse()->getContent());
        echo "\n";
    } catch (\Exception $e) {
        echo $e->getMessage();
    }