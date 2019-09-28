<?php

namespace App\Helpers\APIHelpers;

use GuzzleHttp\Client;
 
class LingvoAPI {

	public static $app_key = "MDgyNWNhNzAtMmM5ZC00NGRiLWI5MjMtZGQ4NTg0ODZiNjcxOjNlZGQ0ZGUyNDFmMDRmYmViZWRkMzRmYjdlMThmNTE1";

    public static $germanLang = 1031;
    public static $russianLang = 1049;



	public static function getToken() {
		$client = new Client();
        $res = $client->request('POST', 'https://developers.lingvolive.com/api/v1.1/authenticate/', 
        	[
                'headers' => [
                       'Content-type' => 'application/x-www-form-urlencoded\r\n',
                        'Authorization'     => 'Basic '.self::$app_key
                ]
        ]);

        return $res->getBody();
	}


	public static function getFullWords($prefix, $srcLang, $dstLang, $wordsNum, $token) {

		$client = new Client();
        $res = $client->get('https://developers.lingvolive.com/api/v1/WordList'.'?'.'prefix='.$prefix.'&'.'srcLang='.$srcLang.'&'.'dstLang='.$dstLang.'&'.'pageSize='.$wordsNum, 
        	[
                'headers' => [
                       'Content-type' => 'application/x-www-form-urlencoded\r\n',
                        'Authorization'     => 'Bearer '.$token
                ]
        ]);


        if ($res->getStatusCode() == 200) {
        	$result = json_decode($res->getBody()->getContents(), true);

            $resultArr = array('status' => 200);
		    foreach ($result['Headings'] as $key) {
		    	$resultArr['content']['words'][] = array('word' => $key['Heading'], 'translation' => $key['Translation']);
		    }
            
            if (isset($result['HasNextPage'])) {
			    $resultArr['tooManyWords'] = true;
		    }
		    else {
		    	$resultArr['tooManyWords'] = false;
		    }
        }
        else {
        	return '{"status":'.$res->getStatusCode().'}';
        }

		return $resultArr;
    }
}