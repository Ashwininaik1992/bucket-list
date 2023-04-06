<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Your Idea', 'required'=> true])
            ->add('description', TextType::class, ['label' => 'Please describe it', 'required'=> false])
            ->add('author', TextType::class, ['label'=> 'Your Username'])
            ->add('category', EntityType::class, ['label'=>'category','class'=> Category::class, 'choice_label'=>'name', 'placeholder'=>'choose a category'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
