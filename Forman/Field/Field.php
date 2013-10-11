<?php
/**
 * Forman
 *
 * @author Vasiliy Horbachenko <shadow.prince@ya.ru>
 * @copyright 2013 Vasiliy Horbachenko
 * @version 1.0
 * @package Form
 *
 */
namespace Forman\Field;

class Field {
    protected $validators = array();
    protected $value;
    protected $error = null;
    protected $hint;
    protected $name;
    protected $caption;

    public function __construct() {
        $args = func_get_args();
        $this->name = array_shift($args);
        $this->validators = $args;

        $this->setCaption(self::getNameCaption($this->name));
    }

    public function populate($value) {
        $this->value = $value;
    }

    public function populateFromArray($data) {
        $this->value = $data[self::normalizeName($this->getName())];
    }

    public function validate($app) {
        foreach ($this->validators as $validator) {
            $this->error = call_user_func($validator, $app, $this->getValue());
            if (!empty($this->error))
                return false;
        }
        return true;
    }

    public function getError() {
        return $this->error;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function getCaption() {
        return $this->caption;
    }

    public function setValue($val) {
        if (is_string($val))
            $this->value = $val;
        elseif ($val instanceof \DateTime)
            $this->value = $val->format("Y-m-d H:i:s");
        return $this;
    }

    public function setCaption($cap) {
        $this->caption = $cap;
        return $this;
    }

    public function setHint($hint) {
        $this->hint = $hint;
        return $this;
    }

    public function getHint() {
        return $this->hint;
    }

    public static function getNameCaption($name) {
        return str_replace("_", " ", $name);
    }

    public static function normalizeName($name) {
        return preg_replace("/[^a-z0-9_]+/i", "_", $name);
    }
}