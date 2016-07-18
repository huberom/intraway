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
     * @dataProvider requestProvider
     */
    public function testCalculate(BaseSource $source)
    {
        $s = new Subsequence();
        $s->setData($source);
        $results = $s->calculate();

        $this->assertTrue($this->indenticalArrays($results, [0 => 80]));
    }

    public function requestProvider()
    {
        $post = [
            't_cases' => 1,
            'cases' => Array (
                [0] => '4
                       1 4 3 4
                       10 20 30 40'
                )
        ];
        
        $source = new RequestSource();
        $source->setData($post);

        return $source;
    }

    /**
     * Determine if two associative arrays are similar
     *
     * Both arrays must have the same indexes with identical values
     * without respect to key ordering 
     * 
     * @param array $a
     * @param array $b
     * @return bool
     */
    public function indenticalArrays($a, $b)
    {
        // if the indexes don't match, return immediately
        if (count(array_diff_assoc($a, $b))) {
            return false;
        }
        // we know that the indexes, but maybe not values, match.
        // compare the values between the two arrays
        foreach($a as $k => $v) {
            if ($v !== $b[$k]) {
                return false;
            }
        }
        // we have identical indexes, and no unequal values
        return true;
    }
}
