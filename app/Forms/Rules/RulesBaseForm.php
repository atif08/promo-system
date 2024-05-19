<?php

namespace App\Forms\Rules;

use App\Forms\BaseForm;
use App\Models\Rules\Rule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule as ValRule;
use Kris\LaravelFormBuilder\Field;

abstract class RulesBaseForm extends BaseForm {

    /** @var User */
    protected $current_account;
    /** @var Rule */
    protected $rule;
    /** @var boolean */
    protected $dry_run;
    /** @var string */
    protected $rule_type;

    protected function addScheduleFields() {
        $this->add('rule_type', FIELD::HIDDEN, [
            'value' => $this->rule?->rule_type ?: $this->rule_type,
            'rules' => ['required', ValRule::in(array_keys(config('rules')))],
        ]);

        if ($this->dry_run || !empty($this->rule) && $this->rule->dry_run) {
            $this
                ->addIf('dry_run', FIELD::CHECKBOX, [
                    'label'      => __('Dry Run'),
                    'label_attr' => ['class' => 'form-check-label'],
                    'wrapper'    => ['class' => 'form-group form-check form-switch form-switch-lg mb-2', 'dir' => 'ltr'],
                    'attr'       => ['class' => 'form-check-input', 'disabled' => (bool)$this->rule],
                    'rules'      => ['sometimes', ValRule::in(['1'])],
                    'checked'    => true,
                ]);
        } else {
            $this
                ->addHeading('create_schedule', 'Create Schedule', [
                    'wrapper' => ['class' => 'form-group mb-3'],
                ])
                ->add('name', FIELD::TEXT, [
                    'label'   => required_label('Schedule Name'),
                    'wrapper' => ['class' => 'form-group col-lg-6 mb-2 mt-2'],
                    'attr'    => ['class' => 'form-control'],
                    'rules'   => ['required', 'string', 'max:255'],
                    'value'   => $this->rule?->name ?: '',
                ])
                ->add('recurrence_type', FIELD::SELECT, [
                    'label'    => __('Recurrence Type'),
                    'wrapper'  => ['class' => 'form-group col-lg-4 mb-2 mt-2'],
                    'attr'     => ['class' => 'form-control'],
                    'choices'  => Rule::RECURRENCE_TYPES,
                    'selected' => $this->rule?->recurrence_type ?: Rule::R_DAILY,
                    'rules'    => ['required', ValRule::in(array_keys(Rule::RECURRENCE_TYPES))],
                ])
                ->add('repeat_every', FIELD::STATIC, [
                    'label'   => false,
                    'tag'     => 'div',
                    'wrapper' => ['class' => 'form-group col-lg-6 mb-4 mt-4'],
                    'attr'    => ['class' => 'row row-cols-lg-auto align-items-center'],
                    'value'   => view('forms.rules.repeat_every', ['rule' => $this->rule]),
                    'rules'   => ['required', 'numeric', 'min:1'],
                ])
                ->add('week_days', FIELD::CHOICE, [
                    'label'          => __('On Days: '),
                    'label_attr'     => ['class' => 'form-check-label'],
                    'wrapper'        => [
                        'id'    => 'week_days_group',
                        'class' => 'form-group col-lg-12 mb-4 mt-4 row row-cols-lg-auto align-items-center',
                        'style' => $this->rule?->recurrence_type == Rule::R_WEEKLY ? '' : 'display:none'
                    ],
                    'choice_options' => [
                        'wrapper'    => ['class' => 'col-12'],
                        'attr'       => ['class' => 'form-check-input'],
                        'label_attr' => ['class' => 'form-check-label', 'style' => 'font-weight:inherit'],
                    ],
                    'choices'        => Rule::WEEK_DAYS,
                    'selected'       => $this->rule?->week_days ?: null,
                    'expanded'       => true,
                    'multiple'       => true,
                    'rules'          => [
                        'required_if:recurrence_type,WEEKLY',
                        '*in:' . implode(',', array_keys(Rule::WEEK_DAYS)),
                    ],
                ])
                ->add('start_date', FIELD::DATE, [
                    'label'       => __('Start Date'),
                    'wrapper'     => ['class' => 'form-group col-lg-3 mb-2 mt-2'],
                    'attr'        => ['class' => 'form-control datepicker', 'placeholder' => 'yyyy-mm-dd'],
                    'value'       => $this->rule?->start_date ?: Carbon::now()->toDateString(),
                    'date_format' => 'Y-m-d',
                    'rules'       => ['required']
                ])
                ->add('time', FIELD::TIME, [
                    'label'   => __('Time (24 Hour Format)'),
                    'wrapper' => ['class' => 'form-group col-lg-3 mb-2 mt-2'],
                    'attr'    => ['class' => 'form-control timepicker', 'placeholder' => 'hh-mm'],
                    'value'   => $this->rule?->time ?: Carbon::now()->format('H:i'),
                    'rules'   => ['required']
                ])
                ->addSeparator('formula_settings');
        }

        return $this->addHeading('formula_settings', 'Formula Settings');
    }

    protected function addDateRangeField() {
        return $this->add('date_range', FIELD::SELECT, [
            'label'      => __('Date Range'),
            'wrapper'    => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
            'choices'    => Rule::DATE_RANGES,
            'attr'       => ['class' => 'form-control w-25'],
            'selected'   => $this->rule?->date_range ?: 'last_30_days',
            'rules'      => ['required'],
            'help_block' => [
                'text' => __("To account for Amazon's delayed attribution, the actual date range will exclude the last 48 hours and will also shift the start date 2 days prior."),
            ]
        ]);
    }

    protected function addClicksThresholdField() {
        return $this
            ->add('threshold', FIELD::CHOICE, [
                'label'          => __('Threshold'),
                'label_attr'     => ['class' => 'form-check-label'],
                'wrapper'        => [
                    'id'    => 'threshold_group',
                    'class' => 'form-group col-lg-6 mt-4 row row-cols-lg-auto align-items-center'
                ],
                'choice_options' => [
                    'wrapper'    => ['class' => 'col-12'],
                    'attr'       => ['class' => 'form-check-input'],
                    'label_attr' => ['class' => 'form-check-label', 'style' => 'font-weight:inherit'],
                ],
                'choices'        => [
                    'clicks' => __('Clicks'),
                    'spend'  => __('Spend'),
                ],
                'selected'       => $this->rule?->spend_threshold ? 'spend' : 'clicks',
                'expanded'       => true,
                'multiple'       => false,
                'rules'          => ['required'],
            ])
            ->add('threshold_value', Field::NUMBER, [
                'label'   => false,
                'wrapper' => ['class' => 'form-group col-lg-6 mb-2 mt-2'],
                'attr'    => ['class' => 'form-control', 'step' => 'any'],
                'value'   => $this->rule?->clicks_threshold ?: $this->rule?->spend_threshold ?: 0,
                'rules'   => ['required', 'numeric', 'min:0']
            ]);
    }

    protected function addTargetAcosField() {
        return $this->add('target_acos', Field::NUMBER, [
            'label'   => required_label('Target ACOS(%)'),
            'wrapper' => ['class' => 'form-group col-lg-6 mb-2 mt-6'],
            'attr'    => ['class' => 'form-control', 'step' => 'any'],
            'value'   => $this->rule?->target_acos ?: 0,
            'rules'   => ['required', 'numeric', 'min:0']
        ]);
    }

    protected function addMaxAcosField() {
        return $this->add('max_acos', Field::NUMBER, [
            'label'   => required_label('Max ACOS(%)'),
            'wrapper' => ['class' => 'form-group col-lg-6 mb-2 mt-2'],
            'attr'    => ['class' => 'form-control w-75', 'step' => 'any'],
            'value'   => $this->rule?->max_acos ?: 0,
            'rules'   => ['required', 'numeric', 'min:0']
        ]);
    }

    protected function addMaxBidField() {
        return $this->add('max_bid', Field::NUMBER, [
            'label'   => 'Maximum Bid To Set',
            'wrapper' => ['class' => 'form-group col-lg-6 mb-2 mt-2'],
            'attr'    => ['class' => 'form-control', 'step' => 'any'],
            'value'   => $this->rule?->max_bid ?: 0,
            'rules'   => ['required', 'numeric', 'min:0']
        ]);
    }

    protected function addSubmitButton() {
        return $this->add('create_schedule', Field::BUTTON_SUBMIT, [
            'wrapper' => ['class' => "form-group col-md-12 col-sm-12 mt-2"],
            'label'   => '<span class="fa fa-plus"></span> ' . ($this->rule ? __('Update Schedule') : __('Create Schedule')),
            'attr'    => ['class' => 'btn btn-success save-sc'],
        ]);
    }
}
