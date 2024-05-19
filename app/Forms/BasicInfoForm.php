<?php

namespace App\Forms;

use App\Http\Controllers\Settings\ProfileController;
use App\Models\User;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class BasicInfoForm extends BaseForm {

    public function buildForm() {
        /** @var User $user */
        $user = $this->getData('user');
        $class = $this->getData('class');

        $this
            ->add('name', FIELD::TEXT, [
                'label'   => required_label('Name'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => ['class' => 'form-control'],
                'rules'   => ['required', 'string', 'max:255'],
                'value'   => ($user ? $user->name : '')
            ])
            ->add('email', FIELD::TEXT, [
                'label'   => required_label('Email Address'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => array_merge(['class' => 'form-control'], $user ? ['disabled' => true] : []),
                'rules'   => $user ? [] : ['required', 'email', 'max:255', 'unique:users,email'],
                'value'   => ($user ? $user->email : '')
            ])
            ->addIf('is_active', FIELD::CHECKBOX, [
                'label'      => __('Active'),
                'label_attr' => ['class' => 'form-check-label'],
                'wrapper'    => ['class' => 'form-group form-check form-switch form-switch-lg mb-2', 'dir' => 'ltr'],
                'attr'       => ['class' => 'form-check-input'],
                'rules'      => ['sometimes', Rule::in(['1'])],
                'checked'    => ($user ? $user->is_active : false),
            ], $class !== ProfileController::class)
            ->add('submit', Field::BUTTON_SUBMIT, [
                'wrapper' => ['class' => "form-group col-md-12 col-sm-12 mt-2"],
                'label'   => '<span class="fa fa-save"></span> ' . __('Update Profile'),
                'attr'    => ['class' => 'btn btn-success'],
            ]);
    }
}
