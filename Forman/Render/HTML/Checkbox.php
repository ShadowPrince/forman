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
 * Checkbox html element
 */
class Checkbox extends HTMLElement {
    protected $tpl = "{caption}{renderedTag} {error}";
    protected $tplTag = "<{tag} {attrs} />";
    protected $tplAttrs = "type=\"{type}\" value=\"1\" name=\"{name}\" {checked} ";
    protected $type = "checkbox";
    protected $tag = "input";

    public function getRenderArray() {
        return array_merge(array(
            "checked" => (bool) $this->getValue() ? "checked" : "",
        ), parent::getRenderArray());
    }
}
