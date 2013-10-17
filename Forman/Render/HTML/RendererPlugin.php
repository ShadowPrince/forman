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

interface RendererPlugin {
    /**
     * Called when default implementation can't choose class for element.
     * Can return class or null
     * @param \Forman\Field
     * @return class
     */
    public function selectElementClass($field);
}