<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 13:05
 */

class Output_Screen implements Output_IOutput
{
    private $_data;

    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * @param string $identifyTarget
     * @return bool
     */
    public function write($identifyTarget = '')
    {
        if (is_scalar($identifyTarget)) {
            echo PHP_EOL, $this->_data, PHP_EOL;
        } else {
            print_r($this->_data);
        }

        return true;
    }
}