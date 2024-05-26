<?php

namespace App\Jobs;

use App\Models\Anak;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserAge implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $anak = Anak::all();

        // Perbarui umur anak
        foreach ($anak as $anak) {
            $tanggal_lahir = Carbon::parse($anak->tgl_lahir);
            $usia = $tanggal_lahir->diffInYears(Carbon::now());
            
            // Simpan umur yang telah diperbarui ke dalam database
            $anak->usia = $usia;
            $anak->save();
        }

        Log::info('Successfully updated user ages.');
    }
}
