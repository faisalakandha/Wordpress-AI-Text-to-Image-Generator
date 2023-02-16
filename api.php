<?php

add_action('rest_api_init', function () {

    register_rest_route('imggenerator/v1', 'imggenerated', array(
        'methods' => 'POST',
        'callback' => 'sendimggeneratorData',
        'args' => array(),
        'permission_callback' => 'IsUserAdmin'
    ));
});

function GetApiEndpoint($option)
{
    $endpoint = '';
    switch ($option) {
        case 'panda':
          $endpoint = 'https://{IP_ADDRESS}/api/cute-creature-generator';
          break;
        case 'flower':
          $endpoint = 'https://{IP_ADDRESS}/api/abstract-painting-generator';
          break;
        case 'contemporary':
          $endpoint = 'https://{IP_ADDRESS}/api/contemporary-architecture-generator';
          break;
        case 'surreal':
          $endpoint = 'https://{IP_ADDRESS}/api/surreal-graphics-generator';
          break; 
        case 'oldStyle':
          $endpoint = 'https://{IP_ADDRESS}/api/old-style-generator';
          break; 
        case 'fantasy':
          $endpoint = 'https://{IP_ADDRESS}/api/fantasy-world-generator';
          break; 
        case '3dObjectGenerator':
          $endpoint = 'https://{IP_ADDRESS}/api/3d-objects-generator';
          break;       
        default:
          $endpoint = 'https://{IP_ADDRESS}/api/text2img';
      }

    return $endpoint;
}


function sendimggeneratorData($req)
{
    $parameters = $req->get_params();
    $imgtext = $parameters["imgtext"];
    $option = $parameters["king"];

    $ch = curl_init();
    $endpoint = GetApiEndpoint($option);
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'text' => $imgtext,
    ]);

    $headers = array();
    $headers[] = "api-key: {$apiKey}";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $res_json = json_decode($result);

    return $res_json->output_url;
}

function IsUserAdmin($request) 
{ 
    return current_user_can('manage_options');
}


?>
