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
 * HTML renderer
 */
class Renderer implements \Forman\Render\Renderer {
    protected static $registered_plugins = array();
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

    /**
     * Attach field to renderer (adds element)
     * @param \Forman\Field\Field
     */
    public function attachField($field) {
        if ($field instanceof \Forman\Field\Value) {
            $el = new Input();
        } elseif ($field instanceof \Forman\Field\Text) {
            $el = new Textarea();
        } elseif ($field instanceof \Forman\Field\ForeignKey) {
            $el = new ForeignKey();
        } elseif ($field instanceof \Forman\Field\Checkbox) {
            $el = new Checkbox();
        } else {
            $class = null;
            foreach (self::$registered_plugins as $plugin_instance) {
                if (($class = $plugin_instance->selectElementClass($field)) !== null)
                    break;
            }

            if ($class == null)
                throw new \Forman\Ex\HTMLRenderSelectClassException($field);

            $el = new $class();
        }
        $el->collectField($field);

        $this->addElement($el);
    }

    public function addElement($element) {
        $this->elements[] = $element;
    }

    /**
     * Set html form action attribute
     * @param string
     */
    public function setAction($action) {
        $this->action = $action;
    }

    public function setSubmitterEl($el) {
        $this->submitterEl = $el;
    }

    public function elements() {
        return implode(
            "<br />\n", 
            array_map(function ($element) {return $element->render();}, $this->getElements()));
    }

    public function render() {
        return 
            $this->top() . 
            $this->elements() . 
            $this->bottom();
    }

    /** 
     * Get elements array
     * @return array
     */
    public function getElements() {
        return array_merge($this->elements, array($this->submitterEl));
    }

    public function top() {
        return self::renderTemplate($this->top, array(
            "attrs" => $this->topAttributes(),
        ));
    }

    /**
     * Render form opening tag attributes
     * @return string
     */
    public function topAttributes() {
        return self::renderTemplate($this->topAttrs, array(
            "action" => $this->action,
        ));
    }

    public function bottom() {
        return $this->bottom;
    }

    /**
     * Render template $tpl with $params
     * @param string
     * @param array
     * @return string
     */
    public static function renderTemplate($tpl, $params) {
        foreach ($params as $k => $v) {
            $tpl = str_replace(sprintf("{%s}", $k), $v, $tpl);
        }
        return $tpl;
    }

    /**
     * Register renderer plugin
     * @param \Forman\Render\HTML\RendererPlugin
     */
    public static function registerPlugin($plugin) {
        self::$registered_plugins[] = $plugin;
    }
}
