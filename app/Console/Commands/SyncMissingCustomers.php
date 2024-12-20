<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Lunar\Models\Customer;

class SyncMissingCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:missing-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync missing customers in the lunar_customers table based on the users table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all(); // Fetch all users

        foreach ($users as $user) {
            // Check if the user already exists in lunar_customers
            $existingCustomer = Customer::where('user_id', $user->id)->first();

            if (!$existingCustomer) {
                // Add a new customer record
                Customer::create([
                    'user_id' => $user->id,
                    'first_name' => $user->first_name ?? 'Unknown',
                    'last_name' => $user->last_name ?? 'Unknown',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->info("Customer created for User ID: {$user->id}");
            }
        }

        $this->info('All missing customers have been synced successfully.');
    }
}
