<?php

namespace App\Forms\Rules;

use App\Models\Rules\Rule;

class SbvKwGForm extends RulesBaseForm {

    /** @var string */
    protected $rule_type = Rule::RULE_TYPE_SBV_KW_G;

    public function buildForm() {
        $this->rule = $this->getData('rule');
        $this->dry_run = $this->getData('dry_run');

        $this
            ->addScheduleFields()
            ->addDateRangeField()
            ->addTargetAcosField()
            ->addSubmitButton();

    }

}
