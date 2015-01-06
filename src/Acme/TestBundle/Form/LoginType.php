<?php
namespace Acme\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		$builder->add('userName','text',array('label' => 'Email Id','attr'=>array('class'=>'form-control')))
		        ->add('password','password',array('attr'=>array('class'=>'form-control')))
		        ->add('login','submit',array('attr'=>array('class'=>'btn btn-primary')));

	}
	public function getName()
	{
		return 'Login';
	}
}
?>