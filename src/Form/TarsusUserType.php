<?php

namespace App\Form;

use App\Entity\TarsusUser;
use App\Entity\TarsusDivision;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TarsusUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class, array(
                'label' => 'First Name'))
            ->add('lastName',TextType::class, array(
                'label' => 'Last Name'))
            ->add('emailAddress',EmailType::class, array(
                'label' => 'Email Address'))
            ->add('phoneNumber',TextType::class, array(
                'label' => 'Phone Number'))
            ->add('jobTitle',TextType::class, array(
                'label' => 'Job Title'))
            ->add('idDivision',EntityType::class, array(
                'class' => TarsusDivision::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('td')
                        ->orderBy('td.division', 'ASC');
                },
                'choice_label' => 'division',
                'placeholder' => 'Choose the division'
                ))
            ->add('userRole',ChoiceType::class, array(
                'choices' => array(
                    'User' => 'ROLE_USER',
                    'Authorizer' => 'ROLE_AUTHORIZER'
                )))
            ->add('cPassword',RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array(
                        'label' => 'Password'),
                    'second_options' => array(
                        'label' => 'Confirm Password')
                )
            )
            ->add('submit',SubmitType::class, array(
                'label' => $options['set_button_label']));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TarsusUser::class,
            'set_button_label' => "Create User"
        ]);
    }
}
