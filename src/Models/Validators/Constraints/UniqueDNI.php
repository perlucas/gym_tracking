<?php

namespace Core\Models\Validators\Constraints;
use Symfony\Component\Validator\Constraint;

class UniqueDNI extends Constraint
{
    public $message = 'El DNI "{{ value }}" ya pertenece a otra persona';
}