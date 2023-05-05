<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdatePaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the payments status from pendiente to vencido';

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
        DB::table("payments")
            ->where('status','PENDIENTE')
            ->where('expire_time','<', now())
            ->update(['status'=>'VENCIDO']);

        $this->info("payment status has been updated");

        return Command::SUCCESS;
    }
}
