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
    public $_firstName;
    /**
     * @var
     */
    public $_lastName;
    /**
     * @var
     */
    public $_email;
    /**
     * @var
     */
    public $_mobile;
    /**
     * @var
     */
    public $_addressLine1;
    /**
     * @var
     */
    public $_addressLine2;
    /**
     * @var
     */
    public $_city;
    /**
     * @var
     */
    public $_zip;
    /**
     * @var
     */
    public $_state;
    /**
     * @var
     */
    public $_country;
    /**
     * @var
     */
    public $_dob;
    /**
     * @var
     */
    public $_fullName;
    /**
     * @var
     */
    public $_verificationState;
    /**
     * @var
     */
    public $_driversLicense;

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
}