<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Rental</title>
    <link rel="stylesheet" href="{{ asset('style/asside.css') }}">
    <link rel="stylesheet" href="{{ asset('style/inputtagihan.css') }}">
</head>
<body>
    <div class="container">
        @include('components/asside')

        <main class="main-content" >
            <header>
                <button id="toggleSidebar" class="sidebar-toggle"><img src="{{ asset('image/list.png') }}" alt="List" ></button>
                <h1>Tagihan -  {{ $project->nama }}</h1> 
                <div class="user-menu">
                    <span classs="notification"><img src="{{ asset('image/notification.png') }}" alt="notification"></span>
                    <div class="user-profile">
                        <span><img src="{{ asset('image/user.png') }}" alt="User"></span>
                        <span><img src="{{ asset('image/dropdown.png') }}" alt="dropdown"></span>
                    </div>
                </div>
            </header>
            
           <!-- Tambahkan Asset-->
            <div class="add-new-project" onclick="openModalTagihan()">
                <button class="new-project-btn">
                        <img src="{{ asset('image/add.png') }}" alt="plus">
                        Buat Invoice
                    </button>
            </div>

            <!-- Modal add New Project-->
             <div class="add-project-overlay" id="modalBuatTagihan">
                <div class="add-project">
                    <div class="add-project-header">
                    <h2 class="add-project-title">Tagihan</h2>
                    <button class="add-project-close" onclick="closeModalTagihan()">&times;</button>
                    </div>
                    <div class="add-project-body">
                    <form method="post" action="{{ route('buattagihan') }}">
                        @csrf
                        
                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nomor Invoice*</label>
                                <input type="text" class="form-control" name="nomor_invoice"
                                    value="{{ old('nomor_invoice') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Keterangan*</label>
                                <input type="text" class="form-control" name="keterangan"
                                    value="{{ old('keterangan') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanggal Tagihan*</label>
                                <input type="date" class="form-control" name="tanggal_tagihan"
                                    value="{{ old('tanggal_tagihan') }}" required>
                            </div>
                     </div>
                        <div class="form-row">
                         <div class="form-group">
                                @if($rental)
                                    {{-- hidden rental_id & isi otomatis --}}
                                    <input type="hidden" name="rental_id" value="{{ $rental->id }}">

                                    {{-- tampilkan info singkat saja, bukan dropdown --}}
                                    <p><strong>Rental ID:</strong> {{ $rental->id }}</p>

                                    <div class="form-group">
                                        <label class="form-label">Jumlah Unit*</label>
                                            <input  type="number" class="form-control"
                                                    name="jumlah_unit" readonly
                                                    value="{{ $unit }}">
                                    </div>

                                    {{-- Total Tagihan (readonly) --}}
                                    <div class="form-group">
                                        <label class="form-label">Total Tagihan*</label>
                                            <input  type="text" class="form-control"
                                                    name="total_tagihan" readonly
                                                    value="{{ number_format($total, 0, ',', '.') }}">
                                    </div>
                                @else
                                    <p class="alert alert-warning">
                                        Project ini belum memiliki rental. Silakan tambahkan rental dahulu.
                                    </p>
                                @endif
                            </div>
                         
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Periode Mulai*</label>
                                <input type="date" class="form-control" name="periode_mulai"
                                    value="{{ old('periode_mulai') }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Periode Akhir*</label>
                                <input type="date" class="form-control" name="periode_ahir"
                                    value="{{ old('periode_ahir') }}" required>
                            </div>

                            
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" onclick="closeModalTagihan()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Buat Tagihan</button>
                        </div>
                    </form>

                    </div>
                </div>
                </div>

                <!-- Tampilan Project Yang Berada di tabel Project -->
                    <div class="existing-projects-dashboard">
                        <h2></h2>

                        @if(session('success'))
                            <div class="alert alert-success">
                             {{ session('success') }}
                            </div>
                        @endif

                        <div class="project-grid">
                        @forelse ($data_tagihan as $detail)
                            <div class="project-card">
                                <h3>
                                    {{ \Carbon\Carbon::parse($detail->tagihan->tanggal_tagihan)->translatedFormat('F Y') }}
                                </h3>
                                <p>Tanggal Tagihan:
                                {{ \Carbon\Carbon::parse($detail->tagihan->tanggal_tagihan)->format('d-m-Y') }}
                                </p>
                                <p>Jumlah Unit: {{ $detail->jumlah_unit }}</p>
                                <p>Total Tagihan:
                                 Rp {{ number_format($detail->total_tagihan, 0, ',', '.') }}
                                </p>

                                <a href="{{ route('detailtagihan', $detail->tagihan_id) }}">Detail</a>
                            </div>
                        @empty
                            <p>Tidak ada tagihan ditemukan.</p>
                        @endforelse
                    </div>


                    </div>
        </main>
    </div>
    <script src="{{ asset('js/asside.js') }}"></script>
    <script src="{{ asset('js/inputtagihan.js') }}"></script>
</body>
</html>
