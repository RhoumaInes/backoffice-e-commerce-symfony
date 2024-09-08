<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class , ['constraints' => [
                new NotBlank([
                    'message' => 'Le titre ne doit pas être vide.',
                ]),
                ],
            ])
            ->add('description',TextareaType::class , ['constraints' => [
                new NotBlank([
                    'message' => 'La description ne doit pas être vide.',
                ]),
                new Length([
                    'min' => 150,
                    'minMessage' => 'La description doit contenir au minimum {{ limit }} caractères.',
                ]),
                ],
            ])
            ->add('subcategorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => "name",
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Aucun',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
