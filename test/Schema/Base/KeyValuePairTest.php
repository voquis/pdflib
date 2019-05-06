<?php

namespace VoquisTest\Schema;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Base\KeyValuePair;

final class KeyValuePairTest extends TestCase
{
    /**
     * Test partial population
     */
    public function testPartial()
    {
        $input = [
            'key' => 'MyKey',
        ];

        $kvp = new KeyValuePair($input);
        $this->assertEquals($kvp->key, $input['key']);
        $this->assertNull($kvp->value);
    }

    /**
     * Test full population
     */
    public function testFull()
    {
        $expected = [
            'key' => 'MyKey',
            'value' => 'MyValue',
        ];

        $kvp = new KeyValuePair($expected);
        $actual = $kvp->getArray();
        $this->assertEquals($expected, $actual);
    }
}
