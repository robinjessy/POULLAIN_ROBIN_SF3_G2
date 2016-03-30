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
        /*$antispam = $this->get('antispam');
        dump($antispam->isSpam('sdefgrnirbnotobrtb'));
        die();*/

        $manager = $this->getDoctrine()->getManager();
//
//        $artcile = new Article();
//        $artcile
//            ->setTitle('Tire Article')
//            ->setContent('Le contenu de mon premier article')
//            ->setAuthor('John Fifi')
//            ->setTag('osef')
//        ;
//
//        $manager->persist($artcile);
//        $manager->flush();

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();

        dump($articles);die;

        return $this->render('AppBundle:Home:index.html.twig');
    }
}