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
		        ->add('body','textarea',array(
    'attr' => array('class' => 'tinymce'))
		        ->add('send mail','submit');

	}
	public function getName()
	{
		return 'Email';
	}
}
?>