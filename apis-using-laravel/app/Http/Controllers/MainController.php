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
        // willl save all lower and upper letter in different array
        for ($i = 0; $i < count($arr); $i++) {


            // Checks  if its a lowerCase 
            if ($arr[$i] >= 'a' && $arr[$i] <= 'z') {
                $lowerCase[] = $arr[$i];
            }

            // Checks  if its a upperCase
            if ($arr[$i] >= 'A' && $arr[$i] <= 'Z') {
                $upperCase[] = $arr[$i];
            }

            // Checks  if its a number
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


    // API that recives a number $num and returns each place value in the number
    function getNumPlace($num)
    {
        // Checks if its a number
        if (is_numeric($num)) {
            // get nb of digits we have
            $nbOfDigits = strlen($num);
            //as we count it as string if it is neg must remove 1, the size of "-" minus sign
            if ($num < 0) {
                $nbOfDigits--;
            }
            // get last digit
            $mod = $num % 10;
            // remove last digit from num
            $num = (int)$num / 10;
            // place of this digit  like tens hundred thousand etc..
            $place = 1;
            //will save results in array
            $arr = array();
            while ($nbOfDigits != 0) {
                $arr[] = $mod * $place;
                $nbOfDigits--;
                $place = $place * 10;
                $mod = $num % 10;
                $num = (int)$num / 10;
            }
            return response()->json([
                "num" => array_reverse($arr)
            ]);
        } else {
            // if send string return error
            return response()->json([
                "num" => "must Enter numeric Value"
            ]);
        }
    }

    function humanToProgramer($string)
    {

        //decbin("1587");
        $pattern = "/\D+/";
        $number = preg_split($pattern, $string);
        foreach ($number as $i => $value) {
            if ($value) {
                $number[$i] = decbin($value);
            }
        }
        $pattern = "/\d+/";
        $text = preg_split($pattern, $string);
        $res = "";
        for ($i = 0; $i < count($number); $i++) {
            if ($number[$i]) {
                $res = $res . $number[$i];
            } else  if (isset($text[$i])) {

                $res = $res . $text[$i];
            }
        }

        return response()->json([
            "ProgramerText" => $res
        ]);
    }
}
