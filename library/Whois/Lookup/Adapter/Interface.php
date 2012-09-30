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
 * @subpackage Adapter_Interface
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @since      Saturday, 29 September 2012
 */
/**
 * Whois_Lookup_Adapter_Interface interface.
 *
 * @category   Whois
 * @package    Lookup
 * @subpackage Adapter_Interface
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
interface Whois_Lookup_Adapter_Interface
{
    public function __construct(Whois_Domain $domain);

    /**
     * Sets the domain object into the member variable property.
     *
     * @param Whois_Lookup_Domain $domain
     */
    public function setDomain(Whois_Lookup_Domain $domain);

    /**
     * Gets the domain object.
     *
     * @return Whois_Lookup_Domain
     */
    public function getDomain();

    /**
     * Sets the container object into the member variable property.
     *
     * @param Whois_Lookup_Container $container
     */
    public function setContainer(Whois_Lookup_Container $container);

    /**
     * Returns container object. When this is returned, this is the
     * point when we actually need to do the whois lookup.
     *
     * @return Whois_Lookup_Container
     */
    public function getContainer();
}