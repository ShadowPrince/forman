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

class Plugin {
    /**
     * Called when default implementation can't choose class for element.
     * Return class (\Forman\Render\HTML\HTMLElement) or null
     * @param \Forman\Field
     * @return class
     */
    public function selectElementClass($field) {
        return null;
    }

    /**
     * Called when renderer form elements array at getElements() method.
     * Return updated $elements array.
     * @param array
     * @return array
     */
    public function processElements($elements) {
        return $elements;
    }
}
