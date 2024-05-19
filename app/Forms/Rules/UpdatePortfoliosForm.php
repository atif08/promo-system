<?php

namespace App\Forms\Rules;

use App\Models\AdsModels\Portfolios;
use App\Models\Rules\Rule;
use Illuminate\Validation\Rule as ValRule;
use Kris\LaravelFormBuilder\Field;

class UpdatePortfoliosForm extends RulesBaseForm {

    /** @var string */
    protected $rule_type = Rule::RULE_TYPE_UPDATE_PORTFOLIOS;

    public function buildForm() {
        $this->rule            = $this->getData('rule');
        $this->dry_run         = $this->getData('dry_run');
        $this->current_account = $this->getData('current_account');

        $portfolios = Portfolios::query()
            ->where('user_id', $this->current_account->id)
            ->where('policy', Portfolios::POLICY_DATE_RANGE)
            ->pluck('name', 'id')->toArray();

        $this
            ->addScheduleFields()
            ->add('portfolios', FIELD::CHOICE, [
                'label'      => __('Portfolios'),
                'wrapper'    => ['class' => 'form-group col-lg-12 mb-2 mt-2'],
                'attr'       => ['class' => 'select2 form-control', 'id' => 'portfolios'],
                'choices'    => $portfolios,
                'selected'   => $this->rule?->portfolios ?: [],
                'rules'      => [
                    'sometimes', '*in:' . implode(',', array_keys($portfolios)),
                ],
                'expanded'   => false,
                'multiple'   => true,
                'help_block' => [
                    'text' => 'Settings here will only
                    apply to portfolios with DateRange budget policy and will have no effect otherwise.'
                ],

//                'help_block' => [
//                    'text' => 'Settings here will only
//                    apply to portfolios with DateRange budget policy and will have no effect otherwise.' . "<br/>
//                    <a href='' class='fetch-portfolios'><span class='fa fa-external-link-alt'> &nbsp;Fetch Portfolios</span></a>"
//                ]
            ])
            ->add('portfolios_start_date', FIELD::SELECT, [
                'label'    => __('Start Date'),
                'wrapper'  => ['class' => 'form-group col-lg-6 mb-2 mt-2'],
                'choices'  => [
                    Rule::PORTFOLIOS_START_NO_CHANGE   => 'Do not change',
                    Rule::PORTFOLIOS_START_NEXT_DAY    => 'Next Day',
                    Rule::PORTFOLIOS_START_CURRENT_DAY => 'Current Day',
                ],
                'attr'     => ['class' => 'form-control'],
                'selected' => $this->rule?->portfolios_start_date ?: Rule::PORTFOLIOS_START_NO_CHANGE,
                'rules'    => [
                    'required',
                    ValRule::in([
                        Rule::PORTFOLIOS_START_NO_CHANGE,
                        Rule::PORTFOLIOS_START_NEXT_DAY,
                        Rule::PORTFOLIOS_START_CURRENT_DAY,
                    ])
                ],
            ])
            ->add('portfolios_end_days', Field::NUMBER, [
                'label'      => __('Number of days to end after start date'),
                'wrapper'    => ['class' => 'form-group col-lg-6 mb-2 mt-2'],
                'attr'       => ['class' => 'form-control', 'step' => '1'],
                'value'      => $this->rule?->portfolios_end_days ?: '',
                'rules'      => ['sometimes', 'min:0'],
                'help_block' => [
                    'text' => 'Leave blank to leave End Date unchanged. Set to zero (0) to set End Date to same date as Start Date.'
                ]
            ])
            ->addSubmitButton();
    }
}
