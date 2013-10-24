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
    protected $submitter;

    protected $action = "";
    protected $method = "POST";

    protected $top = "<form {attrs}>";
    protected $topAttrs = "method=\"{method}\" action=\"{action}\"";
    protected $bottom = "</form>";

    public function __construct() {
        $this->submitter = (new InputSubmitter())->setValue(_("Submit"));
    }

    public function addElement($element) {
        $this->elements[] = $element;
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

    public function top() {
        return self::renderTemplate($this->top, array(
            "attrs" => $this->topAttributes(),
        ));
    }

    public function bottom() {
        return $this->bottom;
    }

    /** 
     * Get elements array
     * @return array
     */
    public function getElements() {
        $elements = array_merge($this->elements, array(new InputSubmitter()));

        array_map(function ($plugin) use (&$elements) {
            $elements = $plugin->processElements($elements);
        }, self::getPlugins());

        return $elements;
    }

    /**
     * Render form opening tag attributes
     * @return string
     */
    public function topAttributes() {
        return self::renderTemplate($this->topAttrs, array(
            "action" => $this->action,
            "method" => $this->method,
        ));
    }

    /**
     * Set html form action attribute
     * @param string
     * @return \Forman\Render\HTML\Renderer
     */
    public function setAction($action) {
        $this->action = $action;
        return $this;
    }

    /**
     * Set method to GET
     * @return \Forman\Render\HTML\Renderer
     */
    public function GET() {
        return $this->setMethod("GET");
    }

    /**
     * Set html form method attribute
     * @param string
     * @return \Forman\Render\HTML\Renderer
     */
    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }

    /**
     * Attach field to renderer (adds element)
     * @param \Forman\Field\Field
     */
    public function attachField($field) {
        $class = null;
        foreach (self::getPlugins() as $plugin_instance) {
            if (($class = $plugin_instance->selectElementClass($field)) !== null)
                break;
        }

        if ($class == null) {
            if ($field instanceof \Forman\Field\Value)
                $el = new Input();
            elseif ($field instanceof \Forman\Field\Text)
                $el = new Textarea();
            elseif ($field instanceof \Forman\Field\ForeignKey)
                $el = new ForeignKey();
            elseif ($field instanceof \Forman\Field\Checkbox)
                $el = new Checkbox();
            elseif ($field instanceof \Forman\Field\Hidden)
                $el = new Hidden();
            else
                throw new \Forman\Ex\HTMLRenderSelectClassException($field);
        } else 
            $el = new $class();

        $el->collectField($field);
        $this->addElement($el);
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

    /**
     * Get registered plugins
     * @return array
     */
    public static function getPlugins() {
        return self::$registered_plugins;
    }
}
