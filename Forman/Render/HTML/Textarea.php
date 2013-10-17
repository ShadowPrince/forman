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
 * Textarea HTML element
 */
class TextArea extends HTMLElement {
    protected $tpl = "{caption}{renderedTag} {error}";
    protected $tplTag = "<{tag} {attrs}>{value}</{tag}>";
    protected $tplAttrs = "name=\"{name}\"";
    protected $type = null;
    protected $tag = "textarea";
}