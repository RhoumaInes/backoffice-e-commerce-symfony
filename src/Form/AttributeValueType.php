<?php

namespace App\Form;

use App\Entity\Attribute;
use App\Entity\AttributeValue;
use App\Enum\AttributeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

class AttributeValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('value')
            ->add('attribute', EntityType::class, [
                'class' => Attribute::class,
                'choice_label' => 'name',
                'label' => 'Select Attribute',
                'attr' => ['class' => 'form-control'],
                'data' => $options['selected_attribute'],
                'required' => true,
            ]);
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $attributeValue = $event->getData();
            $form = $event->getForm();

            // Check if the attribute type is COLOR
            if ($attributeValue && $attributeValue->getAttribute()->getType() === AttributeType::COLOR) {
                $form->add('color', ColorType::class, [
                    'label' => 'Select Color',
                    'required' => false,
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AttributeValue::class,
            'selected_attribute' => null,
        ]);
    }
}
