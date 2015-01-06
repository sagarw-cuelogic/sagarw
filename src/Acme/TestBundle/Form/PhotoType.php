<?php
namespace Acme\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PhotoType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		$builder->add('photo_name','file')
		        ->add('Upload','submit');

	}
	public function getName()
	{
		return 'Photos';
	}
}
?>