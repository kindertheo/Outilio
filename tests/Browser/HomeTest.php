<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use NumberFormatter;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    private
    function getPrice($price)
    {
        $formatter = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
        return str_replace("\xc2\xa0", ' ', $formatter->formatCurrency($price, 'EUR'));
    }
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAccessHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Étape 1');
        });
    }


    public function testFillFormAndSubmit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#freeDeliveryOption")
                ->keys('#firstname', 'Thédqzdqzo')
                ->keys('#lastname', 'Tedqzst')
                ->keys('#phone', '0634567890')
                ->keys('#email', 'mail@mail.com')
                ->press("#checkbox-2")
                ->press("#product-1")
                ->press("#product-2")
                ->press("#submitOrder")
                ->pause(1000)
                ->assertSee('Votre réservation est prise en compte');
        });
    }

    public function testPriceIsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->assertSeeIn('div#price', '0,00 €');
        });
    }
    /*
    public function testPriceIsComputedWithOneArticle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000);
            $productPrice1 = $browser->attribute("#product-1", "data-price");
            $productPrice1 = $this->getPrice($productPrice1);
            $browser->press("#product-1");
            $price = $browser->text('div#price');
            $browser->assertSeeIn('div#price', "{$productPrice1}");
        });
    }

    public function testPriceIsComputedWithTwoArticle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000);
            $productPrice1 = $browser->element("#product-1")->getAttribute('data-price');
            $productPrice2 = $browser->element("#product-2")->getAttribute('data-price');
            $browser->press("#product-1")
                ->press("#product-2");
            $finalPrice = $this->getPrice(($productPrice1 + $productPrice2) * 0.9);
            $browser->assertSeeIn('div#price', "{$finalPrice}");
        });
    }

    public function testPriceIsComputedWithThreeArticle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000);
            $productPrice1 = $browser->element("#product-1")->getAttribute('data-price');
            $productPrice2 = $browser->element("#product-2")->getAttribute('data-price');
            $productPrice3 = $browser->element("#product-3")->getAttribute('data-price');
            $browser->press("#product-1")
                ->press("#product-2")
                ->press("#product-3");
            $finalPrice = $this->getPrice(($productPrice1 + $productPrice2 + $productPrice3) * 0.85);
            $browser->assertSeeIn('div#price', "{$finalPrice}");
        });
    }
    */

    public function testValidateButtonIsDisabled()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->assertDisabled('#submitOrder');
        });
    }

    public function testValidateButtonIsDisabledWhenOneArticleIsSelected()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->assertDisabled('#submitOrder');
        });
    }

    public function testValidateButtonIsDisabledWhenArticleIsSelectedAndNameFilled()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->keys('#firstname', 'Théo')
                ->assertDisabled('#submitOrder');
        });
    }

    public function testValidateButtonIsDisabledWhenArticleIsSelectedAndNameAndLastNameFilled()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->keys('#firstname', 'Théo')
                ->keys('#lastname', 'Test')
                ->assertDisabled('#submitOrder');
        });
    }

    public function testValidateButtonIsDisabledWhenArticleIsSelectedAndNameAndLastNameAndPhoneFilled()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->keys('#firstname', 'Théo')
                ->keys('#lastname', 'Test')
                ->keys('#phone', '060606060606')
                ->assertDisabled('#submitOrder');
        });
    }

    public function testWhenEmailIsMalformated()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->keys('#firstname', 'Théo')
                ->keys('#lastname', 'Test')
                ->keys('#phone', '060606060606')
                ->keys('#email', 'mail')
                ->assertDisabled('#submitOrder');
        });
    }

    public function testWhenPhoneIsTooLong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->keys('#firstname', 'Théo')
                ->keys('#lastname', 'Test')
                ->keys('#phone', '0606060609090909090909090909090')
                ->keys('#email', 'mail@mail.com')
                ->assertDisabled('#submitOrder');
        });
    }

    public function testWhenPhoneIsMalformated()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->keys('#firstname', 'Théo')
                ->keys('#lastname', 'Test')
                ->keys('#phone', 'ABCDEFGH87#P)')
                ->keys('#email', 'mail@mail.com')
                ->assertDisabled('#submitOrder');
        });
    }

    public function testWhenFirstnameIsTooShort()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->keys('#firstname', 'T')
                ->keys('#lastname', 'Test')
                ->keys('#phone', '060606060606')
                ->keys('#email', 'mail@mail.com')
                ->assertDisabled('#submitOrder');
        });
    }

    public function testWhenLastnameIsTooShort()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#product-1")
                ->keys('#firstname', 'Théo')
                ->keys('#lastname', 'T')
                ->keys('#phone', '060606060606')
                ->keys('#email', 'mail@mail.com')
                ->assertDisabled('#submitOrder');
        });
    }
}
