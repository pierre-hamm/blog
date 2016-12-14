<?php

namespace M2I\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('M2IBlogBundle:Index:index.html.twig');
    }

    public function contactAction()
    {
    	return $this->render('M2IBlogBundle:Index:contact.html.twig');
    }

    public function aboutAction()
    {
    	return $this->render('M2IBlogBundle:Index:about.html.twig');
    }
}
