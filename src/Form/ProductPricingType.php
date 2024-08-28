<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\TaxRules;
use App\Repository\TaxRulesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductPricingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('prixAchat', MoneyType::class, [
            'currency' => 'EUR',
            'label' => 'Prix d\'achat',
        ])
        ->add('prixVenteHt', MoneyType::class, [
            'currency' => 'EUR',
            'label' => 'Prix de vente HT',
        ])
        ->add('prixVenteTtc', MoneyType::class, [
            'currency' => 'EUR',
            'label' => 'Prix de vente TTC',
            'attr' => [
                'readonly' => true,
            ],
        ])
        ->add('taxRules', EntityType::class, [
            'class' => TaxRules::class,
            'choice_label' => 'name',
            'label' => 'Règle de Taxe',
            'placeholder' => 'Choisir une taxe',
            'query_builder' => function (TaxRulesRepository $repository) {
                return $repository->createQueryBuilder('t')
                    ->where('t.state = :state')
                    ->setParameter('state', 1);
            },
            'choice_attr' => function (TaxRules $taxRule) {
                return ['data-rate' => $taxRule->getRate()];
            },
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
