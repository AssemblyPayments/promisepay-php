<?php
namespace PromisePay\DataObjects;

/**
 * Class User
 * @package PromisePay\DataObjects
 */
class User extends Object
{
    /**
     * @var
     */
    private  $_firstName;

    /**
     * @var
     */
    private $_lastName;

    /**
     * @var
     */
    private $_email;

    /**
     * @var
     */
    private $_mobile;

    /**
     * @var
     */
    private $_addressLine1;

    /**
     * @var
     */
    private $_addressLine2;

    /**
     * @var
     */
    private $_city;

    /**
     * @var
     */
    private $_zip;

    /**
     * @var
     */
    private $_state;

    /**
     * @var
     */
    private $_country;

    /**
     * @var
     */
    private $_dob;

    /**
     * @var
     */
    private $_fullName;

    /**
     * @var
     */
    private $_verificationState;

    /**
     * @var
     */
    private $_driversLicense;

    /**
     * @var
     */
    private $_phone;

    public function __construct($jsonData = array())
    {
        if(count($jsonData)>0)
        {
            $this->_firstName         = $jsonData['first_name'];
            $this->_fullName          = $jsonData['full_name'];
            $this->_lastName          = $jsonData['last_name'];
            $this->_email             = $jsonData['email'];
            $this->_mobile            = $jsonData['mobile'];
            $this->_phone             = $jsonData['phone'];
            $this->_country           = $jsonData['country'];
            $this->_addressLine1      = $jsonData['address_line1'];
            $this->_addressLine2      = $jsonData['address_line2'];
            $this->_city              = $jsonData['city'];
            $this->_state             = $jsonData['state'];
            $this->_zip               = $jsonData['zip'];
            $this->_verificationState = $jsonData['verification_state'];
            $this->_dob               = $jsonData['dob'];
            $this->_driversLicense    = $jsonData['drivers_license'];

        }
        parent::__construct($jsonData);
    }
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->_mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->_mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getAddressLine1()
    {
        return $this->_addressLine1;
    }

    /**
     * @param mixed $addressLine1
     */
    public function setAddressLine1($addressLine1)
    {
        $this->_addressLine1 = $addressLine1;
    }

    /**
     * @return mixed
     */
    public function getAddressLine2()
    {
        return $this->_addressLine2;
    }

    /**
     * @param mixed $addressLine2
     */
    public function setAddressLine2($addressLine2)
    {
        $this->_addressLine2 = $addressLine2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->_zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->_country = $country;
    }

    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->_dob;
    }

    /**
     * @param mixed $dob
     */
    public function setDob($dob)
    {
        $this->_dob = $dob;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->_fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->_fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getVerificationState()
    {
        return $this->_verificationState;
    }

    /**
     * @param mixed $verificationState
     */
    public function setVerificationState($verificationState)
    {
        $this->_verificationState = $verificationState;
    }

    /**
     * @return mixed
     */
    public function getDriversLicense()
    {
        return $this->_driversLicense;
    }

    /**
     * @param mixed $driversLicense
     */
    public function setDriversLicense($driversLicense)
    {
        $this->_driversLicense = $driversLicense;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }
}