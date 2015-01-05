<?php
namespace Acme\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		$builder->add('userName','text',array('label' => 'Email Id'))
		        ->add('password','password')
		        ->add('login','submit');

	}
	public function getName()
	{
		return 'Login';
	}
}
?>