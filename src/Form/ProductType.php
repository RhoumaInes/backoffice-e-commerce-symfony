<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class , ['constraints' => [
                new NotBlank([
                    'message' => 'Le titre ne doit pas être vide.',
                ]),
                ],
            ])
            ->add('summary', TextareaType::class , ['constraints' => [
                new NotBlank([
                    'message' => 'Le récapitulatif ne doit pas être vide.',
                ]),
                new Length([
                    'min' => 50,
                    'minMessage' => 'Le récapitulatif doit contenir au minimum {{ limit }} caractères.',
                ]),
                ],
            ])
            ->add('description', TextareaType::class , ['constraints' => [
                new Length([
                    'min' => 150,
                    'minMessage' => 'Le résumé doit contenir au minimum {{ limit }} caractères.',
                ]),
                ],
            ])
            ->add('totalQuantity', NumberType::class , ['constraints' => [
                new GreaterThanOrEqual([
                    'value' => 0,
                    'message' => 'La quantité doit être supérieure ou égale à 0.',
                ]),
            ],
        ] )
        ->add('minimumQuantityForSale', NumberType::class , ['constraints' => [
                new GreaterThanOrEqual([
                    'value' => 1,
                    'message' => 'La quantité doit être supérieure ou égale à 1.',
                ]),
            ],
        ])
        ->add('categories', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => "name",
            'multiple' => true,
            'expanded' => false,
        ])
        ->add('unit')
        ->add('reference')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
