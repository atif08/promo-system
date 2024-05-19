<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;

class ChangePasswordForm extends BaseForm {

    public function buildForm() {

        $this
            ->add('password', FIELD::PASSWORD, [
                'label'   => required_label('New Password'),
                'wrapper' => ['class' => 'form-group mb-2 col-lg-12'],
                'attr'    => ['class' => 'form-control'],
                'rules'   => ['required', 'confirmed', 'min:8']
            ])
            ->add('password_confirmation', FIELD::PASSWORD, [
                'label'   => required_label('Confirm Password'),
                'wrapper' => ['class' => 'form-group mb-2 col-lg-12'],
                'attr'    => ['class' => 'form-control'],
                'rules'   => ['required', 'min:8']
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'wrapper' => ['class' => "form-group col-md-12 col-sm-12 mt-2"],
                'label'   => '<span class="fa fa-save"></span> ' . __('Update Password'),
                'attr'    => ['class' => 'btn btn-success'],
            ]);

    }
}
