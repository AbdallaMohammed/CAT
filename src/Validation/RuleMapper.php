<?php

namespace CatPHP\Validation;

trait RuleMapper
{
    /**
     * Rule mapper for validation rules.
     *
     * @var array
     */
    protected array $ruleMapper = [
        'required' => Rules\RequiredRule::class,
        'max' => Rules\MaxRule::class,
        'confirmed' => Rules\ConfirmedRule::class,
    ];

    /**
     * Invoke rule.
     *
     * @param string $rule
     * @return boolesn
     */
    protected function mapRule(string $rule)
    {
        $parts = explode(':', $rule);

        $rule = $parts[0];
        $options = [];

        if (count($parts) > 1) {
            $options = end($parts);
            $options = explode(',', $options);
        }

        return new $this->ruleMapper[$rule](...$options);
    }
}