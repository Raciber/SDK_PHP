<?php
    // Step 1: Require the library from your Composer vendor folder and add Dotenv
    require_once '../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    use MercadoPago\Client\Customer\CustomerCardClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;

    // Step 2: Set production or sandbox access token
    MercadoPagoConfig::setAccessToken($_ENV['ACCESS_TOKEN']);
    // Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
    // In case you want to test in your local machine first, set runtime enviroment to LOCAL
    MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

    // Step 3: Initialize the API client
    $clientCards = new CustomerCardClient();

    try {

        // Step 4: send id of customer and create of array with card_token
        $idCustomer = "1599577635-YeCqqXCSk8IHd1";

        $request = [
            "token" => "6258adeaa3296c10e3b274d6d3c1ec46",
        ];

        // Step 5: Make the request
        $cards = $clientCards->create($idCustomer,$request);
        print_r($cards->getResponse()->getContent());

    // Step 7: Handle exceptions
    } catch (MPApiException $e) {
        echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
        echo "Content: ";
        var_dump($e->getApiResponse()->getContent());
        echo "\n";
    } catch (\Exception $e) {
        echo $e->getMessage();
    }