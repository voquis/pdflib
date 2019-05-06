<?php

namespace Voquis\Schema\Base;

use Voquis\Schema\Base;
use Voquis\Schema\Base\Address;

/**
 * GB optimised company
 */
class Company extends Base
{
    /**
     * Company Address
     *
     * @var Address $address
     */
    public $address;

    /**
     * Company name
     *
     * @var string $name
     */
    public $name;

    /**
     * Company registration number
     *
     * @var string $number
     */
    public $number;

    /**
     * Company VAT registration number
     *
     * @var string $vatNumber
     */
    public $vatNumber;

    /**
     * Company email address
     *
     * @var string $email
     */
    public $email;

    /**
     * Company telephone number
     *
     * @var string $telephone
     */
    public $telephone;

    /**
     * Company website URL
     *
     * @var string $website
     */
    public $website;

    /**
     * Company logo URL
     *
     * @var string $logoUrl
     */
    public $logoUrl;

    /**
     * Constructor
     *
     * @param Address $address
     * @param array $config
     */
    public function __construct(Address $address, array $config)
    {
        // populate from input array (use base class)
        $this->populate($config);
        // populate from objects
        $this->address = $address;
    }
}
