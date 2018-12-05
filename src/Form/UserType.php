<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;
use App\Entity\Country;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('password')
            ->add('country',EntityType::class,array(
              'class'=>Country::class,
              'choice_label'=>'name'
            ))
           ->add('role',EntityType::class,array(
             'class'=>Role::class,
             'choice_label'=>'name'
           ))
            ->add('sumbit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
