<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 13:21
 */

class Crawler_Curl
{
    private static $_instance;

    private $_ch;

    private function __construct()
    {
        $this->_ch = curl_init();
    }

    /**
     * @return Crawler_Curl
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new Crawler_Curl();
        }

        return self::$_instance;
    }

    /**
     * @param $url
     * @return bool|string
     * @throws Exception
     */
    public function get($url)
    {
        curl_setopt($this->_ch, CURLOPT_URL, $url);
        curl_setopt($this->_ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_ch, CURLOPT_TIMEOUT, 30);

        $result = curl_exec($this->_ch);

        $error = curl_error($this->_ch);
        if ($error) {
            throw new Exception($error);
        }

        return $result;
    }

    public function __destruct()
    {
        curl_close($this->_ch);
    }
}