<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChatTest003 extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
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
                ->clickLink('Chat')
                ->assertPathIs('/chat')
                ->type('message', 'Test')
                ->press('send');
        });  
    }
}
