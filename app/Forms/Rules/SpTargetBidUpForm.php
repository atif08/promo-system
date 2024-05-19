<?php

namespace App\Forms\Rules;

use App\Models\Rules\Rule;

class SpTargetBidUpForm extends RulesBaseForm {

    /** @var string */
    protected $rule_type = Rule::RULE_TYPE_SP_TARGET_BID_UP;

    public function buildForm() {
        $this->rule = $this->getData('rule');
        $this->dry_run = $this->getData('dry_run');

        $this
            ->addScheduleFields()
            ->addDateRangeField()
            ->addMaxBidField()
            ->addMaxAcosField()
            ->addSubmitButton();

    }

}
