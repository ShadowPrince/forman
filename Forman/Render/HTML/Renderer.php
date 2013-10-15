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
namespace Forman\Render\HTML;

class Renderer {
    protected $elements = array();
    protected $submitterEl;
    protected $action = "";
    protected $top = "<form {attrs}>";
    protected $topAttrs = "method=\"POST\" action=\"{action}\"";
    protected $bottom = "</form>";

    public function __construct($submitter) {
        $this->submitter = $submitter;
        $this->submitter->process($this);
    }

    public function addField($field) {
        if ($field instanceof \Forman\Field\Value) {
            $el = new Input();
        } elseif ($field instanceof \Forman\Field\Text) {
            $el = new Textarea();
        } elseif ($field instanceof \Forman\Field\ForeignKey) {
            $el = new ForeignKey();
        }

        $el->collectField($field);
        $this->addElement($el);
    }

    public function addElement($element) {
        $this->elements[] = $element;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function setSubmitterEl($el) {
        $this->submitterEl = $el;
    }

    public function renderElements() {
        return implode(
            "<br />\n", 
            array_map(function ($element) {return $element->render();}, $this->getElements()));
    }

    public function render() {
        return 
            $this->top() . 
            $this->renderElements() . 
            $this->bottom();
    }

    public function getElements() {
        return array_merge($this->elements, array($this->submitterEl));
    }

    public function top() {
        return self::renderTemplate($this->top, array(
            "attrs" => $this->topAttributes(),
        ));
    }

    public function topAttributes() {
        return self::renderTemplate($this->topAttrs, array(
            "action" => $this->action,
        ));
    }

    public function bottom() {
        return $this->bottom;
    }

    public static function renderTemplate($tpl, $params) {
        foreach ($params as $k => $v) {
            $tpl = str_replace(sprintf("{%s}", $k), $v, $tpl);
        }
        return $tpl;
    }
}
