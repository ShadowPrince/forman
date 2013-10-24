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
 * Input hidden html element
 */
class Hidden extends HTMLElement {
    protected $type = "hidden";

    public function getCaption() {
        return "";
    }
}

