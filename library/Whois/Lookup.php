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
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @since      Saturday, 29 September 2012
 */
/**
 * Whois lookup class.
 *
 * @category   Whois
 * @package    Lookup
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
class Whois_Lookup
{
    protected $_domain;

    protected $_adapters = array(
        'com'            => 'Crsnic',
    );

    public function __construct()
    {
        //
    }

    /**
     * Sets the domain. If domain is type Whois_Domain sets as is,
     * if not, creates Whois_Domain object and sets it.
     *
     * @param Whois_Domain $domain
     * @return Whois_Lookup
     */
    public function setDomain($domain)
    {
        if ($domain instanceof Whois_Domain) {
            $this->_domain = $domain;
        }

        $this->_domain = new Whois_Domain($domain);

        return $this;
    }

    /**
     * Returns an stance of the domain object.
     *
     * @return Whois_Domain
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * Returns the domain object as a string.
     *
     * @return string
     */
    public function getDomainString()
    {
        return $this->_domain->__toString();
    }

    /**
     * Returns the populated adapter! Should already contain a poulated whois object.
     *
     * @return Whois_Lookup_Adapter_Interface
     */
    public function getAdapter()
    {
        return $this->_adapter;
    }

    /**
     * Magic call method for domain whois information.
     *
     * @param string $name
     * @param string $args
     * @return null
     */
    public function __call($name, $args)
    {
        try {
            $return = call_user_func_array(array($this->getAdapter(), $name), $args);

        } catch (UnexpectedValueException $e) {

            return null;
        }

        return $return;
    }
}