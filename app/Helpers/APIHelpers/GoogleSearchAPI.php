<?php

namespace App\Helpers\APIHelpers;

use GuzzleHttp\Client;
 
class GoogleSearchAPI {

	public static $serverKey = "AIzaSyC_pAIQXLFc-SpJpSZKQOhkWhWFusTOMWM";
    public static $searchId = "013870468293562395903:fi-3encgckk";


	public static function getPictures($word, $photosNum, $serverKey, $searchId) {
        $client = new Client();
        $res = $client->get('https://www.googleapis.com/customsearch/v1'.'?'.'key='.$serverKey.'&'.'cx='.$searchId.'&'.'q='.$word.'&searchType=image&fileType=jpg&imgSize=medium&alt=json');


        if ($res->getStatusCode() == 200) {
            $result = json_decode($res->getBody()->getContents(), true);

            $resultArr = array('status' => 200);
            foreach ($result['items'] as $value) {
                $resultArr['content']['images'][] = array('imageUrl' => $value['link'], 'thumbnailUrl' => $value['image']['thumbnailLink']);
            }
            return $resultArr;
        }
        else {
            return '{"status":'.$res->getStatusCode().'}';
        }
    }
}