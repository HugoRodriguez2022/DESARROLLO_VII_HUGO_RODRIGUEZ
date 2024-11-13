<?php
require_once 'config.php';
session_start();

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $token = getToken($code);
    $userInfo = getUserInfo($token['access_token']);
    
    $_SESSION['user'] = $userInfo;
    header('Location: index.php');
    exit();
}

function getToken($code) {
    $params = [
        'code' => $code,
        'client_id' => GOOGLE_CLIENT_ID,
        'client_secret' => GOOGLE_CLIENT_SECRET,
        'redirect_uri' => GOOGLE_REDIRECT_URL,
        'grant_type' => 'authorization_code'
    ];

    $ch = curl_init(GOOGLE_TOKEN_URL);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

function getUserInfo($accessToken) {
    $ch = curl_init(GOOGLE_USER_INFO_URL . '?access_token=' . $accessToken);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
?>
