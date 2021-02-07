<?php

namespace App\Console\Commands;

use App\Models\UserContact;
use Illuminate\Console\Command;

class isekiDemoUserContact extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_user_contact';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding user contact data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        UserContact::factory()
            ->times(50)
            ->create();
        return 'success';
    }
}
