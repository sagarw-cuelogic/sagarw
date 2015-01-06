<?php
namespace Acme\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SendEmailType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		$builder->add('senderEmail','text')
		        ->add('subject','text')
		        ->add('body','textarea',array('attr' => array('cols' => '19','rows'=>'4')))
		        ->add('send mail','submit');

	}
	public function getName()
	{
		return 'Email';
	}
}
?>