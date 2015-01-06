<?php
namespace Acme\TestBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AgeValidationValidator extends ConstraintValidator
{
	public function validate($value ,Constraint $constraint)
	{
		$year=idate('Y',$value->getTimestamp());
		$month=idate('m',$value->getTimestamp());
		$day=idate('d',$value->getTimestamp());
		$d=$year."-".$month."-".$day;
		
		
		$sys_date=date('Y-m-d');
		

		$date1=new \DateTime($d);
        $date2=new \DateTime($sys_date);

        $interval = $date1->diff($date2);

        $myage= $interval->y; 

        if ($myage <18){ 

     		$this->context->addViolation(
                $constraint->message,
                array('date' => $d)
            );
		}
	}
}
?>