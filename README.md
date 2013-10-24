## Forman 
Forman is library for working with forms.
#### in code
```php
$form = new \Forman\Form(
    new \Forman\Field\Value("email"),
    new \Forman\Field\Text("text"),
    (new \Forman\Field\Checkbox("subscr"))->setValue(1)
);

if ($data = $form->process($_POST)) {
    // send email
}

render_template("contact.html", array(
    "form" => $form->getRenderer("\Forman\Render\HTML\Renderer")
        ->setAction("/contact")
        ->GET(),
));
```

### in template
```html
{{ form.render|raw }}
```
### or
```html
{{ form.top|raw }}
That's my form
{{ form.elements|raw }}
{{ form.bottom|raw }}
```
### or even
```html
<form action="{{ form.getAction }}" method="POST">
    {% for field in form.getFields %}
        {% if field.getCaption %}
            <label class="caption">{{ field.getCaption }}</label>
        {% endif %}
        <span class="field">
            {{ field.renderTag|raw }}
        </span>
        {% if field.getHint %}
            <span class="hint">
                {{ field.getHint }}
            </span>
        {% endif %}
    {% endfor %}
</form>
```

Forman writed for [slimext](http://github.com/shadowprince/slimext), but not attached to it, you can use it with any framework or without it. Additional parameters to `process` passed to form validators (you can provide orm object or application instance).
