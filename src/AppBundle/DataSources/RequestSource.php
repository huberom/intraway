<?php

/**
 * @author Huber Muñoz <huberom@hotmail.com>
 */
namespace AppBundle\DataSources;

use AppBundle\Contracts\DataSourceInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RequestSource extends BaseSource implements DataSourceInterface
{
    const TYPE_POST = 'type_post';
    const TYPE_GET  = 'type_get';

    /**
     * @Assert\Count(
     *     min = "1",
     * )
     */
    public $data = [];

    /**
     * @param Array $data
     * @param string $type
     * @return void
     */
    public function setData($data = [], $type='type_post')
    {
        if ($type == self::TYPE_POST) {
           $this->setWithHttpPost($data);
        }
        if ($type == self::TYPE_GET) {
           $this->setWithHttpGet($data);
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function setWithHttpPost($data)
    {
        if (empty($data['t'])) {
            return 0;
        }
        if (empty($data['cases'])) {
            return 0;
        }
        
        $this->data['t'] = $data['t'];
        foreach ($data['cases'] as $index => $case) {
            $rows = explode("\n", $case);

            $line = 0;
            foreach ($rows as $row) {
                $row = trim($row);

                if ($line === 0) {
                    $this->data['cases'][$index]['n'] = $row;
                }

                if ($line === 1) {
                    $a_numbers = explode(" ",$row);
                    foreach ($a_numbers as $a) {
                        $this->data['cases'][$index]['a'][] = $a;
                    }
                }

                if ($line === 2) {
                    $w_numbers = explode(" ",$row);
                    foreach ($w_numbers as $w) {
                        $this->data['cases'][$index]['w'][] = $w;
                    }
                }

                $line++;
            }
        }
    }

    /**
     * Example for another type of http data
     * @param array $data
     * @return void
     */
    public function setWithHttpGet($data)
    {
        $this->data = $data;
    }

}
