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
    @if ( $md->level == "user")
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
        <form action="{{ url('users/' . $md->id ) }}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="PATCH">
          <label for="Sesi">SESI</label>
          <select class="custom-select" id="inputGroupSelect01" name="pengaturanid">
            <option value="1">sesi 1</option>
            <option value="2">sesi 2</option>
            <option value="3">sesi 3</option>
          </select>
          <div class="form-group">
            <label for="name">ID</label>
            <input type="text" class="form-control"  name="name" value="{{ $md->name }}">
          </div>
          <div class="form-group">
            {{-- <label for="keterangan">KETERANGAN</label> --}}
            <input type="hidden" class="form-control" name="keterangan"  value="{{ $md->keterangan }}">
          </div>
          <div class="form-group">
            {{-- <label for="keterangan">JAM HADIR</label> --}}
            <input type="hidden" class="form-control" name="jamhadir"  value="{{ $md->jam_hadir }}">
          </div>
          <div class="form-group">
            {{-- <label for="keterangan">TANGGAL HADIR</label> --}}
            <input type="hidden" class="form-control" name="tanggalhadir"  value="{{ $md->tanggalHadir }}">
          </div>
          <div class="form-group">
            {{-- <label for="keterangan">ABSEN PULANG</label> --}}
            <input type="hidden" class="form-control" name="absenpulang"  value="{{ $md->absen_pulang}}">
          </div>
          <div class="form-group">
            <label for="keterangan">NIP</label>
            <input type="text" class="form-control" name="nip"  value="{{ $md->nip }}">
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      </div>
    </div>
     @endif   
     @if ( $md->level == "admin")
       <div class="container">
        <div class="row">
          <div class="col-md-8">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">ID USER</th>
                  <th scope="col">SESI</th>
                  <th scope="col">keterangan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody> 
                @foreach ( $user as $use)
                    <tr>
                      <td>{{ $use->name }}</td>
                      <td>{{ $use->sesi }}</td>
                      <td>{{ $use->keterangan }}</td>
                      <td>
                        <a href="{{ url('users/' . $use->id . '/edit' ) }}"><i class="fas fa-pen mr-4"></i></a>
                        <a href=""><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            
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
</body>
</html>
