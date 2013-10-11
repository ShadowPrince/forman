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
namespace Forman\Render\HTML;

class InputSubmitter implements \Forman\Render\Submitter {
    protected $name;
    protected $caption;
    protected $action;

    public function __construct($action="", $name="submit", $caption=false) {
        if ($caption === false) {
            $caption = _("Submit");
        }
        $this->name = $name;
        $this->caption = $caption;
        $this->action = $action;
    }

    public function process($form) {
        $input = new InputSubmitterElement($this->name);
        $input->setValue($this->caption);
        $form->setSubmitterEl($input);
        $form->setAction($this->action);
    }

    public function isSubmitted($data) {
        return array_key_exists($this->name, $data);
    }
}

class InputSubmitterElement extends HTMLElement {
    protected $type="submit";

    public function getCaption() {
        return "";
    }
}
