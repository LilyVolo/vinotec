<?php

namespace App\Form;

use App\Entity\Bottle;
use App\Entity\Region;
use App\Entity\Storage;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BottleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('year', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                "format" => 'yyyy',

            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,

            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,

            ])
            ->add('storage', EntityType::class, [
                'class' => Storage::class,

            ])
            
        ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bottle::class,
        ]);
    }
}
