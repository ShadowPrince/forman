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

class InvalidFieldException extends FormException {
    public function __construct($validator) {
        parent::__construct(sprintf(
            "Invalid field: \"%s\" (must be instance of \Forman\Field)", 
            print_r($validator, true)
        ));
    }
}
