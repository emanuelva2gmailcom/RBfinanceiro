<?php

namespace DocBlock\Common\Annotations;


class SimpleAnnotationReader implements Reader
{
    /**
     * @var DocParser
     */
    private $parser;

    /**
     * Constructor.
     *
     * Initializes a new SimpleAnnotationReader.
     */
    public function __construct()
    {
        $this->parser = new DocParser();
        $this->parser->setIgnoreNotImportedAnnotations(true);
    }

    /**
     * Adds a namespace in which we will look for annotations.
     *
     * @param string $namespace
     *
     * @return void
     */
    public function addNamespace($namespace)
    {
        $this->parser->addNamespace($namespace);
    }

    /**
     * {@inheritDoc}
     */
    public function getClassAnnotations(\ReflectionClass $class)
    {
        return $this->parser->parse($class->getDocComment(), 'class '.$class->getName());
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodAnnotations(\ReflectionMethod $method)
    {
        return $this->parser->parse($method->getDocComment(), 'method '.$method->getDeclaringClass()->name.'::'.$method->getName().'()');
    }

    /**
     * {@inheritDoc}
     */
    public function getPropertyAnnotations(\ReflectionProperty $property)
    {
        return $this->parser->parse($property->getDocComment(), 'property '.$property->getDeclaringClass()->name.'::$'.$property->getName());
    }

    /**
     * {@inheritDoc}
     */
    public function getClassAnnotation(\ReflectionClass $class, $annotationName)
    {
        foreach ($this->getClassAnnotations($class) as $annot) {
            if ($annot instanceof $annotationName) {
                return $annot;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodAnnotation(\ReflectionMethod $method, $annotationName)
    {
        foreach ($this->getMethodAnnotations($method) as $annot) {
            if ($annot instanceof $annotationName) {
                return $annot;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getPropertyAnnotation(\ReflectionProperty $property, $annotationName)
    {
        foreach ($this->getPropertyAnnotations($property) as $annot) {
            if ($annot instanceof $annotationName) {
                return $annot;
            }
        }

        return null;
    }
}
