<?php

/**
 * @author Huber Muñoz <huberom@hotmail.com>
 */
namespace AppBundle\DataSources;

class BaseSource
{
    /**
     * @var array   The data array with test cases information
     */
    public $data = [];

    /**
     * @return Array
     */
    public function getData()
    {
        return $this->data;
    }

}
