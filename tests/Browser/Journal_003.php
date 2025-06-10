<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Journal_003 extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/login')
                ->type('username', 'akbar')
                ->type('password', '123456')
                ->screenshot('fields')
                ->press('Login')
                ->assertPathIs('/home')
                ->clickLink('Journal')
                ->assertPathIs('/home/journal')
                ->clickLink('+')
                ->assertPathIs('/home/journal/create')
                ->type('title', 'Test Title 2')
                ->type('date', '04052025')
                ->type('journal_text', 'Test 003')
                ->press('Cancel');
        });
    }
}
