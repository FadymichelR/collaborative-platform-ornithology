<?php
namespace AppBundle\Validator;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class BirdName extends Constraint
{
	public $message = "Cet oiseau n'existe pas";
}