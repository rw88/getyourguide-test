<?php
/**
 * A CURL Helper class
 */

namespace GetYourGuideTest\Helpers;

class CURLHelper {

  /**
     * CURL call helper
     * 
     * @param string $url - requested url
     * @param string $type - http content-type
     * @return string - curl response
     * @throws \RuntimeException
     */
  public function run($url, $type = 'application/json') {
    $ch = curl_init();

    curl_setopt($ch ,CURLOPT_HTTPHEADER, [
        'Content-Type: ' . $type
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $output = curl_exec($ch);

    curl_close($ch);
    
    if(empty($output)) {
        throw new \RuntimeException("Not response was returned from the URL: ". $url);
    }

    return $output;

  }


}
