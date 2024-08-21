<?php

namespace App\Form;

use App\Entity\Provider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProviderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class , ['constraints' => [
                new NotBlank([
                    'message' => 'Le titre ne doit pas être vide.',
                ]),
                ],
            ])
            ->add('description',TextareaType::class , [
                'constraints' => [
                    new NotBlank([
                        'message' => 'La description ne doit pas être vide.',
                    ])
                ],
            ])
            ->add('address', TextType::class , ['constraints' => [
                new NotBlank([
                    'message' => 'L\'adresse ne doit pas être vide.',
                ]),
                ],
            ])
            ->add('phonenumber', NumberType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'The phone number should not be blank']),
                    new Regex([
                        'pattern' => '/^\d{8}$/',
                        'message' => 'Le numéro de téléphone doit comporter 8 chiffres',
                    ]),
                ],
            ])
            ->add('postalcode', NumberType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le code postal ne doit pas être vide.']),
                    new Length(['max' => 4, 'maxMessage' => 'Le code postal ne peut pas comporter plus de {{ limit }} caractères']),
                ],
            ])
            ->add('city', TextType::class , ['constraints' => [
                new NotBlank([
                    'message' => 'Le titre ne doit pas être vide.',
                ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Provider::class,
        ]);
    }
}
