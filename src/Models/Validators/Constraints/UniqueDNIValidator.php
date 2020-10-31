<?php

namespace Core\Models\Validators\Constraints;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Core\Models\Repositories\TraineeRepository;

class UniqueDNIValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint) {
        
        if (! $constraint instanceof UniqueDNI) {
            throw new UnexpectedTypeException($constraint, UniqueDNI::class);
        }

        $repeatedTrainee = TraineeRepository::findOneByDni($value);
        
        if ($repeatedTrainee) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}