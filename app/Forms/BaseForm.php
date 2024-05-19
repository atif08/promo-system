<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

abstract class BaseForm extends Form {

    public function addIf($name, $type = 'text', array $options = [], $condition = true) {
        if ($condition) {
            return $this->add($name, $type, $options);
        }

        return $this;
    }

    protected function addHeading($name, $title, $options = []) {
        $this
            ->add("{$name}_heading", FIELD::STATIC, array_merge([
                'label'   => false,
                'tag'     => 'h4',
                'wrapper' => ['class' => 'form-group mb-3 mt-3'],
                'value'   => __($title)
            ], $options));

        return $this;
    }

    protected function addSeparator($name) {
        $this
            ->add("{$name}_separator", FIELD::STATIC, [
                'label'   => false,
                'tag'     => 'hr',
                'wrapper' => ['class' => 'form-group mb-3 mt-3'],
                'value'   => ''
            ]);

        return $this;
    }

    protected function addLabel($name, $title) {
        $this
            ->add($name . '_label', FIELD::STATIC, [
                'label'   => false,
                'tag'     => 'label',
                'wrapper' => ['class' => 'form-group m-0'],
                'attr'    => ['class' => 'control-label'],
                'value'   => __($title)
            ]);

        return $this;
    }
}
