<?php

namespace App\Forms\Rules;

use App\Models\Rules\Rule;

class SpKwCutBleedersForm extends RulesBaseForm {

    /** @var string */
    protected $rule_type = Rule::RULE_TYPE_SP_KW_CUT_BLEEDERS;

    public function buildForm() {
        $this->rule = $this->getData('rule');
        $this->dry_run = $this->getData('dry_run');

        $this
            ->addScheduleFields()
            ->addDateRangeField()
            ->addClicksThresholdField()
            ->addSubmitButton();
    }

}
