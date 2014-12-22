<?php
namespace Acme\TestBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneValidationValidator extends ConstraintValidator
{
	public function validate($value ,Constraint $constraint)
	{
		if (!preg_match('/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}+$/', $value, $matches)){

     		$this->context->addViolation(
                $constraint->message,
                array('phone' => 'phone')
            );
		}
	}
}
?>