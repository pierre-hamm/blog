<?php

namespace M2I\BlogBundle\Controller;

use M2I\BlogBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function testAction()
    {
        // Creation de notre entity Article
        $newArticle = new Article();
        $newArticle->setTitle('titre creation');
        $newArticle->setDescription('description creation');

        // Recuperation de notre entity manager
        $em = $this->container->get('doctrine.orm.entity_manager');

        // on recupere le repository de Article
        $articleRepository = $em->getRepository('M2IBlogBundle:Article'); 
        $toUpdateArticle = $articleRepository->findOneById(1);

        // modification de mon Article avec l'id 1
        $toUpdateArticle->setTitle('new title 2');

        // On persist l'entity Article 
        // Modification ou creation
        // persist va gerer la request sql
        $em->persist($toUpdateArticle);
        $em->persist($newArticle);
        $em->flush();

        return new Response('<html><body></body></html>');
    }

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
