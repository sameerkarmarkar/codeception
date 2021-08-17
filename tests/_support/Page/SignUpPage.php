<?php
namespace Page;

class SignUpPage
{
    // include url of current page

    static $cardSelector = '//img[@class=\'img-responsive pb-card-picker__img\']';
    static $emailInput = '#email';
    static $pinInput = '#pin';
    static $continueBtn = '.pb-sign-up__button-wrapper';
    static $salutationList = '#salutation';
    static $firstNameInput = '#firstName';
    static $lastNameInput = '#lastName';
    static $dobErrorContainer = '//input[@name=\'birthday\']/../..';
    static $dobInput = '//input[@name=\'birthday\']';
    static $streetInput = '#street';
    static $houseNumberInput = '#floor, #houseNumber';
    static $zipCodeInput = '#zipCode';
    static $cityInput = '#city';


}
