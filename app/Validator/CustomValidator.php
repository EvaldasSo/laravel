<?php

namespace App\Validator;


class CustomValidator {

    public function validateOldPassword($attribute, $value, $parameters, $validator)
    {
        return \Hash::check($value, current($parameters));
    }

}
