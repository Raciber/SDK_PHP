<?php
    // Step 1: Require the library from your Composer vendor folder and add Dotenv
    require_once '../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    use MercadoPago\Client\Preference\PreferenceClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;

    // Step 2: Set production or sandbox access token
    MercadoPagoConfig::setAccessToken($_ENV['ACCESS_TOKEN']);
    // Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
    // In case you want to test in your local machine first, set runtime enviroment to LOCAL
    MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

    // Step 3: Initialize the API client
    $client = new PreferenceClient();

    try {

        // Step 4: create array of preference
        $product0 = array(
            "id" => "1234",
            "title" => "Prueba",
            "quantity" => 1,
            "currency_id" => "MXN",
            "unit_price" => 100
        );

        $items = [
            $product0
        ];

        $paymentMethods = [
            "excluded_payment_methods" => [],
            "excluded_payment_types" => [],
            "installments" => 1,
        ];

        $backUrls = array(
            "success" => "https://test.com/success",
            "pending" => "https://test.com/pending",
            "failure" => "https://test.com/failure"
        );


        $request = [
            "items" => $items,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "MP_Prueba_WCS",
            "external_reference" => "1234567890",
            "expires" => true,
            "expiration_date_from" => "2025-03-13T00:00:00.000-06:00",
            "expiration_date_to" => "2025-03-13T16:40:00.000-06:00",
            "auto_return" => 'approved',
        ];
        
        // Step 5: Make the request
        $preference = $client->create($request);
        print_r($preference->getResponse()->getContent());

    // Step 7: Handle exceptions
    } catch (MPApiException $e) {
        echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
        echo "Content: ";
        var_dump($e->getApiResponse()->getContent());
        echo "\n";
    } catch (\Exception $e) {
        echo $e->getMessage();
    }