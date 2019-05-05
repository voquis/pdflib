<?php

namespace Voquis;

class PdfConfig
{
    public $companyName = '';

    public $companyNumber = '';

    public $vatRegistration = '';

    public $addressLine1 = '';

    public $addressLine2 = '';

    public $addressLine3 = '';

    public $addressCity = '';

    public $addressCounty = '';

    public $addressPostcode = '';

    public $website = '';

    public $email = '';

    public $telephone = '';

    public $logoUrl = '';

    public $emailTelUnderLogo = true;

    public $logoHeight = 40;

    /**
     * Constructor
     */
    public function __construct(array $config)
    {
        $this->companyName = array_key_exists('companyName', $config) ? $config['companyName']: '';
        $this->companyNumber = array_key_exists('companyNumber', $config) ? $config['companyNumber'] : '';
        $this->vatRegistration = array_key_exists('vatRegistration', $config) ? $config['vatRegistration'] : '';
        $this->addressLine1 = array_key_exists('addressLine1', $config) ? $config['addressLine1'] : '';
        $this->addressLine2 = array_key_exists('addressLine2', $config) ? $config['addressLine2'] : '';
        $this->addressLine3 = array_key_exists('addressLine3', $config) ? $config['addressLine3'] : '';
        $this->addressCity = array_key_exists('addressCity', $config) ? $config['addressCity'] : '';
        $this->addressCounty = array_key_exists('addressCounty', $config) ? $config['addressCounty'] : '';
        $this->addressPostcode = array_key_exists('addressPostcode', $config) ? $config['addressPostcode'] : '';
        $this->website = array_key_exists('website', $config) ? $config['website'] : '';
        $this->email = array_key_exists('email', $config) ? $config['email'] : '';
        $this->telephone = array_key_exists('telephone', $config) ? $config['telephone'] : '';
        $this->logoUrl = array_key_exists('logoUrl', $config) ? $config['logoUrl'] : '';
        $this->logoHeight = array_key_exists('logoHeight', $config) ? $config['logoHeight'] : 40;
        $this->emailTelUnderLogo = array_key_exists('emailTelUnderLogo', $config) ? $config['emailTelUnderLogo'] : true;
    }
}
