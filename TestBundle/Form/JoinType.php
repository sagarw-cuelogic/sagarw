<?php
namespace Acme\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class JoinType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		$builder->add('firstName','text')
		        ->add('lastName','text')
		        ->add('address','text')
		        ->add('email','email')
		        ->add('phone','text')
		        ->add('birthDate','date',array('years'=>range(1975,date('Y'))))
		        ->add('save','submit');

	}

	public function getName()
	{
		return 'Join';
	}
}
?>