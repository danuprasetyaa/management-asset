<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>

    <!-- Link Bostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

    <!-- Link CSS --> 
    <link rel="stylesheet" href="{{ asset('style/asside.css') }}">
    <link rel="stylesheet" href="{{ asset('style/project.css') }}">

  </head>
<body>
    <div class="container-fluid">
        
    @include('components/asside')

        <main class="main-content" >
            <header>
                <button id="toggleSidebar" class="sidebar-toggle"><img src="{{ asset('image/list.png') }}" alt="List"></button>
                <h1>{{ $project->nama }}</h1>
                <div class="user-menu">
                    <span class="notification"><img src="{{ asset('image/notification.png') }}" alt="notification"></span>
                    <div class="user-profile">
                        <span><img src="{{ asset('image/user.png') }}" alt="User"></span>
                        <span><img src="{{ asset('image/dropdown.png') }}" alt="dropdown"></span>
                    </div>
                </div>
            </header>

            <!-- Tabel Container-->
              <div class="table-card mb-4">
                <div class="table-card-header">
                  <i class="fas fa-table mr-1"></i>
                  <span>Data Rental</span>
                </div>
               <div class="table-card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <thead>
      <tr>
        <th>#</th>
        <th>Project</th>
        <th>Pengiriman</th>
        <th>Status</th>
        <th>Periode</th>
        <th>Total (Rp)</th>
      </tr>
    </thead>
                  </thead>
                  <tbody>
                  @forelse ($project->rentals as $r)
      <tr>
        <td>{{ $r->id }}</td>
        <td>{{ $project->nama }}</td>
        <td>{{ $r->pengiriman_id }}</td>        {{-- FK ke tabel pengiriman --}}
        <td>{{ ucfirst($r->status) }}</td>
        <td>{{ $r->periode_mulai }} – {{ $r->periode_ahir }}</td>
        <td>{{ number_format($r->total_tagihan,0,',','.') }}</td>
      </tr>
    @empty
      <tr><td colspan="6" class="text-center">Tidak ada data rental…</td></tr>
    @endforelse
                  </tbody>
                </table>
              </div>
     
        </main>
    </div>
    
  </div>
</div>



<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Bootstrap 4 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- Java Script -->
<script src="{{ asset('js/asside.js') }}"></script>

</body>
</html>