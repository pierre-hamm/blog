<?php

namespace M2I\BlogBundle\Controller;

use M2I\BlogBundle\Entity\Article;
use M2I\BlogBundle\Entity\Image;
use M2I\BlogBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function testCreateImageAction()
    {
        // Creation de l'entity image
        $image = new Image();
        $image->setUrl('images/post1.jpg');
        $image->setAlt('post1');

        // Creation de l'entity article
        $article = new Article();
        $article->setTitle('Titre link image');
        $article->setDescription('Description link image');

        // Liaison entre les 2 objects (on met l'id_image dans notre article)
        $article->setImage($image);

        // on sauvegarde
        $em = $this->container->get('doctrine.orm.entity_manager');
        $em->persist($article);
        $em->persist($image);
        $em->flush();

        return new Response('<html><body></body></html>');
    }

    public function deleteArticleAction($idArticle)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $articleRepository = $em->getRepository('M2IBlogBundle:Article');

        $article = $articleRepository->findOneById($idArticle);

        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('m2_i_blog_homepage');
    }

    public function editArticleAction(Request $request, $idArticle)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $articleRepository = $em->getRepository('M2IBlogBundle:Article');

        $editArticle = $articleRepository->findOneById($idArticle);

        $form = $this
            ->container
            ->get('form.factory')
            ->create(ArticleType::class, $article);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();
            }
        }

        return $this->render(
            'M2IBlogBundle:Index:edit_article.html.twig',
            array('myForm' => $form->createView())
        );
    }

    public function addAction(Request $request)
    {
        $article = new Article();

        $form = $this
            ->container
            ->get('form.factory')
            ->create(ArticleType::class, $article);

        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                $em = $this->container->get('doctrine.orm.entity_manager');

                $em->persist($article);
                $em->flush();

                return $this->redirectToRoute('m2_i_blog_add_article');
            }
        }

        return $this->render(
            'M2IBlogBundle:Index:add_article.html.twig',
            array('form' => $form->createView())
        );
    }

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
