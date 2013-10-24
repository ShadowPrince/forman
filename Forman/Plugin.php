<?php
/**
 * Forman
 *
 * @author Vasiliy Horbachenko <shadow.prince@ya.ru>
 * @copyright 2013 Vasiliy Horbachenko
 * @package shadowprince/forman
 *
 */
namespace Forman;

class Plugin {
    /**
     * Called after form validation,
     * return validation result
     * @param \Forman\Form
     * @param bool
     * @return bool
     */
    public function validate($form, $valid) {
        return $valid;
    }

    /**
     * Called in getFields() Form method, return array of fields
     * @param \Forman\Form
     * @param array
     * @return array
     */
    public function processFields($form, $fields) {
        return $fields;
    }

    /**
     * Called in getErrors() Form method, return array of errors
     * @param \Forman\Form
     * @param array
     * @return array
     */
    public function processErrors($form, $errors) {
        return $errors;
    }

    /**
     * Called in getData() Form method, return data array
     * @param \Forman\Form
     * @param array
     * @return array
     */
    public function processData($form, $data) {
        return $data;
    }
}
