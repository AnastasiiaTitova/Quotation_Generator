<?php
function getDomainAndProtocol()
    {
        if ( isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        $host = $_SERVER['HTTP_HOST'];
        return $protocol.$host;
    }
    
    define('UPLOAD_DIR', 'images/');
	$img = $_POST['imgBase64'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$success = file_put_contents($file, $data);
	if ($success)
	{
	    $response = array(
            'success' => true,
            'link' => getDomainAndProtocol() . '/' . $file);
	}
	else
	{
	    $response = array(
            'success' => false,
            'error' => 'Unable to save image');
	}
	echo json_encode($response);
?>