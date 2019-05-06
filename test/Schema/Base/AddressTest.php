<?php

namespace VoquisTest\Schema\Base;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Base\Address;

final class AddressTest extends TestCase
{
    /**
     * Test partial population
     */
    public function testPartial()
    {
        $input = [
            'line1' => 'Line 1',
            'postcode' => 'PO57 COD',
        ];

        $address = new Address($input);
        $this->assertEquals($address->line1, $input['line1']);
        $this->assertEquals($address->postcode, $input['postcode']);
        $this->assertNull($address->line2);
    }

    /**
     * Test full population
     */
    public function testFull()
    {
        $expected = [
            'line1' => 'Addr Line 1',
            'line2' => 'Addr Line 2',
            'line3' => 'Addr Line 3',
            'city' => 'Addr City',
            'county' => 'Addr County',
            'postcode' => 'Addr Postcode',
        ];

        $address = new Address($expected);
        $actual = $address->getArray();
        $this->assertEquals($expected, $actual);
    }
}
