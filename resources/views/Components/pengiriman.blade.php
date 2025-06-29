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
    <link rel="stylesheet" href="{{ asset('style/pengiriman.css') }}">

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
           <!-- Tambahkan Pengiriman-->
            <div class="add-new-Asset" onclick="openPengirimanModal()">
                <button class="new-asset-btn">
                        <img src="{{ asset('image/add.png') }}" alt="plus">
                        Pengiriman
                    </button>
            </div>
            
            
                

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
                    <tr>
                      <th>#</th>
                      <th>ID Pengiriman</th>
                      <th>Serial Number</th>
                      <th>Asset</th>
                      <th>Tanggal Pengiriman</th>
                      <th>PIC Pengirim</th>
                      <th>PIC Penerima</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($pengiriman as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->id }}</td>

              {{-- relasi: pengiriman ➜ detailAsset ➜ serialnumber --}}
              <td>{{ $item->detailAsset->serialnumber ?? 'N/A' }}</td>

              {{-- merk & tipe disimpan di tabel assets  --}}
              <td>
                {{ $item->detailAsset->asset->merk  ?? '-' }}
                {{ $item->detailAsset->asset->tipe  ?? '' }}
              </td>

              <td>{{ \Carbon\Carbon::parse($item->tanggal_pengiriman)->format('d-m-Y') }}</td>
              <td>{{ $item->pic_pengirim  }}</td>
              <td>{{ $item->pic_penerima }}</td>
            </tr>
          @empty
          @endforelse
                  </tbody>
                </table>
              </div>

      <!-- Dasboard Modals Pengiriman -->
    
    <div class="kirim-overlay" id="modalpengiriman">
      <div class="kirim">
        <div class="kirim-header">
          <h2 class="add-asset-title">Pengiriman</h2>
          <button class="kirim-close" onclick="closePengirimanModal()">&times;</button>
        </div>
    <div class="kirim-body">
      <form method="post" action="{{route('kirim')}}" id="">
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
            <label class="form-label">Project*</label>
            <!-- Hidden input untuk dikirim -->
            <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}">
  
            <!-- Read-only input hanya untuk tampil -->
            <input type="text" class="form-control" value="{{ $project->nama_project }}" disabled>
          </div>
          <div class="form-group">
            <label class="form-label">Tanggal Pengiriman*</label>
            <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Pic Pengirim*</label>
            <input type="text" class="form-control" id="pic_pengirim" name="pic_pengirim" required "> 
          </div>
          <div class="form-group">
            <label class="form-label">Pic Penerima*</label>
            <input type="text" class="form-control" id="pic_penerima" name="pic_penerima" required value="{{old('pic_penerima')}}">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Asset*</label>
            <select name="detailasset_id" class="form-select" required>
              <option value="">-- pilih unit --</option>
              @foreach($availableUnits as $unit)
                <option value="{{ $unit->id }}">
                  {{ $unit->asset->merk }} - {{ $unit->asset->tipe }} | SN: {{ $unit->serialnumber }}
                </option>
              @endforeach
            </select>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closePengirimanModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">Input Pengiriman</button>
        </div>
      </form>
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
<script src="{{ asset('js/pengiriman.js') }}"></script>

</body>
</html>