<?php
/**
 * Created by PhpStorm.
 * User: deepak
 * Date: 4/27/16
 * Time: 1:09 PM
 */
namespace ContactBookBundle\Form;

use ContactBookBundle\Model\Phone;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PhoneFormType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Phone::class,
            'translation_domain' => 'phone',
        ));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('phone_number', NumberType::class, array(
            'label' => 'phone.phonenumber',

            'required' => false,
        ));


        $builder->add('phone_type', ChoiceType::class, array(
            'choices' => array(
                'Home' => 'Home',
                'Office' => 'Office',
                'Mobile' => 'Mobile',
                'Alternate no' => 'Alternate no',
                'Other' => 'Other'
            ),
        ));
    }
}
