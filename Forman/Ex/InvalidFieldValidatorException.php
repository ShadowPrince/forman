<?php
/**
 * Forman
 *
 * @author Vasiliy Horbachenko <shadow.prince@ya.ru>
 * @copyright 2013 Vasiliy Horbachenko
 * @package shadowprince/forman
 *
 */
namespace Forman\Ex;

class InvalidFieldValidatorException extends FormException {
    public function __construct($validator) {
        parent::__construct(sprintf(
            "Invalid field validator: \"%s\" (must be callable)", 
            print_r($validator, true)
        ));
    }
}
