<?php
/**
 * Forman
 *
 * @author Vasiliy Horbachenko <shadow.prince@ya.ru>
 * @copyright 2013 Vasiliy Horbachenko
 * @package shadowprince/forman
 *
 */
namespace Forman\Field;

/**
 * Foreign key field - field with value and a url to detached object
 */
class ForeignKey extends Field {
    protected $link;

    public function __construct() {
        $args = func_get_args();

        $name = array_shift($args);
        $this->link = array_shift($args);

        call_user_func_array("parent::__construct", array_merge(array($name), $args));
    }

    public function getLink() {
        return $this->link;
    }
}