<?php
namespace Acme\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		$builder->add('firstName','text',array('attr'=>array('class'=>'form-control')))
		        ->add('lastName','text',array('attr'=>array('class'=>'form-control')))
		        ->add('password', 'repeated',array('type' =>'password' ,'invalid_message' => 'The password fields must match','first_options'  => array('label' => 'Password'),
    'second_options' => array('label' => 'Confirm Password')))
		        ->add('email','text',array('attr'=>array('class'=>'form-control')))
		        ->add('birthDate','date',array('years'=>range(1975,date('Y'))))
		        ->add('Register','submit',array('attr'=>array('class'=>'btn btn-primary')));

	}
	public function getName()
	{
		return 'Login';
	}
}
?>