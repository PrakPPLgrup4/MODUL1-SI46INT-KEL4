<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Reward003 extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/login')
                ->type('username', 'adit')
                ->type('password', '123456')
                ->press('Login')
                ->visit('/user-profile')
                ->clickLink('Point Reward')
                ->assertPathIs('/points')
                ->assertSee('Available Vouchers')
                ->click('a[href="http://127.0.0.1:8000/points/voucher/3"]')
                ->assertPathIs('/points/voucher/3')
                ->assertSee('Redeem This Voucher')
                ->press(' Redeem This Voucher ')  

                ;
        });
    }
}
