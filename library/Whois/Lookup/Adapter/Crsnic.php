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
 * @see Whois_Lookup_Adapter_Abstract
 */
require_once('Whois/Lookup/Adapter/Abstract.php');
/**
 * Whois_Lookup_Adapter_Abstract class.
 *
 * @category   Whois
 * @package    Lookup
 * @subpackage Adapter_Abstract
 * @copyright  Copyright (c) 2012 PHP Whois Project
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
class Whois_Lookup_Adapter_Crsnic extends Whois_Lookup_Adapter_Abstract
{
    /**
     * Contains the location of the whois server.
     *
     * @var string
     */
    protected $_server = 'whois.crsnic.net';

    /**
     * Contains the port number to be used when calling the whois server.
     *
     * @var int
     */
    protected $_port = 43;
}