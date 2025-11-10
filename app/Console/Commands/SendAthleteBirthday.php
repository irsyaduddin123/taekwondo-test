<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Athlete;
use App\Mail\AthleteBirthdayNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendAthleteBirthday extends Command
{
    protected $signature = 'athletes:birthday';
    protected $description = 'Kirim email notifikasi ulang tahun atlet';

    public function handle()
    {
        $today = Carbon::now()->format('m-d');

        $athletes = Athlete::whereRaw("DATE_FORMAT(birthdate, '%m-%d') = ?", [$today])->get();

        if ($athletes->count() > 0) {

            // daftar email pelatih (bisa ambil dari table user role=pelatih)
            $coaches = \App\Models\User::where('role', 'pelatih')->pluck('email')->toArray();

            foreach ($coaches as $email) {
                Mail::to($email)->send(new AthleteBirthdayNotification($athletes));
            }

            $this->info("Email notifikasi ulang tahun sudah terkirim.");
        } else {
            $this->info("Tidak ada atlet ulang tahun hari ini.");
        }
    }
}
