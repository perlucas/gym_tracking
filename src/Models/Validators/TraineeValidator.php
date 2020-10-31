<?php

namespace Core\Models\Validators;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Core\Models\Validators\Constraints\UniqueDNI;

class TraineeValidator extends BaseValidator
{
    protected static function validationRules($trainee) {
        return [
            [
                'value' => $trainee->getFullName(),
                'rules' => [
                    new NotBlank([
                        'message' => 'El nombre de la persona no puede contener números ni estar vacío'
                    ]),
                    new Regex([
                        'message' => 'El nombre de la persona no puede contener números ni estar vacío',
                        'pattern' => "/^[a-zA-Z\s]{3,}$/"
                    ])
                ]
            ],

            [
                'value' => $trainee->getDni(),
                'rules' => [
                    new NotBlank([
                        'message' => 'El DNI debe ser numérico, sin espacios ni puntos'
                    ]),
                    new Regex([
                        'message' => 'El DNI debe ser numérico, sin espacios ni puntos',
                        'pattern' => "/^\d{8,}$/"
                    ]),
                    new UniqueDNI()
                ]
            ],

            [
                'value' => $trainee->getPhone(),
                'rules' => [
                    new NotBlank([
                        'message' => 'El número de teléfono no puede contener letras ni estar vacío'
                    ]),
                    new Regex([
                        'message' => 'El número de teléfono no puede contener letras ni estar vacío',
                        'pattern' => "/^[\d\s\-]{3,}$/"
                    ])
                ]
            ],

            [
                'value' => $trainee->getAddress(),
                'rules' => [
                    new NotBlank([
                        'message' => 'El campo dirección no debe estar vacío'
                    ])
                ]
            ]
        ];
    }
}