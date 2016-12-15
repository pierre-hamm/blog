<?php

namespace M2I\BlogBundle\Controller;

use M2I\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $articleRepository = $em->getRepository('M2IBlogBundle:Article');

        // tous les articles
        $articleList = $articleRepository->findAll();

        return $this->render(
            'M2IBlogBundle:Index:index.html.twig',
            array(
                'articleList' => $articleList
            )
        );
    }

    public function contactAction()
    {
    	return $this->render('M2IBlogBundle:Index:contact.html.twig');
    }

    public function aboutAction()
    {
    	return $this->render('M2IBlogBundle:Index:about.html.twig');
    }

    public function detailAction($idArticle)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $articleRepository = $em->getRepository('M2IBlogBundle:Article');        

        $article = $articleRepository->findOneById($idArticle);

        return $this->render('M2IBlogBundle:Index:detail.html.twig', array('article' => $article));
    }
}
