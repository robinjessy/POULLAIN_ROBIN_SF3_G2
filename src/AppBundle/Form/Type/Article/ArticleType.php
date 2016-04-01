<?php
/**
 * Created by PhpStorm.
 * User: jessy
 * Date: 01/04/2016
 * Time: 16:05
 */

namespace AppBundle\Form\Type\Article;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('author')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                'csrf_protection' => false,
                'data_class' => 'AppBundle\Entity\Article\Article'
            ]
        );
    }

    public function getName()
    {
        return 'app_bundle_article_type';
    }
}