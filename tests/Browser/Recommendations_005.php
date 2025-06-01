<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Recommendations_005 extends DuskTestCase
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
                ->screenshot('recommendations_001_1.png');
        });
    }
} 
