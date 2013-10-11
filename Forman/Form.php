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
namespace Forman;

class Form {
    protected $fields;
    protected $submitter;

    public function __construct() {
        $args = func_get_args();
        $this->submitter = array_shift($args);
        if (!($this->submitter instanceof \Forman\Render\Submitter)) {
            throw new \Forman\Ex\FormConstructorException("First argument must be instance of \Forman\Render\Submitter!");
        }
        $this->fields = $args;
    }

    public function addField($field) {
        $this->fields[] = $field;
    }

    public function populate($data) {
        foreach ($this->fields as $field) {
            $field->populateFromArray($data);
        }
    }

    public function validate($app) {
        $result = true;
        foreach ($this->fields as $field) {
            if (!$field->validate($app))
                $result = false;
        }

        return $result;
    }

    public function getErrors() {
        $data = array();
        foreach ($this->fields as $field) {
            $data[$field->getName()] = $field->getError();
        }

        return $data;
    }

    public function getData() {
        $data = array();
        foreach ($this->fields as $field) {
            $data[$field->getName()] = $field->getValue();
        }

        return $data;
    }

    public function process($app, $data) {
        if (!$this->submitter->isSubmitted($data))
            return false;

        $this->populate($data);

        if ($this->validate($app))
            return $this->getData();
        else
            return false;
    }

    public function getRenderer($renderer_class) {
        $renderer = new $renderer_class($this->submitter);

        foreach ($this->fields as $field) {
            $renderer->addField($field);
        }

        return $renderer;
    }
}
