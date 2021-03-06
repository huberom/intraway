<?php

/**
 * @author Huber Muñoz <huberom@hotmail.com>
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Models\Subsequence;
use AppBundle\DataSources\RequestSource;

class SequenceController extends Controller
{
    /**
     * @var string Custom view path for this controller
     */
    public $view_path = 'AppBundle:Sequence:';

    /**
     * Action to show the cases web form
     * @return \Symfony\Component\HttpFoundation\Response A Response instance
     */
    public function indexAction()
    {
        $msg = '';

        return $this->render($this->view_path.'home.html.twig',
            ['msg' => $msg]
        );
    }

    /**
     * Action to handle the cases form request
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response A Response instance
     */
    public function processAction(Request $request)
    {
        $data['t']     = $request->request->get('t_cases');
        $data['cases'] = $request->request->get('case');

        $source = new RequestSource();
        $source->setData($data, RequestSource::TYPE_POST);

        $validator = $this->get('validator');
        $errors = $validator->validate($source);

        if (count($errors) > 0) {
            $msg = 'Please check form options and try again';
            return $this->render($this->view_path.'home.html.twig',
                compact('msg')
            );
        }

        $s = new Subsequence();
        $s->setData($source);
        $results = $s->calculate();
        $msg = '';

        return $this->render($this->view_path.'result.html.twig',
            compact('results', 'msg')
        );
    }
}
