<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomePageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAccessHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Etape 1');
        });
    }


    public function testFillFormAndSubmit()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#deliveryOptionFree")
                ->keys('#firstname', 'Thédqzdqzo')
                ->keys('#lastname', 'Tedqzst')
                ->keys('#phone', '0634567890')
                ->keys('#email', 'mail@mail.com')
                ->press("#btn-check-outlined-1")
                ->press("#btn-check-outlined-2")
                ->click("#submitOrder")
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

    public function testPriceIsComputedWithOneArticle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000);
            $productPrice1 = $browser->attribute("#btn-check-outlined-1", "data-price");
            $browser->assertSeeIn('div#price', "{$productPrice1} €");
        });
    }

    public function testPriceIsComputedWithTwoArticle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000);
            $productPrice1 = $browser->element("#btn-check-outlined-1")->getAttribute('data-price');
            $productPrice2 = $browser->element("#btn-check-outlined-2")->getAttribute('data-price');
            $finalPrice = ($productPrice1 + $productPrice2) * 0.1;
            $browser->assertSeeIn('div#price', "{$finalPrice} €");
        });
    }

    public function testPriceIsComputedWithThreeArticle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000);
            $productPrice1 = $browser->element("#btn-check-outlined-1")->getAttribute('data-price');
            $productPrice2 = $browser->element("#btn-check-outlined-2")->getAttribute('data-price');
            $productPrice2 = $browser->element("#btn-check-outlined-3")->getAttribute('data-price');
            $finalPrice = ($productPrice1 + $productPrice2) * 0.15;
            $browser->assertSeeIn('div#price', "{$finalPrice} €");
        });
    }

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
                ->press("#btn-check-outlined-1")
                ->assertDisabled('#submitOrder');
        });
    }

    public function testValidateButtonIsDisabledWhenArticleIsSelectedAndNameFilled()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#btn-check-outlined-1")
                ->keys('#firstname', 'Théo')
                ->assertDisabled('#submitOrder');
        });
    }

    public function testValidateButtonIsDisabledWhenArticleIsSelectedAndNameAndLastNameFilled()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->pause(1000)
                ->press("#btn-check-outlined-1")
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
                ->press("#btn-check-outlined-1")
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
                ->press("#btn-check-outlined-1")
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
                ->press("#btn-check-outlined-1")
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
                ->press("#btn-check-outlined-1")
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
                ->press("#btn-check-outlined-1")
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
                ->press("#btn-check-outlined-1")
                ->keys('#firstname', 'Théo')
                ->keys('#lastname', 'T')
                ->keys('#phone', '060606060606')
                ->keys('#email', 'mail@mail.com')
                ->assertDisabled('#submitOrder');
        });
    }
}
