<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:52
 */

interface Output_IOutput
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public function setData($data);

    /**
     * @param string $identifyTarget
     * @return bool
     */
    public function write($identifyTarget = '');
}