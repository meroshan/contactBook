<?php
/**
 * Created by PhpStorm.
 * User: deepak
 * Date: 4/27/16
 * Time: 1:09 PM
 */
namespace ContactBookBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use ContactBookBundle\Model\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressFormType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Address::class,
            'translation_domain' => 'address',
        ));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('country', TextType::class, array(
            'label' => 'address.country',
            'required' => false,
        ));

        $builder->add('district', TextType::class, array(
            'label' => 'address.district',
            'required' => false
        ));

        $builder->add('village_city', TextType::class, array(
            'label' => 'address.villagecity',
            'required'    => false,
            'empty_data'  => null
        ));

        $builder->add('address_type', ChoiceType::class, array(
            'choices' => array(
                'Home' => 'Home',
                'Office' => 'Office',
                'Temporaray' => 'Temporary',
                'Permanent' =>'Permanent',
                'Other' => 'Other'
            ),
        ));
    }
}
