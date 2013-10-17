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
 * Input for foreign key field 
 */
class ForeignKey extends HTMLElement {
    protected $tpl = "{caption}{renderedTag} <a href=\"{url}\">-></a>{error}";
    protected $tplTag = "<{tag} {attrs} /> ";
    protected $tplAttrs = "type=\"{type}\" value=\"{value}\" name=\"{name}\"";
    protected $type = "text";
    protected $tag = "input";

    protected $url;

    public function collectField($field) {
        $this->url = $field->getLink();

        parent::collectField($field);
    }

    public function getUrl() {
        return $this->url;
    }

    public function getRenderArray() {
        return array_merge(
            parent::getRenderArray(),
            array(
                "url" => $this->getUrl()
            ));
    }
}