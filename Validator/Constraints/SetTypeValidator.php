<?php

namespace Okapon\DoctrineSetTypeBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraints\ChoiceValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

use Okapon\DoctrineSetTypeBundle\Exception\TargetClassNotExistException;

/**
 * SetTypeValidator
 *
 * @author Yuichi Okada <yuuichi177@gmail.com>
 */
class SetTypeValidator extends ChoiceValidator
{
    /**
     * Checks if the passed value is valid
     *
     * @param mixed      $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @throws ConstraintDefinitionException
     *
     * @return void
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        /** @var SetType $constraint */
        if (!$constraint->entity) {
            throw new ConstraintDefinitionException('Target is not specified');
        }

        /** @var string $entity class name of inheriting \Okapon\DoctrineSetTypeBundle\DBAL\Types\AbstractSetType */
        $entity = $constraint->entity;
        if (!class_exists($entity)) {
            throw new TargetClassNotExistException('Target class not exist.');
        }

        $constraint->choices = $entity::getValues();
        $constraint->multiple =true;

        parent::validate($value, $constraint);
    }
}
