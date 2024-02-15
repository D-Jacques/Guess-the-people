<?php

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // TODO : Essayer d'intégrer une checklist des deux roles ('ROLE_USER', 'ROLE_ADMIN')
            ->add('roles', ChoiceType::class, [
                'choices' => User::USER_ROLES
            ])
            ->add('password')
        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                // array => string
                fn ($rolesAsArray) => count($rolesAsArray) ? $rolesAsArray[0] : null,
                // string => array
                fn ($rolesAsString) => [$rolesAsString]
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
