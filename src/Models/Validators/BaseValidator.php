<?php

namespace Core\Models\Validators;

use Symfony\Component\Validator\Validation;

abstract class BaseValidator
{
    /**
     * validates a model instance
     *
     * @param object $modelInstance
     * @return array
     */
    public static function validate($modelInstance) {
        $groups = static::validationRules($modelInstance);

        $validator = Validation::createValidator();

        foreach ($groups as $group) {
            $violations = $validator->validate($group['value'], $group['rules']);
            
            if (count($violations)) {
                return $violations;
            }
        }
        return [];
    }

    /**
     * must return an arra of groups of validation rules, each group consists of an array
     * with value and rules keys specifying the value to be validated and the rules array of constraints
     *
     * @param object $modelInstance - model instance
     * @return array
     */
    protected abstract static function validationRules($modelInstance);
}