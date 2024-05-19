<?php

namespace App\Forms;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Settings\ProfileController;
use App\Models\User;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class UserForm extends BaseForm {

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
            ->add('dob', FIELD::DATE, [
                'label'   => required_label('Date Of Birth'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => array_merge(['class' => 'form-control']),
                'rules'   => ['required','date'],
                'value'   => ($user ? $user->dob : '')
            ])
            ->add('password', FIELD::PASSWORD, [
                'label'   => required_label('New Password'),
                'wrapper' => ['class' => 'form-group mb-2 col-lg-12'],
                'attr'    => ['class' => 'form-control'],
                'rules'   => $user ? ['sometimes','nullable','min:8','confirmed'] : ['required', 'confirmed', 'min:8']
            ])
            ->add('password_confirmation', FIELD::PASSWORD, [
                'label'   => required_label('Confirm Password'),
                'wrapper' => ['class' => 'form-group mb-2 col-lg-12'],
                'attr'    => ['class' => 'form-control'],
                'rules'   => $user ? [] : ['required', 'min:8']
            ])
            ->add('user_type', FIELD::SELECT, [
                'label'    => __('User Type'),
                'wrapper'  => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr'     => ['class' => 'form-select'],
                'choices'  => UserTypeEnum::forDropDown(),
//                'selected' =>  ,
                'rules'    => ['required'],
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'wrapper' => ['class' => "form-group col-md-12 col-sm-12 mt-2"],
                'label'   => ($user) ? '<span class="fa fa-save"></span> '.__('Update User') :'<span class="fa fa-save"></span> '. __('Create User'),
                'attr'    => ['class' => 'btn btn-success'],
            ]);
    }
}
