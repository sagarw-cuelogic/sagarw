<?php
namespace Acme\TestBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


class PhoneValidation extends Constraint
{
	public $message="The phone number should in format 999-999-9999";
}
?>