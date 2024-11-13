<?php
require_once 'config.php';

$authUrl = GOOGLE_AUTH_URL . '?response_type=code&client_id=' . GOOGLE_CLIENT_ID . '&redirect_uri=' . urlencode(GOOGLE_REDIRECT_URL) . '&scope=email%20profile&access_type=online&prompt=select_account';

header('Location: ' . $authUrl);
exit();
?>