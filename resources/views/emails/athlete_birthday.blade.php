<h2>🎉 Notifikasi Ulang Tahun Atlet</h2>

<p>Pelatih yang terhormat,</p>

<p>Berikut adalah daftar atlet yang berulang tahun hari ini:</p>

<ul>
@foreach ($athletes as $athlete)
    <li>
        <strong>{{ $athlete->name }}</strong>  
        ({{ \Carbon\Carbon::parse($athlete->birthdate)->age }} tahun)
    </li>
@endforeach
</ul>

<p>Jangan lupa memberi ucapan atau perhatian khusus hari ini.</p>

<p>Salam,<br>Aplikasi Manajemen Atlet</p>
