<?php

namespace App\Form;

use App\Entity\InvoiceItem;
use App\Entity\BudgetCode;
use App\Entity\ProjectName;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('budgetCode', EntityType::class, array(
                'class' => BudgetCode::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('td')
                        ->orderBy('td.id', 'ASC');
                },
                'choice_label' => 'budgetCode',
                'placeholder' => '------',
                'label' => false,
            ))
            ->add('description',TextType::class, array(
                'label' => false,
            ))
            ->add('projectCode', EntityType::class, array(
                'class' => ProjectName::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('td')
                        ->orderBy('td.id', 'ASC');
                },
                'choice_label' => 'projectCode',
                'placeholder' => '------',
                'label' => false,))
            ->add('currency',ChoiceType::class, array(
                'choices' => array(
                    'IDR' => 'IDR',
                    'USD' => 'USD',
                    'SGD' => 'SGD',
                    'AUD' => 'AUD',
                ),
                'label' => false,
            ))
            ->add('price',TextType::class, array(
                'label' => false,
            ))
            ->add('quantity',TextType::class, array(
                'label' => false,
            ))
            ->add('total',TextType::class, array(
                'label' => false,
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InvoiceItem::class,
        ]);
    }
}
