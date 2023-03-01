<?php

namespace App\Form;

use App\Entity\Prestamo;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class PrestamoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fechaRetiro', DateType::class, ['data' => new \DateTime()])
            ->add('fechaDevolucion', DateType::class, ['data' => new \DateTime('+ 20 days')])
            ->add('socio')
            ->add('ejemplar')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestamo::class,
        ]);
    }
}
