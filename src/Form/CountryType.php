<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\City;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('adjective')
            ->add('capital',EntityType::class,array(
              'class'=>City::class,
              'choice_label'=>'name'
            ))
            ->add('population')
            ->add('flag',FileType::class, array(
              'label'=>'Drapeau'
            ))
            ->add('submit',SubmitType::class, array(
              'label'=>'Enregistrer'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
        ]);
    }
}
