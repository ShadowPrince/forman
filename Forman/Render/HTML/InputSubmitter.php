<?php
/**
 * Forman
 *
 * @author Vasiliy Horbachenko <shadow.prince@ya.ru>
 * @copyright 2013 Vasiliy Horbachenko
 * @package shadowprince/forman
 *
 */
namespace Forman\Render\HTML;

/**
 * Input submitter
 * @TODO: move away from HTML
 */
class InputSubmitter implements \Forman\Render\Submitter {
    protected $name;
    protected $caption;
    protected $action;
    protected $method;

    public function __construct($action="", $name="submit", $caption=false) {
        if ($caption === false) {
            $caption = _("Submit");
        }
        $this->name = $name;
        $this->caption = $caption;
        $this->action = $action;
        $this->method = "POST";
    }

    public function process($form) {
        $input = new InputSubmitterElement($this->name);
        $input->setValue($this->caption);
        $form->setSubmitterEl($input);
        $form->setAction($this->getAction());
        $form->setMethod($this->getMethod());
    }

    public function isSubmitted($data) {
        return array_key_exists($this->name, $data);
    }

    /**
     * Set action
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * Set method
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * @param string
     * @return \Forman\Render\HTML\InputSubmitter
     */
    public function setMethod($method) {
        $this->method = $method;

        return $this;
    }
}

class InputSubmitterElement extends HTMLElement {
    protected $type="submit";

    public function getCaption() {
        return "";
    }
}
