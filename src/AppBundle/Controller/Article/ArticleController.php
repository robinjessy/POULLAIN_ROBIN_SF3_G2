<?php
namespace AppBundle\Controller\Article;
use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\PostType;
use AppBundle\Entity\Article\Tag;
use AppBundle\Form\addArticle;
use AppBundle\Form\Type\Article\ArticleType;
use AppBundle\Form\Type\Article\TagType;
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
        $form = $this->createForm(TagType::class);

        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();

            /**
             * @var Tag $tag
             */
            $tag = $form->getData();

            // class stringUtil
            $stringUtil = $this->get('string.util');

            $slug = $stringUtil->slugify($tag->getName());
            $tag->setSlug($slug);

            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('_article');
        }

        return $this->render('AppBundle:Article:addArticle.html.twig', array(
            'form' => $form->createView(),
        ));

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

    public function authorAction()
    {
        
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();

        return $this-> render('AppBundle:Article:index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/tag/new", name="_tag")
     */
    public function newTagAction(Request $request)
    {
        $form = $this->createForm(TagType::class);

        $form->handleRequest($request);

        if($form->isValid()){
            dump($form->getData());die;
        }

        return $this->render('AppBundle:Article:tag.new.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

}