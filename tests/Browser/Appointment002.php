<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Appointment002 extends DuskTestCase
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
                ->assertPathIs('/appointments/categories/1/psychiatrists')
                ->clickLink('Select This Specialist')
                ->assertPathIs('/appointments/slots')
                ->clickLink('01:00 PM - 02:00 PM')
                ->assertPathIs('/appointments/create')
                ->visit('/your-upload-page')
                ->attach('payment_proof', storage_path('Psylography/tests/Browser/screenshots/login-page.png'))
                ->press('Confirm Booking')
                 
                ;
        });
    }
}
