<?php

namespace App\Form;

use App\Entity\Socio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dni', TextType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('nombre', TextType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('apellido1', TextType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('apellido2', TextType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('direccion', TextType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('num_socio',TextType::class,[
                'attr' => ['class' => 'form-control']
            ])
            ->add('fecha_alta', DateType::class,[
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker form-control'],
                'data' => new \DateTime(),
            ])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'contraseña',
                    'attr' => [
                        'class' => 'form-control']
                    ],
                'second_options' => [
                    'label' => 'repite contraseña',
                    'attr' => [
                        'class' => 'form-control'],
                    ]
            ])
            ->add('registrar', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Socio::class,
        ]);
    }
}
