<?php
namespace Acme\TestBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


class AgeValidation extends Constraint
{
	public $message="The Age should be greater then 18";
}
?>