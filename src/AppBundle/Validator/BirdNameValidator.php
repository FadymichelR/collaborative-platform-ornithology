<?php

namespace AppBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;

class BirdNameValidator extends ConstraintValidator
{
	public function __construct(EntityManagerInterface $em)
	{
		$this->em           = $em;
	}

	public function validate($value, Constraint $constraint)
	{
		$repository = $this->em
		  ->getRepository('AppBundle:Observation')
		;

		$listAdverts = $repository->findBy(
			array('birdName' => $value)                              
		);

		if ($listAdverts == Null) {
			$this->context->addViolation($constraint->message);
		}

	}
}