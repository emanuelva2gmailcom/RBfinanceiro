<?php

namespace DocBlock\Common\Annotations;

class AnnotationException extends \Exception
{
    /**
     * Creates a new AnnotationException describing a Syntax error.
     *
     * @param string $message Exception message
     *
     * @return AnnotationException
     */
    public static function syntaxError($message)
    {
        return new self('[Syntax Error] ' . $message);
    }

    /**
     * Creates a new AnnotationException describing a Semantical error.
     *
     * @param string $message Exception message
     *
     * @return AnnotationException
     */
    public static function semanticalError($message)
    {
        return new self('[Semantical Error] ' . $message);
    }

    /**
     * Creates a new AnnotationException describing an error which occurred during
     * the creation of the annotation.
     *
     * @since 2.2
     *
     * @param string $message
     *
     * @return AnnotationException
     */
    public static function creationError($message)
    {
        return new self('[Creation Error] ' . $message);
    }

    /**
     * Creates a new AnnotationException describing a type error.
     *
     * @since 1.1
     *
     * @param string $message
     *
     * @return AnnotationException
     */
    public static function typeError($message)
    {
        return new self('[Type Error] ' . $message);
    }

    /**
     * Creates a new AnnotationException describing a constant semantical error.
     *
     * @since 2.3
     *
     * @param string $identifier
     * @param string $context
     *
     * @return AnnotationException
     */
    public static function semanticalErrorConstants($identifier, $context = null)
    {
        return self::semanticalError(sprintf(
            "Couldn't find constant %s%s.",
            $identifier,
            $context ? ', ' . $context : ''
        ));
    }

    /**
     * Creates a new AnnotationException describing an type error of an attribute.
     *
     * @since 2.2
     *
     * @param string $attributeName
     * @param string $annotationName
     * @param string $context
     * @param string $expected
     * @param mixed  $actual
     *
     * @return AnnotationException
     */
    public static function attributeTypeError($attributeName, $annotationName, $context, $expected, $actual)
    {
        return self::typeError(sprintf(
            'Attribute "%s" of @%s declared on %s expects %s, but got %s.',
            $attributeName,
            $annotationName,
            $context,
            $expected,
            is_object($actual) ? 'an instance of ' . get_class($actual) : gettype($actual)
        ));
    }

    /**
     * Creates a new AnnotationException describing an required error of an attribute.
     *
     * @since 2.2
     *
     * @param string $attributeName
     * @param string $annotationName
     * @param string $context
     * @param string $expected
     *
     * @return AnnotationException
     */
    public static function requiredError($attributeName, $annotationName, $context, $expected)
    {
        return self::typeError(sprintf(
            'Attribute "%s" of @%s declared on %s expects %s. This value should not be null.',
            $attributeName,
            $annotationName,
            $context,
            $expected
        ));
    }

    /**
     * Creates a new AnnotationException describing a invalid enummerator.
     *
     * @since 2.4
     *
     * @param string $attributeName
     * @param string $annotationName
     * @param string $context
     * @param array  $available
     * @param mixed  $given
     *
     * @return AnnotationException
     */
    public static function enumeratorError($attributeName, $annotationName, $context, $available, $given)
    {
        return new self(sprintf(
            '[Enum Error] Attribute "%s" of @%s declared on %s accept only [%s], but got %s.',
            $attributeName, 
            $annotationName,
            $context,
            implode(', ', $available),
            is_object($given) ? get_class($given) : $given
        ));
    }

    /**
     * @return AnnotationException
     */
    public static function optimizerPlusSaveComments()
    {
        return new self(
            "You have to enable opcache.save_comments=1 or zend_optimizerplus.save_comments=1."
        );
    }

    /**
     * @return AnnotationException
     */
    public static function optimizerPlusLoadComments()
    {
        return new self(
            "You have to enable opcache.load_comments=1 or zend_optimizerplus.load_comments=1."
        );
    }
}
