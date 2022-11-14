<?php

add_action('rest_api_init', function () {

    register_rest_route('imggenerator/v1', 'imggenerated', array(
        'methods' => 'POST',
        'callback' => 'sendimggeneratorData',
        'args' => array(),
        'permission_callback' => '__return_true'
    ));
});


function sendimggeneratorData($req)
{
    $apiKey = "d3f8930c-ddfb-49d8-b55e-a0f5a5d49f16";
    $parameters = $req->get_params();
    $imgtext = $parameters['imgtext'];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.deepai.org/api/text2img');
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


?>