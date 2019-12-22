<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:50
 */

class Output_Factory
{

    /**
     * @param string $type
     * @return Output_Csv|Output_Screen|null
     * @throws Exception
     */
    public static function create($type)
    {
        $obj = null;
        $type = strtolower($type);
        switch ($type) {
            case 'csv':
                $obj = new Output_Csv();
                break;

            case 'screen':
                $obj = new Output_Screen();
                break;

            default:
                break;
        }

        if (!$obj) {
            throw new Exception($type.' is not supported');
        }

        return $obj;
    }
}