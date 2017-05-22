<?php
/**
 * Created by PhpStorm.
 * User: deepak
 * Date: 4/27/16
 * Time: 1:09 PM
 */
namespace ContactBookBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use ContactBookBundle\Model\Contact;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ContactBookBundle\Form\AddressFormType;
use Symfony\Component\Validator\Constraints\Choice;

class ContactFormType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Contact::class,
            'translation_domain' => 'contact',
        ));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_name', TextType::class, array(
            'label' => 'contact.firstName',
        ));

        $builder->add('last_name', TextType::class, array(
            'label' => 'contact.lastName',
        ));

        $builder->add('gender', ChoiceType::class, array(
            'choices' => array(
                '1' => 'male',
                '0' => 'female',
                '2' => 'other'
        ),
                'multiple' => false,
                'required' => true,
                'expanded' => true
        ));

        $builder->add('facebook_id', TextType::class, array(
            'label' => 'contact.facebookId',
            'required'    => false,
            'empty_data' => null

        ));

        $builder->add('friend_since', DateType::class, array(
            'data' => new \DateTime('now'),
            'format' => 'y-M-d',

        ));

        $builder->add('email', EmailType::class, array(
            'label' => 'contact.email',
            'required' => false,
            'empty_data' => null

        ));
        $builder->add('Addresses', CollectionType::class, array(
           'type' => new AddressFormType(),

       ));
        $builder->add('phones', CollectionType::class, array(
           'type' => new PhoneFormType(),

       ));
        $builder->add('save', SubmitType::class, array(

          'label' => 'contact.save',
       ));
    }
}
