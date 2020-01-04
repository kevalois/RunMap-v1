<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Lieu',
                'attr' =>[
                    'placeholder' => "Veuillez entrer le nom du lieu."
                ]
                ,])
            ->add('adress', TextType::class,[
                'label' => 'Adresse',
                'attr' =>[
                    'placeholder' => "Veuillez entrer l'adresse du lieu."
                ]
                ,])
                ->add('schedule', TextType::class,[
                    'label' => 'Horaire',
                    'attr' =>[
                        'placeholder' => "Veuillez entrer les horaires du lieu."
                    ]
                    ,])
            ->add('complementinfo', TextareaType::class,[
                'label' => 'Informations',
                'attr' =>[
                    'placeholder' => "Veuillez entrer les informations utiles du lieu."
                ]
                ,]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
