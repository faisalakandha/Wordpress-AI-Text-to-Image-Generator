<?php

add_action('rest_api_init', function () {

    register_rest_route('imggenerator/v1', 'imggenerated', array(
        'methods' => 'POST',
        'callback' => 'sendimggeneratorData',
        'args' => array(),
        'permission_callback' => '__return_true'
    ));
});

function GetApiEndpoint($option)
{
    $endpoint = '';
    switch ($option) {
        case 'panda':
          $endpoint = 'https://api.deepai.org/api/cute-creature-generator';
          break;
        case 'flower':
          $endpoint = 'https://api.deepai.org/api/abstract-painting-generator';
          break;
        case 'contemporary':
          $endpoint = 'https://api.deepai.org/api/contemporary-architecture-generator';
          break;
        case 'surreal':
          $endpoint = 'https://api.deepai.org/api/surreal-graphics-generator';
          break; 
        case 'oldStyle':
          $endpoint = 'https://api.deepai.org/api/old-style-generator';
          break; 
        case 'fantasy':
          $endpoint = 'https://api.deepai.org/api/fantasy-world-generator';
          break; 
        case '3dObjectGenerator':
          $endpoint = 'https://api.deepai.org/api/3d-objects-generator';
          break;       
        default:
          $endpoint = 'https://api.deepai.org/api/text2img';
      }

    return $endpoint;
}


function sendimggeneratorData($req)
{
    $apiKey = "d3f8930c-ddfb-49d8-b55e-a0f5a5d49f16";
    $parameters = $req->get_params();
    $imgtext = $parameters["imgtext"];
    $option = $parameters["option"];

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
    // return $parameters["imgtext"];
}


?>