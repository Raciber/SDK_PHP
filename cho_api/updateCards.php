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

        // Step 4: send Id_customer, card_id and array request of data for update.
        $idCustomer = "1599577635-YeCqqXCSk8IHd1";
        $idCard = "9384663428";

        $request = [
            "cardholder" => [
                "name" => "APRO",
            ]
        ];

        // Step 5: Make the request
        $cards = $clientCards->update($idCustomer,$idCard,$request);
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