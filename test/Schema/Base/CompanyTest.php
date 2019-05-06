<?php

namespace VoquisTest\Schema;

use PHPUnit\Framework\TestCase;

use Voquis\Schema\Base\Company;
use Voquis\Schema\Base\Address;

final class CompanyTest extends TestCase
{
    /**
     * Test partial population
     */
    public function testPartial()
    {
        $input = [
            'name' => 'My Co',
            'address' => [
                'line1' => 'Co Addr Line 1',
                'postcode' => 'Co Addr Postcode',
            ]
        ];

        $address = new Address($input['address']);
        $company = new Company($address, $input);
        $this->assertEquals($input['name'], $company->name);
        $this->assertEquals($input['address']['line1'], $company->address->line1);
        $this->assertNull($company->address->line2);
    }

    /**
     * Test full population
     */
    public function testFull()
    {
        $expected = [
            'name' => 'My Co',
            'number' => 'OC123456',
            'vatNumber' => 'AB123456',
            'email' => 'info@testco.com',
            'telephone' => '01234567890',
            'website' => 'www.example.com',
            'logoUrl' => 'https://www.example.com/img/logo.png',
            'address' => [
                'line1' => 'Co Addr Line 1',
                'line2' => 'Co Addr Line 2',
                'line3' => 'Co Addr Line 3',
                'city' => 'Co Addr City',
                'county' => 'Co Addr County',
                'postcode' => 'Co Addr Postcode',
            ]
        ];

        $address = new Address($expected['address']);
        $company = new Company($address, $expected);
        $actual = $company->getArray();
        $this->assertEquals($expected, $actual);
    }
}
