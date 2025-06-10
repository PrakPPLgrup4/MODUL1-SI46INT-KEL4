<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Appointment004 extends DuskTestCase
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
                ->clickLink('Appointment')
                ->clickLink('Book New Appointment')
                ->clickLink('Select')
                ;
        });
    }
}
