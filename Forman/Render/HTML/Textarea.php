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

class TextArea extends HTMLElement {
    protected $tpl = "{caption}{renderedTag} {error}";
    protected $tplTag = "<{tag} {attrs}>{value}</{tag}>";
    protected $tplAttrs = "name=\"{name}\"";
    protected $type = null;
    protected $tag = "textarea";
}