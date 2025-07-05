@props(['status'])

@php
    // Normalisasi status: membuat huruf awal setiap kata kapital
    $status = ucwords(strtolower($status));

    // Daftar status yang valid beserta kelas CSS-nya
    $validStatuses = [
        'Belum Diteruskan' => 'bg-yellow-100 text-yellow-500',
        'Sudah Ditindaklanjuti' => 'bg-green-100 text-green-500',
        // Jika perlu, misal untuk tampilan pimpinan:
        'Belum Didisposisi' => 'bg-red-100 text-red-500',
    ];

    // Jika status tidak valid, gunakan default
    if (!array_key_exists($status, $validStatuses)) {
        $status = 'Belum Diteruskan';
    }

    $badgeClass = $validStatuses[$status];
@endphp

<span class="px-2 py-1 rounded-full text-xs font-medium {{ $badgeClass }}">
    {{ $status }}
</span>
