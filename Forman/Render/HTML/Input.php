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
 * Input html element
 */
class Input extends HTMLElement {
    protected $tpl = "{caption}{renderedTag} {error}";
    protected $tplTag = "<{tag} {attrs} />";
    protected $tplAttrs = "type=\"{type}\" value=\"{value}\" name=\"{name}\"";
    protected $type = "text";
    protected $tag = "input";
}