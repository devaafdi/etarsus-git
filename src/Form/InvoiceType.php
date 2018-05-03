<?php

namespace App\Form;

use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\Vendor;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('idVendor',EntityType::class, array(
                'class' => Vendor::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('td')
                        ->orderBy('td.companyName', 'ASC');
                },
                'choice_label' => 'companyName',
                'placeholder' => 'Choose the vendor',
                'label' => "Vendor",
            ))
            ->add('invoiceItems', CollectionType::class, array(
                'entry_type' => InvoiceItemType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true
            ))
            ->add('submit', SubmitType::class, array(
                'label' => $options['set_button_label']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
            'set_button_label' => "Create Invoice",
        ]);
    }
}
