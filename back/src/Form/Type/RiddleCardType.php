<?php

namespace App\Form\Type;

use App\Entity\RiddleCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RiddleCardType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextareaType::class)
            ->add('name', TextType::class)
            ->add('imageFile', FileType::class,  [
                'label' => 'Photo illustration de la personne',
                'required' => false,
                'attr' => ['class' => 'bg-inherit border-0 rounded-none']
            ])
        ;
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RiddleCard::class,
        ]);

    }

}