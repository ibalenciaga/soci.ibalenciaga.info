<?php

namespace App\Form;

use App\Entity\Reserva;
use PhpParser\Node\Expr\AssignOp\Div;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', DateType::class,[
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker form-control'],
                'data' => new \DateTime(),
            ])

            //->add('socio')
            //->add('mesa')
            ->add('turno', TurnoType::class,[
                'label' => false
            ])
            ->add('buscar-mesa', ButtonType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ])
            ->add('comensales', NumberType::class,[
                'attr' => ['class' => 'form-control'],
            ])
            ->add('reservar', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
