<?php

namespace App\Forms;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Settings\ProfileController;
use App\Models\PromoCode;
use App\Models\User;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Field;

class PromoCodeForm extends BaseForm {

    public function buildForm() {
        /** @var PromoCode $promo_code */
        $promo_code = $this->getData('promo_code');
        $class = $this->getData('class');

        $this
            ->add('promo_code', FIELD::TEXT, [
                'label'   => required_label('Promo Code'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => ['class' => 'form-control'],
                'rules'   => ['required', 'string', 'max:255'],
//                'rules'   => ['required', 'string', 'max:255','regex:/^(MALE|FEMALE)[A-Z0-9]*$/'],
                'value'   => ($promo_code ? $promo_code->promo_code : '')
            ])
            ->add('start_date', FIELD::DATE, [
                'label'   => required_label('Start Date'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => array_merge(['class' => 'form-control']),
                'rules'   =>  ['required','date','after_or_equal:today'],
                'value'   => ($promo_code ? $promo_code->start_date : '')
            ])

            ->add('end_date', FIELD::DATE, [
                'label'   => required_label('End Date'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => array_merge(['class' => 'form-control']),
                'rules'   => ['required','date','after_or_equal:start_date'],
                'value'   => ($promo_code ? $promo_code->end_date : '')
            ])
            ->add('usage_limit', FIELD::TEXT, [
                'label'   => required_label('Usage Limit'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => array_merge(['class' => 'form-control']),
                'rules'   => ['required','numeric', 'min:1'],
                'value'   => ($promo_code ? $promo_code->usage_limit : '')
            ])

            ->add('gender', FIELD::SELECT, [
                'label'    => __('User Type'),
                'wrapper'  => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr'     => ['class' => 'form-select'],
                'choices'  => ["male"=>"Male",'female'=>'Female'],
//                'selected' =>  ,
                'rules'    => ['required'],
            ])->add('type', FIELD::SELECT, [
                'label'    => __('Promo Code Type'),
                'wrapper'  => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr'     => ['class' => 'form-select'],
                'choices'  => ["flat"=>"Flat",'percent'=>'By Percent'],
//                'selected' =>  ,
                'rules'    => ['required'],
            ])
            ->add('amount', FIELD::TEXT, [
                'label'   => required_label('Amount'),
                'wrapper' => ['class' => 'form-group col-lg-12 mb-2'],
                'attr'    => array_merge(['class' => 'form-control']),
                'rules'   => ['required','numeric', 'min:0'],
                'value'   => ($promo_code ? $promo_code->amount : '')
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'wrapper' => ['class' => "form-group col-md-12 col-sm-12 mt-2"],
                'label'   => ($promo_code) ? '<span class="fa fa-save"></span> '.__('Update') :'<span class="fa fa-save"></span> '. __('Create'),
                'attr'    => ['class' => 'btn btn-success'],
            ]);
    }
}
