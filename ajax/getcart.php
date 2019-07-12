<?
/*$apiKey = 'NlyWhj5TzJ1N4UD1C0r7dkg2rM3c1qndxZ6ueOGsRZM8l5l8kSiaa7tvpYMvCxQxpSfJgt1aMGoJfNp56nZDOaK3MePDcxKX5jTFLwEdV6eNEQIOrvxhXAZaxPe1OsUCdshLYjCLNihBzHzRJgO7qwpG6yXoIaLJ5ts5OJRd3YgzzpwxSuzlHLS02VSCxFXiJDCbjrMSLllcJ3ejANbi6wLMegHMGzU2nWM2VokC68h8lBjXMMKpKHUpMGgRYtSG';
//$apiKey = 'dzL3oaoqLHXCT3ZEyS4u3in3urBrUAD1kLagTFihrKN8D1XUQewGsxSOSWzibnWs4F414PPxmMuDD';

$curl = curl_init( 'http://bom.ru/index.php?route=api/login' );

$post = array (
    'key' => $apiKey
);

curl_setopt_array( $curl, array(
    CURLOPT_RETURNTRANSFER=> TRUE,
    CURLOPT_POSTFIELDS      => $post
) );

$response = json_decode(curl_exec( $curl ));
curl_close($curl);
if (isset($response->token)) {
    $token = $response->token;
    print_r($token);

} else {
    // errors handler
     var_dump($response);
}
print_r('http://bom.ru/index.php?route=api/cart/products/&token=' . $token);
$curl = curl_init( 'http://bom.ru/index.php?route=api/cart/products/&token=' . $token );

$post = array (

);

curl_setopt_array( $curl, array(
    CURLOPT_RETURNTRANSFER=> TRUE,
    CURLOPT_POSTFIELDS      => $post
) );

$response = json_decode(curl_exec( $curl ));
print_R($response);
curl_close($curl);*/
$curl = curl_init( 'http://bom.ru/index.php?route=checkout/cart/' );

$post = array (

);

curl_setopt_array( $curl, array(
    CURLOPT_RETURNTRANSFER=> TRUE,
    CURLOPT_POSTFIELDS      => $post
) );

$response = curl_exec( $curl );
print_R($response);

?>