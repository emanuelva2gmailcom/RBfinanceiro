<?php

namespace DocBlock\Common\Annotations\Annotation;

final class Enum
{
    /**
     * @var array
     */
    public $value;

    /**
     * Literal target declaration.
     *
     * @var array
     */
    public $literal;

    /**
     * Annotation constructor.
     *
     * @param array $values
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $values)
    {
        if ( ! isset($values['literal'])) {
            $values['literal'] = [];
        }

        foreach ($values['value'] as $var) {
            if( ! is_scalar($var)) {
                throw new \InvalidArgumentException(sprintf(
                    '@Enum supports only scalar values "%s" given.',
                    is_object($var) ? get_class($var) : gettype($var)
                ));
            }
        }

        foreach ($values['literal'] as $key => $var) {
            if( ! in_array($key, $values['value'])) {
                throw new \InvalidArgumentException(sprintf(
                    'Undefined enumerator value "%s" for literal "%s".',
                    $key , $var
                ));
            }
        }

        $this->value    = $values['value'];
        $this->literal  = $values['literal'];
    }
}
