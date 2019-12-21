<?php

namespace App\Form;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label'  => 'Ville',
                'attr' =>[
                    'placeholder' => "Veuillez entrer la ville où se situe stade."
                ]
            ])
            ->add('postalcode', NumberType::class,[
                'label' => 'Code Postal',
                'attr' =>[
                    'placeholder' => "Veuillez entrer le code postale où se situe stade."
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
