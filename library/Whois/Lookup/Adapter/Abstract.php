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
     * Contains a Whois_Lookup_Domain instance.
     *
     * @var Whois_Lookup_Domain
     */
    protected $_domain;

    /**
     * Contains an Whois_Lookup_Container instance.
     *
     * @return Whois_Lookup_Container
     */
    protected $_container;

    /**
     * Constructor, set's the domain name object.
     *
     * @param Whois_Lookup_Domain $domain
     */
    public function __construct(Whois_Lookup_Domain $domain = null)
    {
        $this->setDomain($domain);
    }

    /**
     * Sets the domain object into the member variable property.
     *
     * @param Whois_Lookup_Domain $domain
     */
    public function setDomain(Whois_Lookup_Domain $domain)
    {
        $this->_domain = $domain;
    }

    /**
     * Gets the domain object.
     *
     * @return Whois_Lookup_Domain
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * Sets the container object into the member variable property.
     *
     * @param Whois_Lookup_Container $container
     */
    public function setContainer(Whois_Lookup_Container $container)
    {
        $this->_container = $container;
    }

    /**
     * Returns container object. When this is returned, this is the
     * point when we actually need to do the whois lookup.
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
            $this->_container = Whois_Lookup_Container();
        }

        return $this->_container;
    }

    /**
     * Performs the Whois lookup.
     */
    public function doLookup()
    {
        $domain = $this->getDomain()->__toString();

        if ($conn = fsockopen($this->getServer(), $this->getPort())) {

            fputs($conn, $domain . "\r\n");

            while (!feof($conn)) {
                $output .= fgets($conn, 128);
            }

            fclose($conn);
        } else {
            //
        }
    }
}