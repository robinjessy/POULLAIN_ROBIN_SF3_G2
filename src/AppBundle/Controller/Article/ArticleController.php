<?php

namespace AppBundle\Controller\Article;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\PostType;
use AppBundle\Form\addArticle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends Controller
{
    /**
     * @Route("/add", name="_article")
     */
    public function newAction(Request $request)
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('author', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Sauvegarder'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //Get Data
            $title = $form['title']->getData();
            $content = $form['content']->getData();
            $author = $form['author']->getData();

            $now = new\DateTime('now');

            $article->setTitle($title);
            $article->setContent($content);
            $article->setAuthor($author);
            $article->setCreatedAt($now);

            $em = $this->getDoctrine()->getManager();
            $em ->persist($article);
            $em ->flush();

            $this->addFlash(
                'notice',
                'article added'
            );

            return $this->redirectToRoute('_welcome');

        }


        return $this->render('AppBundle:Article:addArticle.html.twig', array(
            'form' => $form->createView(),
        ));


//            // create a task and give it some dummy data for this example
//            $article = new Article();
//            $article->setTitle('title');
//            $article->setContent('content');
//
//
//            $form = $this->createFormBuilder($article)
//                ->add('title', TextType::class)
//                ->add('content', TextareaType::class)
//                ->add('save', SubmitType::class, array('label' => 'Create Article'))
//                ->add('saveAndAdd', SubmitType::class, array('label' => 'Save and Add'))
//                ->getForm();
//
//            $form->handleRequest($request);
//
//            if ($form->isSubmitted() && $form->isValid()) {
//                // ... perform some action, such as saving the task to the database
//
//                $nextAction = $form->get('saveAndAdd')->isClicked()
//                    ? 'article_new'
//                    : 'article_success';
//
//                return $this->redirectToRoute($nextAction);
//            }
//
//            return $this->render('AppBundle:Article:addArticle.html.twig', array(
//                'form' => $form->createView(),
//            ));
    }

    /**
     * @Route("/show/{id}", requirements={"id" = "\d+"})
     */
    public function showAction($id, Request $request)
    {
        $tag = $request->query->get('tag');

        return new Response('Affiche moi l\'article avec l\'id: '.$id.' avec le tag '.$tag
        );
    }

    /**
     * @Route("/show/{articleName}")
     *
     * @param $articleName
     *
     * @return Response
     */
    public function showArticleNameAction($articleName)
    {
        return $this->render('AppBundle:Article:index.html.twig', [
            'articleName' => $articleName,
        ]);
    }
}