<?php

namespace DocBlock\Common\Annotations;

final class AnnotationRegistry
{
    
    static private $autoloadNamespaces = [];

    /**
     * A map of autoloader callables.
     *
     * @var callable[]
     */
    static private $loaders = [];

    /**
     * An array of classes which cannot be found
     *
     * @var null[] indexed by class name
     */
    static private $failedToAutoload = [];

    public static function reset() : void
    {
        self::$autoloadNamespaces = [];
        self::$loaders            = [];
        self::$failedToAutoload   = [];
    }

    public static function registerFile(string $file) : void
    {
        require_once $file;
    }

    public static function registerAutoloadNamespace(string $namespace, $dirs = null) : void
    {
        self::$autoloadNamespaces[$namespace] = $dirs;
    }

    public static function registerAutoloadNamespaces(array $namespaces) : void
    {
        self::$autoloadNamespaces = \array_merge(self::$autoloadNamespaces, $namespaces);
    }

    public static function registerLoader(callable $callable) : void
    {
        // Reset our static cache now that we have a new loader to work with
        self::$failedToAutoload   = [];
        self::$loaders[]          = $callable;
    }

    public static function registerUniqueLoader(callable $callable) : void
    {
        if ( ! in_array($callable, self::$loaders, true) ) {
            self::registerLoader($callable);
        }
    }

    /**
     * Autoloads an annotation class silently.
     */
    public static function loadAnnotationClass(string $class) : bool
    {
        if (\class_exists($class, false)) {
            return true;
        }

        if (\array_key_exists($class, self::$failedToAutoload)) {
            return false;
        }

        foreach (self::$autoloadNamespaces AS $namespace => $dirs) {
            if (\strpos($class, $namespace) === 0) {
                $file = \str_replace('\\', \DIRECTORY_SEPARATOR, $class) . '.php';

                if ($dirs === null) {
                    if ($path = stream_resolve_include_path($file)) {
                        require $path;
                        return true;
                    }
                } else {
                    foreach((array) $dirs AS $dir) {
                        if (is_file($dir . \DIRECTORY_SEPARATOR . $file)) {
                            require $dir . \DIRECTORY_SEPARATOR . $file;
                            return true;
                        }
                    }
                }
            }
        }

        foreach (self::$loaders AS $loader) {
            if ($loader($class) === true) {
                return true;
            }
        }

        self::$failedToAutoload[$class] = null;

        return false;
    }
}
