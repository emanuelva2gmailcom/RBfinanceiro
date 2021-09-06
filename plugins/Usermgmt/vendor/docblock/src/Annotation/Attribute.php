<?php


namespace DocBlock\Common\Annotations\Annotation;


final class Attribute
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var boolean
     */
    public $required = false;
}
