<?php
/**
 * Forman
 *
 * @author Vasiliy Horbachenko <shadow.prince@ya.ru>
 * @copyright 2013 Vasiliy Horbachenko
 * @package shadowprince/forman
 *
 */
namespace Forman\Render;

interface Renderer {
    /**
     * Add element 
     * @param \Forman\Render\Element
     */
    public function addElement($element);

    /**
     * Render form
     * @return mixed
     */
    public function render();

    /**
     * Render elements
     * @return mixed
     */
    public function elements();

    /**
     * Render top
     * @return mixed
     */
    public function top();

    /**
     * Render bottom
     * @return mixed
     */
    public function bottom();
}