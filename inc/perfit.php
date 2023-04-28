<?php

$perfit = new PerfitSDK\Perfit( ['apiKey' => PERFIT_APY_KEY_B3H ] );
$listId = PERFIT_LIST_B3H;

var_dump($url);
var_dump($origin);exit;

if (!isset($name)) {
  $name = '';
}

if (!isset($origin)) {
  $origin = 'Ecommerce';
}

if (!isset($phone)) {
  $phone = '-';
}

$userPerfit = $perfit->get('/contacts/' .$email); // BUSCAR usuario

if (!$userPerfit->success) { // Si no se encuentra en la base de datos cargarlo
  $response = $perfit->post('/lists/' .$listId. '/contacts', 
    [
      'firstName' => $name, 
      'email' => $email,
      'customFields' => 
        [
          [
            'id' => 10, 
            'value' => $origin
          ],
          [
            'id' => 11, 
            'value' => $phone
          ]
        ]
    ]
  );
}

?>