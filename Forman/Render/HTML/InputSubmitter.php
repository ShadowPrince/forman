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
 * Input submitter
 */
class InputSubmitter extends HTMLElement {
    protected $type="submit";

    public function getValue() {
        return _("Submit");
    }

    public function getCaption() {
        return "";
    }
}
