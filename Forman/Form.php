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
    protected $submitter;
    protected static $addons;

    /**
     * First argument must be form submitter, next goes all of \Forman\Field\Field
     */
    public function __construct() {
        $args = func_get_args();
        $this->submitter = array_shift($args);
        if (!($this->submitter instanceof \Forman\Render\Submitter)) {
            throw new \Forman\Ex\FormConstructorException("First argument must be instance of \Forman\Render\Submitter!");
        }
        $this->fields = $args;
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
        foreach ($this->fields as $field) {
            $field->populateFromArray($data);
        }

        return $this;
    }

    /**
     * Validate form fields (after populating it)
     * @param \Slim\Application
     * @return bool
     */
    public function validate($app) {
        $result = true;
        foreach ($this->fields as $field) {
            if (!$field->validate($app))
                $result = false;
        }

        return $result;
    }

    /**
     * Get errors array (name_of_field => error_text)
     * @return array
     */
    public function getErrors() {
        $data = array();
        foreach ($this->fields as $field) {
            $data[$field->getName()] = $field->getError();
        }

        return $data;
    }

    /**
     * Get data array (after populating)
     * @return array
     */
    public function getData() {
        $data = array();
        foreach ($this->fields as $field) {
            $data[$field->getName()] = $field->getValue();
        }

        return $data;
    }

    /**
     * Process form - populate it with $data, validate with $app, return data if valid or false
     * @param \Slim\Application
     * @param array
     * @return mixed
     */
    public function process($app, $data) {
        if (!$this->submitter->isSubmitted($data))
            return false;

        $this->populate($data);

        if ($this->validate($app))
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
        $renderer = new $renderer_class($this->submitter);

        foreach ($this->fields as $field) {
            $renderer->attachField($field);
        }

        return $renderer;
    }
}
