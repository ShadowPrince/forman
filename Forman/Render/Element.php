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
namespace Forman\Render;

interface Element {
    public function __construct($name=null);

    public function setName($name);
    public function setValue($val);
    public function setActive($state);
    public function setError($error);

    public function getName();
    public function getValue();
    public function isActive();
    public function getError();

    public function render();
}