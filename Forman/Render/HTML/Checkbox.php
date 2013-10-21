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
    protected $tplAttrs = "value=\"{value}\" name=\"{name}\"";
    protected $tag = "checkbox";
}
