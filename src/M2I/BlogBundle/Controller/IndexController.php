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

        // get article id = 2 (un tableau)
        $article2 = $articleRepository->find(2);
        $article2 = $articleRepository->findById(2);

        // get article avc title = 'Article 3' (un tableau)
        $article3 = $articleRepository->findByTitle('Article 3');

        // recupere l'article 3
        $oneArticle = $articleRepository->findOneById(3);

        dump($article2);
        dump($article3);
        die();

        return $this->render(
            'M2IBlogBundle:Index:index.html.twig'
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
}
