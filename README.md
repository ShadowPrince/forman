## Forman 
Forman is library for working with forms.
#### in code
    $form = new \Forman\Form(
        new \Forman\Renderer\HTML\InputSubmitter("/email"),
        new \Forman\Field\Value("email"),
        new \Forman\Field\Text("text")
    );

    if ($data = $form->process($app, $app->request()->post())) {
        // send email
    }

    $app->render("email_me", array(
        "form" => $form->getRenderer("\Forman\Render\HTML\Renderer"),
    ));

### in template
    {{ form.render|raw }}
### or
    {{ form.top|raw }}
    That's my form
    {{ form.elements|raw }}
    {{ form.bottom|raw }}
### or even
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

Forman writed for [slimext](http://github.com/shadowprince/slimext), but not attached to it, you can use it with any framework, param `$app` in form's `validate()' and `process()` just passed to validators (for validators like value-not-exists-in-database).
