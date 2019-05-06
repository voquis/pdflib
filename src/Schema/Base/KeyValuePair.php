<?php

namespace Voquis\Schema\Base;

use Voquis\Schema\Base;

/**
 * Key value pair
 */
class KeyValuePair extends Base
{
    /**
     * @var string $key
     */
    public $key;

    /**
     * @var string $value
     */
    public $value;

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
