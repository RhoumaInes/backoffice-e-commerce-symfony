<?php

namespace App\Form;

use App\Entity\Attribute;
use App\Enum\AttributeType as EnumAttributeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AttributeType extends AbstractType
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
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Liste déroulante' => EnumAttributeType::DROPDOWN,
                    'Boutons radio' => EnumAttributeType::RADIO,
                    'Couleur' => EnumAttributeType::COLOR,
                ],
                'label' => 'Type d\'attribut',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Attribute::class,
        ]);
    }
}
