<?php

namespace Voquis\Schema\Base;

use Voquis\Schema\Base;

/**
 * GB optimised address
 */
class Address extends Base
{
    /**
     * @var string $line1
     */
    public $line1;

    /**
     * @var string $line2
     */
    public $line2;

    /**
     * @var string $line3
     */
    public $line3;

    /**
     * @var string $city
     */
    public $city;

    /**
     * @var string $county
     */
    public $county;

    /**
     * @var string $postcode
     */
    public $postcode;

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        // populate from input array (use base class)
        $this->populate($config);
    }
}
