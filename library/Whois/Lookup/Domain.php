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
 * @subpackage Domain
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 * @since      Sunday, 30 September 2012
 */
/**
 * Whois Domain class.
 *
 * @category   Whois
 * @package    Lookup
 * @subpackage Domain
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
class Whois_Lookup_Domain
{
    /**
     * Contains the domain name as a string.
     *
     * @var string
     */
    protected $_domain;

    /**
     * Constructor sets the domain as read only.
     *
     * @param unknown_type $domain
     */
    public function __construct($domain)
    {
        $this->_setDomain($domain);
    }

    /**
     * Sets domain to the protected property. Making this protected
     * ensures that this is read-only.
     *
     * @param string $domain
     */
    protected function _setDomain($domain)
    {
        $this->_domain = $domain;
        return $this;
    }

    /**
     * Retrieves the domain as a string.
     *
     * @throws InvalidArgumentException
     * @return string
     */
    public function getDomain()
    {
        if (empty($this->_domain)) {
            throw new InvalidArgumentException('Domain is empty, you must set domain before accessing it.');
        }

        return $this->_domain;
    }

    /**
     * Magic toString method echos the domain.
     * {@see Whois_Lookup_Domain::getDomain()}
     */
    public function __toString()
    {
        return $this->getDomain();
    }
}