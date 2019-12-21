<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr' =>[
                    'placeholder' => "Veuillez entrer votre mot de Email"
                ]
                ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de Passe',
                'attr' =>[
                    'placeholder' => "Veuillez entrer votre mot de passe"
                ]
                ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' =>[
                    'placeholder' => "Veuillez entrer votre prénom"
                ]
                ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' =>[
                    'placeholder' => "Veuillez entrer votre nom"
                ]
                ])
            ->add('age', NumberType::class, [
                'label' => 'Age',
                'attr' =>[
                    'placeholder' => "Veuillez entrer votre Age"
                ]
                ])
            ->add('sex', ChoiceType::class,[
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
