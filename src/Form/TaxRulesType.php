<?php

namespace App\Form;

use App\Entity\TaxRules;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaxRulesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class , ['constraints' => [
                new NotBlank([
                    'message' => 'Le nom ne doit pas être vide.',
                ]),
                ],
            ])
            ->add('rate')
            ->add('state', CheckboxType::class, [
                'label'    => 'Active',
                'required' => false,
                'attr'     => ['class' => 'custom-toggle'], // Add custom class for styling
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TaxRules::class,
        ]);
    }
}
