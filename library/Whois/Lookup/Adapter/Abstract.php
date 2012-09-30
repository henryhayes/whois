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
 * @subpackage Adapter_Abstract
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @since      Saturday, 29 September 2012
 */
/**
 * @see Whois_Lookup_Adapter_Interface
 */
require_once('Whois/Lookup/Adapter/Interface.php');
/**
 * Whois_Lookup_Adapter_Abstract class.
 *
 * @category   Whois
 * @package    Lookup
 * @subpackage Adapter_Abstract
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
abstract class Whois_Lookup_Adapter_Abstract implements Whois_Lookup_Adapter_Interface
{
    /**
     * Contains a Whois_Domain instance.
     *
     * @var Whois_Domain
     */
    protected $_domain;

    /**
     * Contains an Whois_Lookup_Container instance.
     *
     */
    protected $_container;

    /**
     * Constructor, set's the domain name object.
     *
     * @param Whois_Domain $domain
     */
    public function __construct(Whois_Domain $domain = null)
    {
        $this->setDomain($domain);
    }

    /**
     * Sets the domain object into the member variable property.
     *
     * @param Whois_Domain $domain
     */
    public function setDomain(Whois_Domain $domain)
    {
        $this->_domain = $domain;
    }

    /**
     * Returns container object.
     *
     * @return Whois_Lookup_Container
     */
    public function getContainer()
    {
        if (!$this->_container instanceof Whois_Lookup_Container) {
            /**
             * @see Whois_Lookup_Container
             */
            require_once('Whois/Lookup/Container.php');
            return new Whois_Lookup_Container();
        }

        return $this->_container;
    }

    /**
     * Gets the domain object.
     *
     * @return Whois_Domain
     */
    public function getDomain()
    {
        return $this->_domain;
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
        if (method_exists($this->getContainer(), $method)) {

            return call_user_func(array($this->getContainer(), $method));
        }

        return $this->getContainer()->$property;
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