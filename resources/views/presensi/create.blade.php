@extends('layout.presensi')
@section('header')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="pageTitle">E-Presensi</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<style>
    .webcam-capture,
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }

    /* Non-mirror webcam preview */
    .webcam-capture video {
        transform: scaleX(-1);
    }
</style>

@endsection

@section('content')

<div class="row" style="margin-top: 70px;">
    <div class="col">
        <input type="hidden" id="lokasi">
        <div class="webcam-capture"></div>
    </div>
</div>

<div class="row justify-content-center mt-3">
    <div class="col-6 text-center">
        @if ($cek>0)
        <button id="takeabsen" class="btn btn-danger w-100">
            <ion-icon name="camera-outline"></ion-icon>Absen Keluar
        </button>
        @else
        <button id="takeabsen" class="btn btn-primary w-100">
            <ion-icon name="camera-outline"></ion-icon>Absen Masuk
        </button>
        @endif
    </div>
</div>

<div class="row mt-2">
    <div class="col">
        <div id="map" style="height: 200px; border-radius: 10px;"></div>
    </div>
</div>

@endsection

@push('jscamera')

<script>
    // webcam
    Webcam.set({
        height: 480,
        width: 640,
        image_format: 'jpeg',
        jpeg_quality: 80
    });
    Webcam.attach('.webcam-capture');

   // lokasi toko dari controller
const tokoLat = {{ $lokasi_toko['latitude'] }};
const tokoLng = {{ $lokasi_toko['longitude'] }};

var lokasi = document.getElementById('lokasi');
var absenBtn = document.getElementById('takeabsen');
absenBtn.disabled = true; // disable tombol dulu

// Fungsi hitung jarak Haversine (meter)
function getDistanceFromLatLonInMeters(lat1, lon1, lat2, lon2) {
    var R = 6371000; // Radius bumi dalam meter
    var dLat = (lat2 - lat1) * Math.PI / 180;
    var dLon = (lon2 - lon1) * Math.PI / 180;
    var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c;
    return d;
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(succesCallback, errorCallback);
} else {
    alert('Geolocation tidak didukung oleh browser Anda.');
}

function succesCallback(position) {
    const latUser = position.coords.latitude;
    const lngUser = position.coords.longitude;

    lokasi.value = latUser + "," + lngUser;

    // Hitung jarak user ke toko
    const jarak = getDistanceFromLatLonInMeters(latUser, lngUser, tokoLat, tokoLng);

if (jarak > 50) {
    Swal.fire({
        icon: 'error',
        title: 'Gagal Absen',
        text: 'Anda berada di luar radius 50 meter dari toko. Absen tidak bisa dilakukan.',
        confirmButtonText: 'OK'
    });
    absenBtn.disabled = true;
} else {
    absenBtn.disabled = false;
}

    // Inisialisasi map dan marker seperti biasa
    var map = L.map('map').setView([latUser, lngUser], 17);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    L.marker([latUser, lngUser]).addTo(map);

    L.circle([tokoLat, tokoLng], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 50
    }).addTo(map);
}

function errorCallback() {
    alert('Tidak dapat mendapatkan lokasi Anda. Mohon aktifkan GPS dan izinkan akses lokasi.');
    absenBtn.disabled = true;
}

// Ketika klik absen, lokasi sudah pasti valid karena tombol disable jika lokasi tidak valid
$('#takeabsen').click(function (e) {
    var $btn = $(this);
    $btn.prop('disabled', true); // disable tombol supaya tidak bisa diklik lagi
    var originalText = $btn.html(); // simpan teks asli tombol

    // Ganti teks tombol dengan loading spinner (Bootstrap)
    $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

    Webcam.snap(function (uri) {
        var image = uri;
        var lokasi = $("#lokasi").val();
        $.ajax({
            type: 'POST',
            url: '/presensi/store',
            data: {
                _token: "{{ csrf_token() }}",
                image: image,
                lokasi: lokasi
            },
            cache: false,
            success: function (respond) {
                var status = respond.split("|");
                if (status[0] == 'success') {
                    Swal.fire({
                        title: 'Berhasil',
                        text: status[1],
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/dashboard';
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Maaf Gagal Absen, Silahkan Hubungi IT',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    // Kembalikan tombol ke semula
                    $btn.prop('disabled', false);
                    $btn.html(originalText);
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan jaringan atau server',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                $btn.prop('disabled', false);
                $btn.html(originalText);
            }
        });
    });
});




</script>
@endpush
