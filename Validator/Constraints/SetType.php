<?php

namespace Okapon\DoctrineSetTypeBundle\Validator\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraints\Choice;

/**
 * SET type constraint
 *
 * @author Yuichi Okada <yuuichi177@gmail.com>
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class SetType extends Choice
{
    /**
     * @param string        $entity
     * @param string|null   $message
     * @param string[]|null $groups
     * @param mixed         $payload
     */
    public function __construct(public string $entity, ?string $message = null, ?array $groups = null, mixed $payload = null)
    {
        parent::__construct(
            choices: $entity::getValues(),
            strict: true,
            message: $message,
            groups: $groups,
            payload: $payload
        );
    }
}
