<?php
namespace Acme\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		$builder->add('firstName','text')
		        ->add('lastName','text')
		        ->add('password', 'repeated',array('type' =>'password' ,'invalid_message' => 'The password fields must match','first_options'  => array('label' => 'Password'),
    'second_options' => array('label' => 'Confirm Password')))
		        ->add('email','text')
		        ->add('birthDate','date',array('years'=>range(1975,date('Y'))))
		        ->add('Register','submit');

	}
	public function getName()
	{
		return 'Login';
	}
}
?>