<?php

/**
 * @author Huber Muñoz <huberom@hotmail.com>
 */
namespace AppBundle\Models;

class Subsequence
{
    /**
     * @var array The data array to work with
     *
     * All data sources must deliver this array format:
     *  [
     *      't' => 2,
     *      'cases' => [
     *          0 => [
     *              'n' => 4,
     *              'a' => [],
     *              'w' => [],
     *          ],
     *          1 => [
     *              'n' => 8,
     *              'a' => [],
     *              'w' => [],
     *          ]
     *      ]
     *  ];
     */
    protected $data = [];

    /**
     * @var int The number of test cases
     */
    protected $t;

    /**
     * @var int The number of elements in a given sequence
     */
    protected $n;

    /**
     * @var array Numbers in a give sequence
     */
    protected $a;

    /**
     * @var array  Weights fo the given sequence
     */
    protected $w;

    /**
     * @var array  Weights results array
     */
    protected $results = [];

    /**
     * Sets the data source to be used in the secuence exercise.
     * @param \AppBundle\DataSources\BaseSource $data
     */
    public function setData(\AppBundle\DataSources\BaseSource $data)
    {
        $this->data = $data->getData();
    }

    /**
     * Initializes the options for a given test case index
     * @params int $index
     */
    public function init($index)
    {
        $this->n = $this->data['cases'][$index]['n'];
        $this->a = $this->data['cases'][$index]['a'];
        $this->w = $this->data['cases'][$index]['w'];
    }

    /**
     * Get the weights results array
     * @return array $results
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Runs the maximun weight calculation
     * @return array $results
     */
    public function calculate()
    {
        $t = $this->data['t'];

        $this->results = [];
        for($i=0; $i<$t; $i++) {
            $this->init($i);
            $this->results[] = $this->recursiveCalcultation(0,0,$this->n);
        }

        return $this->results;
    }

    /**
     * Calculates the maximun sequence weight using a recursive strategy
     * Unfortunatelly i'm not the owner of this aproach :(. This is taken from :
     * http://www.programminglogic.com/codesprint-2-problem-subsequence-weighting/
     *
     * @param int $reference The initial reference in the tree
     * @param int $currrent  The current reference when moving in the tree
     * @param int $n         The number of elements of the given sequence
     */
    private function recursiveCalcultation($reference, $currrent, $n)
    {
        // End of the tree comparation
        if ($currrent == ($n-1)) {
            if ($this->a[$currrent]>$this->a[$reference]) {
                return $this->w[$currrent];
            } else {
                return 0;
            }
        }

        $t = 0;
        $d = 0;

        if ($reference === $currrent) {
            $t = $this->w[$currrent] + $this->recursiveCalcultation($currrent,$currrent+1,$n);
        } elseif ($this->a[$currrent] > $this->a[$reference]) {
            $t = $this->w[$currrent] + $this->recursiveCalcultation($currrent,$currrent+1,$n);
        }

        $d = $this->recursiveCalcultation($reference,$currrent+1,$n);

        return max($t,$d);
    }
}
