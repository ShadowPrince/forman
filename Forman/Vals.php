<?php
/**
 * Forman
 *
 * @author Vasiliy Horbachenko <shadow.prince@ya.ru>
 * @copyright 2013 Vasiliy Horbachenko
 * @package shadowprince/forman
 *
 */
namespace Forman;

/**
 * Some default validators for fields
 */
class Vals {
    /**
     * Check is field not empty
     * @return callable
     */
    public static function notEmpty() {
        return function ($a, $v) {
            if ($v === "" || $v === null)
                return _("Field should not be empty!");
        };
    }

    /**
     * Check is field's value length from $min to $max
     * @param int
     * @param int
     * @return callable
     */
    public static function length($min, $max) {
        return function ($a, $v) use ($min, $max) {
            if ($min != null && strlen($v) < $min)
                return sprintf(_("Minimum length - %d symbols!"), $min);
            if ($max != null && strlen($v) > $max)
                return sprintf(_("Maximum length - %d symbols!"), $max);
        };
    }
}