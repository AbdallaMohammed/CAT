<?php

namespace CatPHP\Validation;

trait RuleResolver
{
    public function formatRules($rules)
    {
        if (is_string($rules)) {
            $rules = str_contains($rules, '|') ? explode('|', $rules) : $rules;
        }

        return array_map(function ($rule) {
            return $this->mapRule($rule);
        }, (array) $rules);
    }
}