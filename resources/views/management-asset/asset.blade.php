<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Asset</title>

    <!-- Link Bostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

    <!-- Link CSS --> 
    <link rel="stylesheet" href="{{ asset('style/asside.css') }}">
    <link rel="stylesheet" href="{{ asset('style/asset.css') }}">

  </head>
<body>
    <div class="container-fluid">
        
    @include('components/asside')

        <main class="main-content" >
            <header>
                <button id="toggleSidebar" class="sidebar-toggle"><img src="{{ asset('image/list.png') }}" alt="List" ></button>
                <h1>Asset</h1>
                <div class="user-menu">
                    <span class="notification"><img src="{{ asset('image/notification.png') }}" alt="notification"></span>
                    <div class="user-profile">
                        <span><img src="{{ asset('image/user.png') }}" alt="User"></span>
                        <span><img src="{{ asset('image/dropdown.png') }}" alt="dropdown"></span>
                    </div>
                </div>
            </header>
           <!-- Tambahkan Asset-->
            <div class="add-new-Asset" onclick="openModal()">
                <button class="new-asset-btn">
                        <img src="{{ asset('image/add.png') }}" alt="plus">
                        Asset
                    </button>
            </div>
            
                

            <!-- Tabel Container-->
              <div class="table-card mb-4">
                <div class="table-card-header">
                  <i class="fas fa-table mr-1"></i>
                  <span>Data Asset</span>
                </div>
               <div class="table-card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Merk</th>
                      <th>Type</th>
                      <th>Serialnumber</th>
                      <th>Spesifikasi</th>
                      <th>Harga Pembelian</th>
                      <th>Tanggal Pembelian</th>
                      <th>Kondisi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $asset) 
                    <tr>
                      <td>{{$asset ->id}}</td>
                      <td>{{$asset ->merk}}</td>
                      <td>{{$asset ->type}}</td>
                      <td>{{$asset ->serialnumber}}</td>
                      <td>{{$asset ->spesifikasi}}</td>
                      <td>{{$asset ->tanggal_pembelian}}</td>
                      <td>{{$asset ->harga_pembelian}}</td>
                      <td>{{$asset ->kondisi}}</td>
                      <td>
                        <button class="btn btn-danger">Edit</button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            
     
        </main>
    </div>

    <!-- Dasboard Modals Asset -->
    
    <div class="add-asset-overlay" id="modalAddAsset">
      <div class="add-asset">
        <div class="add-asset-header">
          <h2 class="add-asset-title">Add New Asset</h2>
          <button class="add-asset-close" onclick="closeModal()">&times;</button>
        </div>
    <div class="add-asset-body">
      <form method="post" action="{{route('addasset')}}">
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
             <label for="merk" class="form-label">Merk*</label>
            <select class="form-control" id="merk" name="merk" required>
              <option value="">Merk</option>
               <option value="Asus" {{ old('merk') == 'Asus' ? 'selected' : '' }}>Asus</option>
              <option value="Acer" {{ old('merk') == 'Acer' ? 'selected' : '' }}>Acer</option>
              <option value="Dell" {{ old('merk') == 'Dell' ? 'selected' : '' }}>Dell</option>
              <option value="Hp" {{ old('merk') == 'Hp' ? 'selected' : '' }}>Hp</option>
              <option value="Lenovo" {{ old('merk') == 'Lenovo' ? 'selected' : '' }}>Lenovo</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Type*</label>
            <input type="text" class="form-control" id="type" name="type" required value="{{old('type')}}">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="serialnumber" class="form-label">Serialnumber*</label>
            <input type="text" class="form-control" id="serialnumber" name="serialnumber" required value="{{ old('serialnumber') }}">
          </div>
          <div class="form-group">
            <label class="form-label">Spesifikasi*</label>
            <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" required value="{{old('spesifikasi')}}">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Purchase Date*</label>
            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" required value="{{old('tanggal_pembelian')}}">
          </div>
          <div class="form-group">
            <label class="form-label">Purchase Price*</label>
            <input type="text" class="form-control" id="harga_pembelian" name="harga_pembelian" placeholder="Rp 0" required value="{{old('harga_pembelian')}}">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label for="kondisi" class="form-label">Condition*</label>
            <select class="form-control" id="kondisi" name="kondisi" required>
              <option value="">Pilih Kondisi</option>
               <option value="Normal" {{ old('kondisi') == 'Normal' ? 'selected' : '' }}>Normal</option>
              <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline" onclick="closeModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Asset</button>
        </div>
      </form>
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
<script src="js/asset.js"></script>

</body>
</html>