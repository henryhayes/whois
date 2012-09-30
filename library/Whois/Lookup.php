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
    /**
     * Current version of this project.
     *
     * @var string
     */
    const VERSION = '0.1';

    /**
     * Contains an instance of Whois_Lookup_Domain.
     *
     * @var Whois_Lookup_Domain
     */
    protected $_domain;

    /**
     * An array of which adapter to use for which TLD.
     *
     * @var array
     */
    protected $_adapters = array(
        'com'            => 'Crsnic',
    );

    public function __construct()
    {
        //
    }

    /**
     * Sets the domain. If domain is type Whois_Lookup_Domain sets as is,
     * if not, creates Whois_Lookup_Domain object and sets it.
     *
     * @param Whois_Lookup_Domain $domain
     * @return Whois_Lookup
     */
    public function setDomain($domain)
    {
        if ($domain instanceof Whois_Lookup_Domain) {
            $this->_domain = $domain;
        }

        $this->_domain = new Whois_Lookup_Domain($domain);

        return $this;
    }

    /**
     * Returns an stance of the domain object.
     *
     * @return Whois_Lookup_Domain
     */
    public function getDomain()
    {
        return $this->_domain;
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
            $return = call_user_func_array(array($this->getAdapter()->getContainer(), $name), $args);

        } catch (UnexpectedValueException $e) {

            return null;
        }

        return $return;
    }
}