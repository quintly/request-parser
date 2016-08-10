<?php

namespace MPScholten\RequestParser;

class IntParser extends AbstractValueParser
{
    protected function describe()
    {
        return "an integer";
    }

    protected function parse($value)
    {
        return is_numeric($value) ? (int)$value : null;
    }

    /**
     * @param int $defaultValue
     * @return int
     */
    public function defaultsTo($defaultValue)
    {
        return parent::defaultsTo($defaultValue);
    }

    /**
     * @throws \Exception
     * @return int
     */
    public function required($invalidValueMessage = null, $notFoundMessage = null)
    {
        return parent::required($invalidValueMessage, $notFoundMessage);
    }

    /**
     * @param int $minvalue
     * @param int $maxValue
     * @return InRangeParser
     */
    public function inRange($minvalue, $maxValue)
    {
        return new InRangeParser($this->config, $this->name, $this->value, $minvalue, $maxValue, 'int');
    }
}
