<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:51
 */

class Output_Csv implements Output_IOutput
{
    private $data = [];

    public function write($identifyTarget = '')
    {
        #return first
        if (!$this->data || !$identifyTarget) {
            return false;
        }

        $fo = fopen($identifyTarget, 'w');

        #put header csv
        $firstLine = current($this->data);
        fputcsv($fo, array_keys($firstLine));

        foreach ($this->data as $line) {
            fputcsv($fo, $line);
        }

        fclose($fo);

        return true;
    }

    /**
     * @param mixed $data
     * @return $this|mixed
     */
    public function setData($data)
    {
        if (is_array($data)) {
            $this->data = $data;
        }

        return $this;
    }
}