<?php

namespace App\Helpers\APIHelpers;

use Illuminate\Support\Arr;
use GuzzleHttp\Client;
use App\Helpers\_Arr;
 
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

    public static function getWordCard($word, $srcLang, $token) {
        $client = new Client();
        $res = $client->get('https://developers.lingvolive.com/api/v1/WordForms'.'?'.'text='.$word.'&'.'lang='.$srcLang, 
            [
                'headers' => [
                       'Content-type' => 'application/x-www-form-urlencoded\r\n',
                        'Authorization'     => 'Bearer '.$token
                ]
        ]);
        
        // Make an array from the guzzle response object
        $resArr = json_decode($res->getBody(), true);

        // Take only exact matches from the array of words (first letter is uppercase)
        $result = Arr::where($resArr, function($value, $key) use ($word) {
            return $value['Lexem'] == $word;
        });
        

        $result = _Arr::sortByPriority($result, 'PartOfSpeech', [
                                                    'Verb' => 4, 
                                                    'Substantiv' => 3, 
                                                    'Adjektiv' => 2, 
                                                    'Adverb' => 1]
                                                );
        $result = self::formatRequestCard($result[0]);

        $translates = self::getTranslate($result['morpheme'], self::$germanLang, self::$russianLang, $token);

        $result = Arr::add($result, 'translate', $translates);

        return $result;
    }

    public static function getTranslate($word, $srcLang, $dstLang, $token) {
        $client = new Client();
        $res = $client->get('https://developers.lingvolive.com/api/v1/Minicard'.'?'.'text='.$word.'&'.'srcLang='.$srcLang.'&'.'dstLang='.$dstLang,
            [
                'headers' => [
                       'Content-type' => 'application/x-www-form-urlencoded\r\n',
                        'Authorization'     => 'Bearer '.$token
                ]
        ]);

        $result = $res->getBody();
        $result = json_decode($res->getBody(), true);
        $result = preg_split("/[,|;]+\s/", $result['Translation']['Translation']);

        return $result;
    }

    public static function formatWordType($wordArr) {
        if ($wordArr['PartOfSpeech']=='Verb') {
            return 'verb';
        }
        elseif ($wordArr['PartOfSpeech']=='Substantiv') {
            return 'noun';
        }
        elseif ($wordArr['PartOfSpeech']=='Adjektiv') {
            return 'adjective';
        }
        else {
            return 'other';
        }
    }

    public static function formatPartizipModalVerb($wordArr) {
        if ($wordArr['ParadigmJson']['Groups'][2]['Table'][0][0]['Prefix']=="ich bin " || $wordArr['ParadigmJson']['Groups'][2]['Table'][0][0]['Prefix']=="ich habe (bin) ") {
            return 'sein';
        }
        else {
            return 'haben';
        }
    }

    public static function formatPrasensForm($wordArr) {
        if ($wordArr['ParadigmJson']['Groups'][0]['Table'][2][0]['Value']) {
            return $wordArr['ParadigmJson']['Groups'][0]['Table'][2][0]['Value'];
        }
    }

    public static function formatPrateritumForm($wordArr) {
        if ($wordArr['ParadigmJson']['Groups'][1]['Table'][2][0]['Value']) {
            return $wordArr['ParadigmJson']['Groups'][1]['Table'][2][0]['Value'];
        }
    }

    public static function formatPartizipForm($wordArr) {
        if ($wordArr['ParadigmJson']['Groups'][2]['Table'][0][0]['Value']) {
            return $wordArr['ParadigmJson']['Groups'][2]['Table'][0][0]['Value'];
        }
    }

    public static function formatArticleType($wordArr) {
        $wordOptions = explode(", ", $wordArr['ParadigmJson']['Grammar']);
        $articleType = Arr::last($wordOptions);
        if ($articleType == 'Maskulinum') {
            return 'der';
        }
        elseif ($articleType == 'Femininum') {
            return 'die';
        }
        elseif ($articleType == 'Neutrum') {
            return 'das';
        }
        elseif ($articleType == 'Plural') {
            return 'die_plural';
        }
    }

    public static function formatPluralForm($wordArr) {
        return (!empty($wordArr['ParadigmJson']['Groups'][0]['Table'][1][2]['Value'])) ? $wordArr['ParadigmJson']['Groups'][0]['Table'][1][2]['Value'] : null;
    }

    public static function formatRequestCard($wordArr) {
        $result['morpheme'] = $wordArr['Lexem'];
        $result['word_type'] = self::formatWordType($wordArr);

        if ($result['word_type']=='verb') {
            $result['modal_verb'] = self::formatPartizipModalVerb($wordArr);
            $result['regularity'] = 'irregular';
            $result['prasens'] = self::formatPrasensForm($wordArr);
            $result['prateritum'] = self::formatPrateritumForm($wordArr);
            $result['partizip'] = self::formatPartizipForm($wordArr);
        }
        elseif ($result['word_type']=='noun') {
            $result['article_type'] = self::formatArticleType($wordArr);
            $result['plural'] = self::formatPluralForm($wordArr);
        }
        return $result;
    }
}