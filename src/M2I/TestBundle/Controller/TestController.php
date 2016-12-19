<?php

namespace M2I\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function exo2Action()
    {
        return $this->render('M2ITestBundle:Test:subFolder/exo2.html.twig');
    }
}
