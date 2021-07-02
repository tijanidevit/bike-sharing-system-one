<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('generate_id')) {
    function generate_id($length = 6)
    {
        $charset = '123456789';
        $randStringLen = $length;
        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        return $randString;
    }
}
if (!function_exists('encrypt')) {
    function encrypt($string)
    {
        $secret_key = '4n9*^%%$3n^&4v&%7@!90&$$3c3x$^*$m8a456#@tgf%$$c';
        $secret_iv = 'cXpYEjhvzuVXOV7ltEQSAq8dvNQTWLar';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        return $output;
    }
}

if (!function_exists('decrypt')) {
    function decrypt($string)
    {
        $secret_key = '4n9*^%%$3n^&4v&%7@!90&$$3c3x$^*$m8a456#@tgf%$$c';
        $secret_iv = 'cXpYEjhvzuVXOV7ltEQSAq8dvNQTWLar';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

        return $output;
    }
}


if (!function_exists('shaPassword')) {
    function shaPassword($field = "", $salt = "")
    {
        if ($field) {
            return hash('sha256', $field . $salt);
        }
    }
}

if (!function_exists('invite_url')) {
    function invite_url($id)
    {
        $url = "https://friconn.com/invite/" . $id;
        return $url;
    }
}


if (!function_exists('urlify')) {
    function urlify($id)
    {
        $token = $id.generate_id();
        $param = array(
            "url" => base_url("account/password/reset/" . $token),
            "token" => $token
        );

        return $param;
    }
}


if (!function_exists('create_url_slug')) {
    function create_url_slug($title)
    {
        $new_title = substr($title, 0, 70) . "-" . generate_id();
        return $new_title;
    }
}

if (!function_exists('plushrs')) {
    function plushrs($dt, $hrs)
    {
        $pure = strtotime($dt);
        $plus = ($pure + 60 * 60 * $hrs);
        $newPure = date('Y-m-d H:i:s', $plus);
        return $newPure;
    }
}

if (!function_exists('test_and_replace_foul_words')) {
    function test_and_replace_foul_words($text_content)
    {
        $formated_text = $text_content;
        $foul_words    = array('mad' => array('word' => "mad", "replacement" => "m*d"), 'shit' => array('word' => "shit", "replacement" => "sh*t"), 'crazy' => array('word' => "crazy", "replacement" => "cr*zy"), 'insane' => array('word' => "insane", "replacement" => "ins*ne"), 'fuck' => array('word' => "fuck", "replacement" => "f*ck"), 'nigga' => array('word' => "nigga", "replacement" => "n*gga"), 'bitch' => array('word' => "bitch", "replacement" => "b*tch"), 'stupid' => array('word' => "stupid", "replacement" => "st*pid"), 'fool' => array('word' => "fool", "replacement" => "f**l"), 'mad' => array('word' => "mad", "replacement" => "m*d"), 'bastard' => array('word' => "bastard", "replacement" => "b*stard"));

        foreach ($foul_words as $foul_word) {
            $formated_text = str_replace($foul_word['word'], $foul_word['replacement'], $formated_text);
        }
        return $formated_text;
    }
}

if (!function_exists('get_cloudinary_details')) {
    function get_cloudinary_details()
    {
        //return array("cloud_name" => "ismailobadimu", "api_key" => "341793831973628", "api_secret" => "3Ts_6QnJ9KyE1TsaHwf5W5gLjUc");
        return array("cloud_name" => "lewa", "api_key" => "266546296533642", "api_secret" => "M6yRhDSfn6Kh6pkgsRfHutuZHAw");
    }
}


if (!function_exists('get_response_status_code')) {
    function get_response_status_code()
    {
        return [
            'ok' => 200,
            'created' => 201,
            'badRequest' => 400,
            'unauthorized' => 401,
            'forbidden' => 403,
            'notFound' => 404,
            'methodNotAllowed' => 405,
            'conflict' => 409,
            'lengthRequired' => 411,
            'internalServerError' => 500,
            'serviceUnavailable' => 503
        ];
    }
}
if (!function_exists('send_HTML_email')) {
    function send_HTML_email($_this, $subject, $message, $to)
    {
        $_this->load->library('email');
        /* 
			@Description HTML Email Sender
		*/
        // Support Email Here
        $supportEmail = "obadimuismailidowu@gmail.com";
        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
			<title>' . html_escape($subject) . '</title>
			<style type="text/css">
			body {
				font-family: Arial, Verdana, Helvetica, sans-serif;
				font-size: 16px;
			}
			</style>
			</head>
			<body>
			<div class="container">
			' . $message . '
			</div>
			</body>
			</html>';

        // Attaching the logo first.
        //$file_logo = FCPATH.'apple-touch-icon-precomposed.png';  // Change the path accordingly.
        // The last additional parameter is set to true in order
        // the image (logo) to appear inline, within the message text:
        //$_this->email->attach($file_logo, 'inline', null, '', true);
        //$cid_logo = $_this->email->get_attachment_cid($file_logo);
        //$body = str_replace('cid:logo_src', 'cid:'.$cid_logo, $body);
        // End attaching the logo.

        try {
            $result = $_this->email
                ->from($supportEmail, $subject)
                ->reply_to($supportEmail)    // Optional, an account where a human being reads.
                ->to($to)
                ->subject($subject)
                ->message($body)
                ->send();

            return $result;
        } catch (\Throwable $th) {
            return false;
        }
        //echo $this->email->print_debugger();

        exit;
    }
}
