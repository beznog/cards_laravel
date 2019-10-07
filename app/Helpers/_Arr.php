<?php

namespace App\Helpers;
 
class _Arr {

	public static function sortByPriority($arr, $keyName, $priorityValues) {

        usort($arr,function($a, $b) use ($keyName, $priorityValues) {
            if ($priorityValues[$a[$keyName]] == $priorityValues[$b[$keyName]]) {
                return 0;
            }
            return ($priorityValues[$a[$keyName]] == $priorityValues[$b[$keyName]]) ? -1 : 1;
        });

        return $arr;
    }
}