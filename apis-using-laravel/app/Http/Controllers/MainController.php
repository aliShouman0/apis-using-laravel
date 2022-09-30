<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //"eA2a1E" ➞ "aAeE12"
    // "Re4r" ➞ "erR4"
    // "6jnM31Q" ➞ "jMnQ136"
    // "846ZIbo" ➞ "bIoZ468"

    function sort($string)
    {


        $arr = str_split($string);
        $upperCase = array();
        $lowerCase = array();
        $nb = array();
        $res = array();
        sort($arr);
        for ($i = 0; $i < count($arr); $i++) {

            if ($arr[$i] >= 'a' && $arr[$i] <= 'z') {
                $lowerCase[] = $arr[$i];
            }

            if ($arr[$i] >= 'A' && $arr[$i] <= 'Z') {
                $upperCase[] = $arr[$i];
            }

            if (is_Numeric($arr[$i])) {
                $nb[] = $arr[$i];
            }
        }
        sort($upperCase);
        sort($lowerCase);

        $k = 0;
        for ($k = 0; $k < min(count($upperCase), count($lowerCase)); $k++) {

            if ($lowerCase[$k] > strtolower($upperCase[$k])) {
                $res[] = $upperCase[$k];
                $upperCase[$k] = "";
            }
            if ($lowerCase[$k] < strtolower($upperCase[$k])) {
                $res[] = $lowerCase[$k];
                $lowerCase[$k] = "";
            }
            if ($lowerCase[$k] == strtolower($upperCase[$k])) {
                $res[] = $lowerCase[$k];
                $res[] = $upperCase[$k];
                $lowerCase[$k] = "";
                $upperCase[$k] = "";
            }
        }
        $res[] = implode(array_slice($lowerCase, 0));
        $res[] = implode(array_slice($upperCase, 0));

        $string = implode($res) . implode($nb);

        return response()->json([
            "sorted" => $string
        ]);
    }
    
}
