<?php

namespace CatPHP\Validation;

class Validator
{
    use RuleMapper;
    use RuleResolver;

    /**
     * @var array
     */
    protected array $rules = [];

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @var \CatPHP\ErrorBag
     */
    protected ErrorBag $errorBag;

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->errorBag = new ErrorBag();
    }

    /**
     * Make a validator instance.
     *
     * @param array $data
     * @param array $rules
     *
     * @return self
     */
    public function make($rules, $data)
    {
        $this->setData($data)
            ->setRules($rules);

        $this->validate();

        return $this;
    }

    /**
     * Apply rules on stored data.
     *
     * @return void
     */
    public function validate()
    {
        foreach ($this->rules as $field => $rules) {
            foreach ($this->formatRules($rules) as $rule) {
                if (
                    ! $rule->apply($field, $this->data[$field] ?? null, $this->data)
                ) {
                    $this->errorBag->add(
                        $field,
                        str_replace('%s', $field, $rule->message())
                    );
                }
            }
        }
    }

    /**
     * @return self
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return self
     */
    public function setRules($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Reterive message bag.
     *
     * @return \CatPHP\ErrorBag
     */
    public function getBag()
    {
        return $this->errorBag;
    }
}