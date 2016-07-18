<?php

/**
 * @author Huber Muñoz <huberom@hotmail.com>
 */
namespace AppBundle\DataSources;

use AppBundle\Contracts\DataSourceInterface;
use Symfony\Component\Validator\Constraints as Assert;

class FileSource extends BaseSource implements DataSourceInterface
{
    const TYPE_TXT = 'type_txt';
    const TYPE_CSV = 'type_csv';
    const TYPE_XLS = 'type_xls';

    /**
     * @Assert\Count(
     *     min = "1",
     * )
     */
    public $data = [];

    /**
     * @param string $filePath
     * @param string $type
     * @return void
     */
    public function setData($filePath, $type='type_txt')
    {
        if ($type == self::TYPE_TXT) {
           $this->setWithTxtFile($filePath);
        }
        if ($type == self::TYPE_CSV) {
           $this->setWithCsvFile($filePath);
        }
        if ($type == self::TYPE_XLS) {
           $this->setWithXlsFile($filePath);
        }
    }

    /**
     * Set the required data reading a txt file. Not under the scope of this test
     * @param string $filePath
     * @return void
     */
    public function setWithTxtFile($filePath)
    {
        $this->data = [];
    }

    /**
     * Example for reading a Csv file. Not under the scope of this test
     * @param string $filePath
     * @return void
     */
    public function setWithCsvFile($filePath)
    {
        $this->data = [];
    }

    /**
     * Example for reading a Xls file. Not under the scope of this test
     * @param string $filePath
     * @return void
     */
    public function setWithXlsFile($filePath)
    {
        $this->data = [];
    }

}
