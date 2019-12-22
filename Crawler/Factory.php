<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:39
 */

class Crawler_Factory
{

    /**
     * @param $page
     * @return null
     * @throws Exception
     */
    public static function create($page)
    {
        $obj = null;
        switch ($page) {
            case 'VNExpress';
                $obj = new Crawler_VNExpress();
                break;

            default:
                break;
        }

        if (!$obj) {
            throw new Exception($page. ' is not support');
        }

        return $obj;
    }
}