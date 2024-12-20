<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class UpdatePlacedAt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update-placed-at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
     public function handle()
    {
        DB::table('lunar_orders')
            ->whereNull('placed_at')
            ->update([
                'placed_at' => DB::raw('created_at'),
            ]);

        $this->info('Successfully updated placed_at values.');
        return 0;
    }
}
