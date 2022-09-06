<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  @include('Template.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('Template.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('Template.left-side')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

     @if ( auth()->user()->level == "admin")
     <a href="{{ url('/home') }}" class="btn btn-primary mb-3 ml-3">KEMBALI</a>
     <a href="{{ url('/laporan') }}" class="btn btn-primary mb-3 ml-3">LAPORAN</a>
     <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form action="{{ url('/laporan/cari') }}" method="get">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Tanggal</label>  
            </div>
            <input type="date" name="tanggal" style="width: 500px;">
            <button type="submit" class="btn btn-primary" value="tanggal">Cari...</button>
          </div>
          </form>
        </div>
        
      </div>
      @if ( isset($cari))
      <h3>Data Tanggal : {{ $cari }}</h3>
      @endif
    </div>
     
     <div class="container">
      <div class="row">
        <div class="col-md-12">
          
          <div class="table-responsive">
           <button class="btn btn-block btn-success mb-3" onclick="tablesToExcel(['tbl1'], ['Laporan'], 'laporan-{{$cari}}.xls', 'Excel')">Export</button> 
          <table id="tbl1" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">LEVEL</th>
                    <th scope="col">ID KARISMA</th>
                    <th scope="col">KETERANGAN</th>
                    <th scope="col">JAM HADIR</th>
                    <th scope="col">TANGGAL HADIR</th>
                    <th scope="col">ABSEN PULANG</th>
                    <th scope="col">NIP</th>
                    <th scope="col">SESI</th>
                </tr>
            </thead>
              <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ( $md as $model)
                    <tr>
                        <td>{{ $i++}}</td>
                        <td>{{ $model->level }}</td>
                        <td>{{ $model->name }}</td>
                        <td>{{ $model->keterangan }}</td>
                        <td>{{ $model->jam_hadir }}</td>
                        <td>{{ $model->tanggalHadir }}</td>
                        <td>{{ $model->absen_pulang }}</td>
                        <td>{{ $model->user->nip }}</td> 
                        <td>{{ $model->user->pengaturan->sesi }}</td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
        </div>  
          {{ $md->links() }}
        </div>
      </div>
     </div>
     
     
     @endif
    <!-- /.content -->
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
@include('Template.script')

<!-- export js -->
<script src="{{ URL::to('export_js/export.js')}}"></script>
</body>
</html>
