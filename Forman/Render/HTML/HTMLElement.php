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
 * HTMLElement
 */
abstract class HTMLElement implements \Forman\Render\Element {
    protected $tpl = "{caption}{renderedTag} {error}";
    protected $tplTag = "<{tag} {attrs} />";
    protected $tplAttrs = "type=\"{type}\" value=\"{value}\" name=\"{name}\"";

    protected $type = "text";
    protected $tag = "input";

    protected $name;
    protected $value;
    protected $hint;

    protected $active = true;
    protected $caption = "";
    protected $error = "";

    public function __construct($name=null) {
        $this->setName($name);
    }

    public function collectField($field) {
        $this->setName($field->getName());
        $this->setValue($field->getValue());
        $this->setError($field->getError());
        $this->setCaption($field->getCaption());
        $this->setHint($field->getHint());

        return $this;
    }

    public function getCaption() {
        return $this->caption;
    }

    public function getType() {
        return $this->type;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function getError() {
        return $this->error;
    }

    public function getTag() {
        return $this->tag;
    }

    public function isActive() {
        return $this->active;
    }

    public function getHint() {
        return $this->hint;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setCaption($cap) {
        $this->caption = $cap;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function setActive($state) {
        $this->active = $state;
        return $this;
    }

    public function setError($error) {
        $this->error = $error;
        return $this;
    }

    public function setTag($tag) {
        $this->tag = $tag;
        return $this;
    }

    public function setHint($hint) {
        $this->hint = $hint;
        return $this;
    }

    public function render() {
        return Renderer::renderTemplate($this->tpl, array_merge(
            array(
                "renderedTag" => $this->renderTag(),
                "attrs" => $this->renderAttributes()
            ),
            $this->getRenderArray()
        ));
    }

    /**
     * Get render parameters array
     * @return array
     */
    public function getRenderArray() {
        return array(
            "error" => $this->getError(),
            "tag" => $this->getTag(),
            "caption" => $this->getCaption() ? $this->getCaption() . ": " : "",
            "name" => $this->getName(),
            "value" => $this->getValue(),
            "type" => $this->getType(),
        );
    }

    /*
     * Render only tag
     * @return string
     */
    public function renderTag() {
        return Renderer::renderTemplate($this->tplTag, array_merge(
            array(
                "attrs" => $this->renderAttributes(),
            ),
            $this->getRenderArray()
        ));
    }

    /**
     * Render only attributes
     * @return string
     */
    public function renderAttributes() {
        return Renderer::renderTemplate($this->tplAttrs, 
            $this->getRenderArray()
        );
    }
}
