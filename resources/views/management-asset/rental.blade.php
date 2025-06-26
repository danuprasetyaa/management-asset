<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Rental</title>
    <!-- Link CSS -->
    <link rel="stylesheet" href="{{ asset('style/asside.css') }}">
    <link rel="stylesheet" href="{{ asset('style/rental.css') }}">
</head>
<body>
    <div class="container">
        
    @include('components/asside')

        <main class="main-content" >
            <header>
                <button id="toggleSidebar" class="sidebar-toggle"><img src="{{ asset('image/list.png') }}" alt="List" ></button>
                <h1>Rental Overview</h1> {{-- Mengubah H1 agar lebih umum --}}
                <div class="user-menu">
                    <span classs="notification"><img src="{{ asset('image/notification.png') }}" alt="notification"></span>
                    <div class="user-profile">
                        <span><img src="{{ asset('image/user.png') }}" alt="User"></span>
                        <span><img src="{{ asset('image/dropdown.png') }}" alt="dropdown"></span>
                    </div>
                </div>
            </header>
            
           <!-- Tambahkan Asset-->
            <div class="add-new-project" onclick="openModal()">
                <button class="new-project-btn">
                        <img src="{{ asset('image/add.png') }}" alt="plus">
                        Tambah Project
                    </button>
            </div>

            <!-- Modal add New Project-->
             <div class="add-project-overlay" id="modalAddProject">
                <div class="add-project">
                    <div class="add-project-header">
                    <h2 class="add-project-title">Add New Project</h2>
                    <button class="add-project-close" onclick="closeModal()">&times;</button>
                    </div>
                    <div class="add-project-body">
                    <form method="post" action="{{ route('addproject') }}" id="addprojectForm">
                            @csrf

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
                            <label class="form-label">Nama*</label>
                            <input type="text" class="form-control" id="nama" name="nama" required value="{{ old('nama') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Durasi Kontrak*</label>
                            <input type="text" class="form-control" id="durasi_kontrak" name="durasi_kontrak" required value="{{ old('durasi_kontrak') }}">
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="form-label">Harga Sewa*</label>
                        <input type="text" class="form-control" id="harga_sewa" name="harga_sewa" placeholder="Rp 0" required value="{{ old('harga_sewa') }}">
                        </div>

                        <div class="modal-footer">
                        <button type="button" class="btn btn-outline" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Project</button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>

                <!-- Tampilan Project Yang Berada di tabel Project -->
                    <div class="existing-projects-dashboard">
                        <h2>Project</h2>

                        @if(session('success'))
                            <div class="alert alert-success">
                             {{ session('success') }}
                            </div>
                        @endif

                        <div class="project-grid">
                            @forelse($data_project as $project)
                                <div class="project-card">
                                    <h3>{{ $project->nama }}</h3>
                                    <p>Durasi Kontrak: {{ $project->durasi_kontrak }} Tahun</p>
                                    <p>Harga Sewa: Rp {{ $project->harga_sewa }}</p>
                                    <a href="{{ route('project.tampil', $project->id) }}">Detail</a>
                                </div>
                            @empty
                                <p>Tidak ada project ditemukan.</p>
                            @endforelse
                        </div>
                    </div>
        </main>
    </div>
    <script src="{{ asset('js/asside.js') }}"></script>
    <script src="js/rental.js"></script>
</body>
</html>