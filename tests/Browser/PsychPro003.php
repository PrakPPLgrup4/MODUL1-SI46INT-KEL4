<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PsychPro003 extends DuskTestCase
{
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/login')
                ->type('username', 'farrel')
                ->type('password', '123456')
                ->screenshot('fields')
                ->press('Login')
                ->assertPathIs('/home')
                ->clickLink('Our Psychiatrist')
                ->assertPathIs('/psych');
        });
    }
}
