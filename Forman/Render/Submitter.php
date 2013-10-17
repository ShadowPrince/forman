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

interface Submitter {
    /**
     * Attach submitter to renderer
     * @param \Forman\Render\Renderer
     */
    public function process($renderer);

    /**
     * Is form submitted on $data?
     * @param array
     * @return bool
     */
    public function isSubmitted($data);
}