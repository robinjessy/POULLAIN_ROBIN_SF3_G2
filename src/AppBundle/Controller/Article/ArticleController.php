<?php

namespace AppBundle\Controller\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Created by PhpStorm.
 * User: jessy
 * Date: 29/03/2016
 * Time: 18:10
 */
class ArticleController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        return new Response('List of article');
    }
}