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
namespace Forman;

class Vals {
    public static function notEmpty() {
        return function ($a, $v) {
            if ($v === "" || $v === null)
                return _("Field should not be empty!");
        };
    }

    public static function length($min, $max) {
        return function ($a, $v) use ($min, $max) {
            if ($min != null && strlen($v) < $min)
                return sprintf(_("Minimum length - %d symbols!"), $min);
            if ($max != null && strlen($v) > $max)
                return sprintf(_("Maximum length - %d symbols!"), $max);
        };
    }
}