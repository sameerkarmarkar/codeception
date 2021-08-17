<?php
use \Codeception\Util\Locator;
require_once (__DIR__.'/utils/PropertyLoader.php');

class PaybackAnmeldenCest

{
    public $config;


    //Test Data
    private static $EMAIL = 'test@payback.com';
    private static $FIRST_NAME = "Test";
    private static $LAST_NAME = "Account";
    private static $PIN = "1234";
    private static $BIRTH_DATE = "01.01.2001";
    private static $STREET = "TestStrasse";
    private static $HOUSE_NUMBER = "1";
    private static $ZIP = "81541";
    private static $CITY = "Munich";

    public function _before(AcceptanceTester $I)
    {
        $this -> config = PropertyLoader::load();
    }

    // tests
    public function paybackSignupTest(AcceptanceTester $I)
    {
        $config = $this -> config;

        $I->wantToTest(' the Sign up for PAYBACK');
        $I->amOnPage($config['BASE_URL']);
        $I->see($config['ROOT_PAGE_TEXT']);


        $I->click($config['REGISTER']);
        $I->see($config['SELECT_NEW_CARD']);
        $I->click(Locator::contains('label', $config['SELECT_NEW_CARD']));
        $I->click(\Page\SignUpPage::$cardSelector);

        $I->click(\Page\SignUpPage::$continueBtn);
        $I->fillField(\Page\SignUpPage::$emailInput,$this::$EMAIL);
        $I->fillField(\Page\SignUpPage::$pinInput,$this::$PIN);
        $I->click(\Page\SignUpPage::$continueBtn);

        $this->validateErrorText($I, \Page\SignUpPage::$salutationList, 'data-validation', $config['SALUTATION_ERROR_TXT']);
        $I->selectOption(\Page\SignUpPage::$salutationList, $config['MR']);

        $this->validateErrorText($I, \Page\SignUpPage::$firstNameInput, 'data-validation', $config['FIRST_NAME_ERROR_TXT']);
        $I->fillField(\Page\SignUpPage::$firstNameInput,$this::$FIRST_NAME);

        $this->validateErrorText($I, \Page\SignUpPage::$lastNameInput, 'data-validation', $config['LAST_NAME_ERROR_TXT']);
        $I->fillField(\Page\SignUpPage::$lastNameInput,$this::$LAST_NAME);

        $this->validateErrorText($I, \Page\SignUpPage::$dobErrorContainer, 'data-config', $config['DOB_ERROR_TXT']);
        $I->fillField(\Page\SignUpPage::$dobInput,$this::$BIRTH_DATE);

        $this->validateErrorText($I, \Page\SignUpPage::$streetInput, 'data-validation', $config['STREET_ERROR_TXT']);
        $I->fillField(\Page\SignUpPage::$streetInput,$this::$STREET);

        $this->validateErrorText($I, \Page\SignUpPage::$houseNumberInput, 'data-validation', $config['FLOOR_ERROR_TXT']);
        $I->fillField(\Page\SignUpPage::$houseNumberInput,$this::$HOUSE_NUMBER);

        $this->validateErrorText($I, \Page\SignUpPage::$zipCodeInput, 'data-validation', $config['ZIP_ERROR_TXT']);
        $I->fillField(\Page\SignUpPage::$zipCodeInput,$this::$ZIP);

        $this->validateErrorText($I, \Page\SignUpPage::$cityInput, 'data-validation', $config['CITY_ERROR_TXT']);
        $I->fillField(\Page\SignUpPage::$cityInput,$this::$CITY);

        $I->seeInField(\Page\SignUpPage::$firstNameInput,$this::$FIRST_NAME);
        $I->seeInField(\Page\SignUpPage::$lastNameInput,$this::$LAST_NAME);
        $I->seeInField(\Page\SignUpPage::$dobInput,$this::$BIRTH_DATE);
        $I->seeInField(\Page\SignUpPage::$streetInput,$this::$STREET);
        $I->seeInField(\Page\SignUpPage::$houseNumberInput,$this::$HOUSE_NUMBER);
        $I->seeInField(\Page\SignUpPage::$zipCodeInput,$this::$ZIP);
        $I->seeInField(\Page\SignUpPage::$cityInput,$this::$CITY);
    }

    private function validateErrorText(AcceptanceTester $I, String $locator, String $validationAttribute, String $expectedValidationError) {
        $dataValidation = $I->grabAttributeFrom($locator, $validationAttribute);
        $I->expect($dataValidation." to contain ".$expectedValidationError);
        \PHPUnit\Framework\assertStringContainsString($expectedValidationError, $dataValidation);
    }

}
