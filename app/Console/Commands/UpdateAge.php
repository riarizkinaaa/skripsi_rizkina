<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Anak;
use Carbon\Carbon;

class UpdateAge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:age';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update user age once a year';

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
        $anaks = Anak::all();
        foreach ($anaks as $anak) {
            $birthdate = Carbon::parse($anak->tgl_lahir);
            $today = Carbon::now();
            $lastBirthday = $birthdate->copy()->setYear($today->year);
            // Cek apakah hari ini sudah lewat hari ulang tahun atau belum
            if ($today->gt($lastBirthday)) {
                $anak->usia++;
                $anak->save();
            }
        }
    }
}
