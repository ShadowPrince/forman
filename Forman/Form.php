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

/**
 * Main form class
 */
class Form {
    protected $fields;
    protected static $registered_plugins = array();

    /**
     * Arguments of \Forman\Field\Field
     */
    public function __construct() {
        $args = func_get_args();
        $this->fields = $args;

        foreach ($args as $field) {
            if (!($field instanceof \Forman\Field\Field))
                throw new \Forman\Ex\InvalidFieldException($field);
        }
    }

    /**
     * Add field to form
     * @param \Forman\Field\Field
     * @return \Forman\Form
     */
    public function addField($field) {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Populate form fields with data
     * @param array
     * @return \Forman\Form
     */
    public function populate($data) {
        foreach ($this->getFields() as $field) {
            $field->populateFromArray($data);
        }

        return $this;
    }

    /**
     * Validate form fields (after populating it)
     * @return bool
     */
    public function validate() {
        $result = true;
        foreach ($this->getFields() as $field) {
            if (!call_user_func_array(array($field, "validate"), func_get_args())) {
                $result = false;
            }
        }
        foreach (self::getPlugins() as $plg) {
            $result = $plg->validate($this, $result);
        }

        return $result;
    }

    /**
     * Get all fields
     * @return array
     */
    public function getFields() {
        $fields = $this->fields;

        foreach (self::getPlugins() as $plg)
            $fields = $plg->processFields($form, $fields);

        return $fields;
    }

    /**
     * Get errors array (name_of_field => error_text)
     * @return array
     */
    public function getErrors() {
        $data = array();
        foreach ($this->getFields() as $field) {
            $data[$field->getName()] = $field->getError();
        }

        foreach (self::getPlugins() as $plg)
            $data = $plg->processErrors($form, $data);

        return $data;
    }

    /**
     * Get data array (after populating)
     * @return array
     */
    public function getData() {
        $data = array();
        foreach ($this->getFields() as $field) {
            $data[$field->getName()] = $field->getValue();
        }

        foreach (self::getPlugins() as $plg)
            $data = $plg->processData($form, $data);

        return $data;
    }

    /**
     * Process form - populate it with data (fist argument), validate with additional arguments (all after data array),
     * return data if valid or false if not.
     * @return mixed
     */
    public function process() {
        $args = func_get_args();
        $data = array_shift($args);

        if (!empty(
            array_filter(
                $this->getFields(), 
                function ($field) use ($data) {
                    return !array_key_exists($field->getNormalizedName(), $data); 
                })
            )) 
            return false;

        $this->populate($data);

        if (call_user_func_array(array($this, "validate"), $args))
            return $this->getData();
        else
            return false;
    }

    /**
     * Get renderer of $renderer_class for this form
     * @param class
     * @return \Forman\Render\Renderer
     */
    public function getRenderer($renderer_class) {
        $renderer = new $renderer_class();

        foreach ($this->getFields() as $field) {
            $renderer->attachField($field);
        }

        return $renderer;
    }

    /**
     * Get registered plugins
     * @return array
     */
    public static function getPlugins() {
        return self::$registered_plugins;
    }

    /**
     * Register plugin
     * @param \Forman\Plugin
     */
    public static function registerPlugin($plugin_instance) {
        return self::$registered_plugins[] = $plugin_instance;
    }
}
