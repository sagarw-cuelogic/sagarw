<?php
namespace Acme\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class JoinType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		$builder->add('firstName','text',array('attr'=>array('class'=>'form-control')))
		        ->add('lastName','text',array('attr'=>array('class'=>'form-control')))
		        ->add('address','text',array('attr'=>array('class'=>'form-control')))
		        ->add('email','email',array('attr'=>array('class'=>'form-control')))
		        ->add('phone','text',array('attr'=>array('class'=>'form-control')))
		        ->add('birthDate','date',array('years'=>range(1975,date('Y'))))
		        ->add('save','submit' ,array('attr'=>array('class'=>'btn btn-primary')));

	}

	public function getName()
	{
		return 'Join';
	}
}
?>