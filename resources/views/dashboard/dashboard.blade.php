@extends('layout.presensi')

@section('content')
<div class="section" id="user-section">
    <div id="user-detail">
        <div class="avatar">
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ $nama->nama_lengkap }}</h2>
            <span id="user-role">{{ $nama->jabatan }} | {{ $nama->nama_toko }}</span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="green" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="danger" style="font-size: 40px;">
                            <ion-icon name="calendar-number"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Cuti</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="" class="orange" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent row">
                            <div class="iconpresence" style="margin-right: 5px">
                                @if ($presensiNow && $presensiNow->foto_in)
                                <img src="{{ asset('uploads/absensi/' . $presensiNow->foto_in) }}" alt="Foto Absen"
                                    class="imaged w64">
                                @else
                                <ion-icon name="camera-outline" style="font-size:48px;"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>
                                    @if ($presensiNow == null)
                                    Belum Absen
                                    @else
                                    {{ $presensiNow->jam_in }}
                                    @endif
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent row">
                            <div class="iconpresence" style="margin-right: 5px">
                                @if ($presensiNow && $presensiNow->foto_out)
                                <img src="{{ asset('uploads/absensi/' . $presensiNow->foto_out) }}" alt="Foto Absen"
                                    class="imaged w64">
                                @else
                                <ion-icon name="camera-outline" style="font-size:48px;"></ion-icon>
                                @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>
                                    @if ($presensiNow == null || $presensiNow->jam_out == null)
                                    Belum Absen
                                    @else
                                    {{ $presensiNow->jam_out }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="rekappresence">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body" style="padding: 0%">
                        <div class="presencecontent flex" style="height: auto; width:100%; padding:5px;" >
                            <div class="iconpresence primary text-center">
                                <ion-icon name="log-in" style="font-size: 2.5rem;"></ion-icon>
                                <h4 class="rekappresencetitle">Hadir</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body" style="padding: 0%">
                        <div class="presencecontent flex" style="height: auto; width:100%; padding:5px;" >
                            <div class="iconpresence green text-center">
                                <ion-icon name="document-text" style="font-size: 2.5rem;"></ion-icon>
                                <h4 class="rekappresencetitle">Izin</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body" style="padding: 0%">
                        <div class="presencecontent flex" style="height: auto; width:100%; padding:5px;" >
                            <div class="iconpresence warning text-center">
                                <ion-icon name="sad" style="font-size: 2.5rem;"></ion-icon>
                                <h4 class="rekappresencetitle">Sakit</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body" style="padding: 0%">
                        <div class="presencecontent flex" style="height: auto; width:100%; padding:5px;" >
                            <div class="iconpresence danger text-center">
                                <ion-icon name="alarm" style="font-size: 2.5rem;"></ion-icon>
                                <h4 class="rekappresencetitle">Telat</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div id="rekappresensi">
        <h4>Rekap Absensi</h4>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 16px 8px; !important">
                        <span class="badge bg-danger text-center" style="position: absolute; top:-5px; right:-5px; font-size:1rem">10</span>
                        <ion-icon name="accessibility-outline" style="font-size: 1.8rem" class="text-primary"></ion-icon>
                        <br>
                        <span style="font-weight: 500">Hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                     <div class="card-body text-center" style="padding: 16px 8px; !important">
                        <span class="badge bg-danger text-center" style="position: absolute; top:-5px; right:-5px; font-size:1rem">10</span>
                        <ion-icon name="newspaper-outline" style="font-size: 1.8rem" class="text-success"></ion-icon>
                        <br>
                        <span style="font-weight: 500">Izin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 16px 8px; !important">
                        <span class="badge bg-danger text-center" style="position: absolute; top:-5px; right:-5px; font-size:1rem">10</span>
                        <ion-icon name="medkit-outline" style="font-size: 1.8rem" class="text-warning"></ion-icon>
                        <br>
                        <span style="font-weight: 500">Sakit</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                     <div class="card-body text-center" style="padding: 16px 8px; !important">
                        <span class="badge bg-danger text-center" style="position: absolute; top:-5px; right:-5px; font-size:1rem">10</span>
                        <ion-icon name="alarm-outline" style="font-size: 1.8rem" class="text-danger"></ion-icon>
                        <br>
                        <span style="font-weight: 500">Telat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        History Absen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($history as $row)
                    <li>
                        <a href="#" class="item">
                            <div class="icon-box bg-success">
                                <ion-icon name="calendar-outline"></ion-icon>
                            </div>
                            <div class="in row">
                                <div>{{ \Carbon\Carbon::parse($row->tanggal_presensi)->format('d M Y') }}</div>
                                <span class="badge bg-success me-1" style="margin-right: 0.5rem">
                                    {{ $row->jam_in ?? 'belum absen' }}
                                </span>
                                <span class="badge bg-danger">
                                    {{ $row->jam_out ?? 'belum absen' }}
                                </span>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Edward Lindgren</div>
                                <span class="text-muted">Designer</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Emelda Scandroot</div>
                                <span class="badge badge-primary">3</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection
