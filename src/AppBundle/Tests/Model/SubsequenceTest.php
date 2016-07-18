<?php

/**
 * @author Huber Muñoz <huberom@hotmail.com>
 */
namespace AppBundle\Tests\Model;

use AppBundle\Models\Subsequence;
use AppBundle\DataSources\BaseSource;
use AppBundle\DataSources\RequestSource;

class SubsequenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array Data test
     */
    public $post = [
        't' => 1,
        'cases' => [
            0 => "4\n1 4 3 4\n10 20 30 40",
        ]
    ];

    /**
     * Test to check if datasource is delivering
     * the correct format of the data
     */
    public function testDatasource()
    {
        $source = new RequestSource();
        $source->setData($this->post);

        $result = $source->getData();

        $expected = array(
            't' => 1,
            'cases' => array(
                0 => array(
                    'n' => 4,
                    'a' => array(0=>1,1=>4,2=>3,3=>4),
                    'w' => array(0=>10,1=>20,2=>30,3=>40),
                ),
            ),
       );

       $this->assertEquals($result, $expected);
    }

    /**
     * Test for the Subsecence calculate method
     */
    public function testCalculate()
    {
        $source = new RequestSource();
        $source->setData($this->post);

        $s = new Subsequence();
        $s->setData($source);
        $results = $s->calculate();

        $this->assertEquals($results, [0 => 80]);
    }

}
