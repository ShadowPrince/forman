<?php
namespace Forman\Render\HTML;

interface RendererPlugin {
    /**
     * @param \Forman\Field
     * @return \Forman\Render\HTML\HTMLElement
     */
    public function selectElementClass($field);
}
