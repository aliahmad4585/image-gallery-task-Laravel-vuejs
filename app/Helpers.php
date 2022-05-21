<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;

class Helpers
{
    /**
     * make curl request to get the data
     * 
     * @param string $url 
     * @param string $query
     * 
     * @return array $response
     */

    public static function curl($url, $query = null)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', $url, ['query' => $query]);
        } catch (GuzzleException $e) {
            print_r($e);
        }

        #$statusCode = $response->getStatusCode();
        $content = $response->getBody();

        return json_decode($content);
    }


    /**
     * check that current day is a week day
     * if the query parameter has weekday and its value 1 then set weekday true
     * otherwise set false
     *
     * @return boolean $weekday
     */

    public static function isWeekday()
    {
        $weekday = true;
        if (Helpers::isWeekend(Carbon::now())) {
            $weekday = false;
        }

        // Override manual user selection
        // when user switch the from button
        if (isset($_GET['weekend']) && $_GET['weekend'] == 1)
            $weekday = false;
        else if (isset($_GET['weekday']) && $_GET['weekday'] == 1)
            $weekday = true;

        return $weekday;
    }

    /**
     * Check that current day is weekend or not
     * 
     * @param string $date
     * 
     * @return boolean
     */

    private static function isWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
    }


    /**
     * return the week start end date based on conditions
     * 
     * @param string $which
     * 
     * @return $date
     */
    public static function weekStartEndDate($isStartOfWeek = true, $format = "Y-m-d")
    {
        $now = Carbon::now();
        if ($isStartOfWeek)
            return $weekStartDate = $now->startOfWeek()->format($format);

        return $weekEndDate = $now->endOfWeek()->format($format);
    }
}
