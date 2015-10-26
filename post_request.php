<?php
/**
 * Redirect with POST data.
 *
 *  param string $url URL.
 *  param array $post_data POST data. Example: array('foo' => 'var', 'id' => 123)
 *  param array $headers Optional. Extra headers to send.
 */
// By Eduardo Cuomo from http://stackoverflow.com/questions/5576619/php-redirect-with-post-data

function redirect_post($url, array $data, array $headers = null) 
{
    $params = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    if (!is_null($headers)) {
        $params['http']['header'] = '';
        foreach ($headers as $k => $v) {
            $params['http']['header'] .= "$k: $v\n";
        }
    }
    $ctx = stream_context_create($params);
    $fp = @fopen($url, 'rb', false, $ctx);
    if ($fp) {
        echo @stream_get_contents($fp);
        die();
    } else {
        // Error
        throw new Exception("Error loading '$url', $php_errormsg");
    }
}

?>