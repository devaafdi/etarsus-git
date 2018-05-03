<?php

namespace App\Form;

use App\Entity\Vendor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Service\ListCountry;

class VendorType extends AbstractType
{
    private $countryCode;

    public function __construct(ListCountry $listCountry)
    {
        $this->countryCode = $listCountry->getListCountry();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName')
            ->add('address')
            ->add('country', ChoiceType::class, array(
                'choices' => $this->countryCode,
                'preferred_choices' => array('IDN', 'SGP', 'USA')
            ))
            ->add('phone')
            ->add('emailAddress')
            ->add('website')
            ->add('submit',SubmitType::class, array(
                'label' => $options['set_button_label']));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vendor::class,
            'set_button_label' => "Create Vendor"
        ]);
    }
}
