<?php
/**
 * Forman
 *
 * @author Vasiliy Horbachenko <shadow.prince@ya.ru>
 * @copyright 2013 Vasiliy Horbachenko
 * @package shadowprince/forman
 *
 */
namespace Forman\Field;

/**
 * Main class for fields 
 */
class Field {
    protected $validators = array();
    protected $value;
    protected $error = null;
    protected $hint;
    protected $name;
    protected $caption;

    /**
     * Constructor.
     * First argument must be field name, others - validators
     */
    public function __construct() {
        $args = func_get_args();
        $this->name = array_shift($args);
        $this->validators = $args;
        foreach ($args as $val) {
            if (!is_callable($val)) {
                throw new \Forman\Ex\InvalidFieldValidatorException($val);
            }
        }

        $this->setCaption(self::getNameCaption($this->name));
    }

    /**
     * Populate field with $value
     * @param mixed
     * @return \Forman\Field\Field
     */
    public function populate($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * Populate field from values array (populate with $data["field_name"])
     * @param array
     * @return \Forman\Field\Field
     */
    public function populateFromArray($data) {
        $this->populate($data[self::normalizeName($this->getName())]);

        return $this;
    }

    /**
     * Validate field 
     * @return bool
     */
    public function validate() {
        foreach ($this->validators as $validator) {
            $this->error = call_user_func_array(
                $validator, 
                array_merge(array($this->getValue()), func_get_args())
            );
            if (!empty($this->error))
                return false;
        }
        return true;
    }

    public function getError() {
        return $this->error;
    }

    public function getNormalizedName() {
        return self::normalizeName($this->getName());
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

    /**
     * Make caption from name (replace underscores with spaces)
     * @param string
     * @return string
     */
    public static function getNameCaption($name) {
        return str_replace("_", " ", $name);
    }

    /**
     * Normalize name for HTTP. Replaces any character out of range [a-z0-9_] to underscore.
     * @param string
     * @return string
     */
    public static function normalizeName($name) {
        return preg_replace("/[^a-z0-9_]+/i", "_", $name);
    }
}
