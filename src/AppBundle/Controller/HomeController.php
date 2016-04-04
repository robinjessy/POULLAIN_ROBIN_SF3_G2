<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="_welcome")
     */
    public function indexAction()
    {

        $manager = $this->getDoctrine()->getManager();

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();


        return $this->render('AppBundle:Home:index.html.twig',[
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/show/{id}", requirements={"id" = "\d+"}, name="_show")
     */
    public function showAction($id)
    {
        $article = $this->getDoctrine()
            ->getRepository('AppBundle:Article\Article')
            ->find($id);

        return $this->render('AppBundle:Home:show.html.twig',[
            'article' => $article,
        ]);
    }


}