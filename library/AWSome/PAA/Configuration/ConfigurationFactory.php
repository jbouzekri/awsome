<?php

/**
 * Copyright 2014 Jonathan Bouzekri. All rights reserved.
 *
 * @copyright Copyright 2014 Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 * @license https://github.com/jbouzekri/awsome-pma/blob/master/LICENSE
 * @link https://github.com/jbouzekri/awsome-pma
 */

/**
 * @namespace
 */
namespace AWSome\PAA\Configuration;

use AWSome\PAA\Exception\ConfigurationException;

/**
 * @namespace
 */
class ConfigurationFactory
{
    /**
     * An array of mapping between locale and its configuration class
     *
     * @var array
     */
    private static $availableConfiguration = array(
        'FR' => 'AWSome\\PAA\\Configuration\\Configuration',
        'EN' => 'AWSome\\PAA\\Configuration\\ConfigurationEN',
    );

    /**
     * Get a configuration instance according to your locale
     *
     * @param string $locale Query locale
     */
    public function get($locale)
    {
        if (!array_key_exists($locale, static::$availableConfiguration)) {
            throw new ConfigurationException('No configuration specified for locale '.$locale);
        }

        $configuration = new static::$availableConfiguration[$locale];
        if (!$configuration instanceof Configuration) {
            throw new ConfigurationException(
                'Configuration ' . get_class($configuration) . ' is not an instance of Configuration'
            );
        }

        return $configuration;
    }

    /**
     * Register new configurations in the factory
     *
     * @param array $configurations an array of configurations
     *      the key must match an available locale and the value must match a configuration class name
     */
    public function registerConfigurations(array $configurations)
    {
        static::$availableConfiguration = array_merge(static::$availableConfiguration, $configurations);
    }
}
