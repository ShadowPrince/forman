<?php
namespace Forman\Ex;

class HTMLRenderSelectClassException extends FormException {
    public function __construct($field) {
        parent::__construct(sprintf("Cant select class for field: %s", print_r($field, true)));
    }
}
