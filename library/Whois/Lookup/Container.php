<?php
/**
 * PHP Whois Project
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 *
 * @category   Whois
 * @package    Lookup
 * @subpackage Container
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @since      Saturday, 29 September 2012
 */
/**
 * Whois_Lookup_Container class.
 *
 * The purpose of this class is to provide a common format for whois data.
 *
 * @category   Whois
 * @package    Lookup
 * @subpackage Container
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
class Whois_Lookup_Container
{
    /**#@+
     * Contains expected whois data.
     *
     * @var string
     */
    protected $_registrant;
    /**#@-*/

    /**#@+
     * Contains expected whois data.
     *
     * @var DateTime
     */
    protected $_registered;
    protected $_expires;
    /**#@-*/

    /**
     * Contains a key=>value array of dynamic whois values.
     *
     * @var array
     */
    protected $_dynamic = array();

    /**
     * Constructor
     * @param mixed $options Optional options array.
     */
    public function __construct($options = null)
    {
        if ($options instanceof Zend_Config) {
            $this->setConfig($options);
        }

        if (!is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Sets the options from a Zend_Config object.
     *
     * @param  Zend_Config $config
     * @return Whois_Lookup_Container
     */
    public function setConfig(Zend_Config $config)
    {
        $this->setOptions($config->toArray());

        return $this;
    }

    /**
     * Sets options array to internal array.
     *
     * @param  array $options
     * @return Whois_Lookup_Container
     */
    public function setOptions(array $options)
    {
        if (0 == count($options)) {
            return $this;
        }
        foreach ($options as $proprty => $value) {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * Sets the $value into the appropriate property or dynamic variable.
     *
     * @param  string $name
     * @param  string $value
     * @return Whois_Lookup_Container
     */
    public function __set($name, $value)
    {
        $property = '_' . lcfirst($name);
        if (property_exists($this, $property)) {

            $this->$property = $value;
        }

        $this->_dynamic[$name] = $value;

        return $this;
    }

    /**
     * Magic get method.
     *
     * @param  string $name
     * @return string
     * @throws UnexpectedValueException
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {

            return call_user_method($method, $this);
        }

        $property = '_' . lcfirst($name);
        if (property_exists($this, $property)) {

            return $this->$property;
        }

        if (array_key_exists($name, $this->_dynamic)) {

            return $this->_dynamic[$name];
        }

        throw new UnexpectedValueException("'{$name}' was not found");
    }

    /**
     * Call this method to find out if a value is available to use.
     *
     * @param string $name
     * @return boolean
     */
    public function __isset($name)
    {
        try {

            $this->__get($name);

        } catch (UnexpectedValueException $e) {

            return false;
        }

        return true;
    }
}