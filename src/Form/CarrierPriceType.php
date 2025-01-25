<?php

namespace App\Form;

use App\Entity\CarrierPrice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Enum\CityEnum;

class CarrierPriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', ChoiceType::class, [
                'choices' => array_combine(
                    array_map(fn(CityEnum $city) => $city->name, CityEnum::cases()),  // Nom de la ville
                    CityEnum::cases()  // Liste des objets CityEnum
                ),
                'choice_label' => function(?CityEnum $city) {
                    return $city ? ucfirst(strtolower($city->name)) : '';
                },
                'choice_value' => function(?CityEnum $city) {
                    return $city ? $city->value : '';
                },
                'expanded' => false, // Dropdown (select) menu
                'multiple' => false, // Single choice
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'currency' => 'TND',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarrierPrice::class,
        ]);
    }
}
