<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Recommendations_001 extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/login')
                ->type('username', 'iki')
                ->type('password', '12345678')
                ->press('Login')
                ->clickLink('Test')
                ->pause(500)
                ->check('input[name="q1"][value="1"]')
                ->check('input[name="q2"][value="1"]')
                ->check('input[name="q3"][value="1"]')
                ->check('input[name="q4"][value="1"]')
                ->check('input[name="q5"][value="1"]')
                ->check('input[name="q6"][value="1"]')
                ->check('input[name="q7"][value="1"]')
                ->check('input[name="q8"][value="1"]')
                ->check('input[name="q9"][value="1"]')
                ->check('input[name="q10"][value="1"]')
                ->press('Submit')
                ->pause(1000)
                ->screenshot('recommendations_001_1.png');


        });
    }
} 
