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

interface Element {
    public function __construct($name=null);

    /**
     * Collect parameters from $field
     * @param \Forman\Field\Field
     */
    public function collectField($field);

    public function setName($name);
    public function setValue($val);
    public function setActive($state);
    public function setError($error);
    public function setHint($hint);

    public function getName();
    public function getValue();
    public function isActive();
    public function getError();
    public function getHint();

    /**
     * Render element
     * @return mixed
     */
    public function render();
}