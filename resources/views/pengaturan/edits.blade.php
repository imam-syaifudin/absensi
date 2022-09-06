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
    
        {{-- <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <form action="{{ url('pengaturan/' . $md->id ) }}" method="POST">
               @csrf
                <div class="input-group mb-3">
                  
                <div class="input-group mb-3" style="margin-left: 80px;">
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="text" name="sesi" value="{{ $md->sesi }}">
                  <input type="time" min="09:00" max="18:00" name="jammulai" value="{{ $md->jam_mulai }}">
                  <input type="time" min="09:00" max="18:00" name="jamtelat" value="{{ $md->jam_telat }}">
                  <input type="time" min="09:00" max="18:00" name="jampulang" value="{{ $md->jam_pulang }}">
                <div class="input-group-append">
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block mb-3" style="margin-left: 100px;">KIRIM</button>             
                </div>
                </div>
                </div>
                <!-- /.col -->
               </div>
              </form>
            </div>
          </div>
        </div> --}}

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <h3>Keterangan Jam</h3>
              <h3>01:00 - 12:00 ( AM )</h3>
              <h3>13:00 - 00:00 ( PM )</h3>
            <form action="{{ url('pengaturan/' . $md->id ) }}" method="POST">
              @csrf
              <input type="hidden" name="_method" value="PATCH">
              <div class="form-group">
                <label for="sesi">SESI</label>
                <input type="text" class="form-control"  name="sesi" placeholder="SESI" value="{{ $md->sesi }}">
              </div>
              <div class="form-group">
                <label for="jmmulai">JAM MULAI</label>
                <input type="time"  name="jammulai" style="width: 700px; height: 50px;" value="{{ $md->jam_mulai }}">
              </div>
              <div class="form-group">
                <label for="jamselesai">JAM SELESAI ABSEN</label>
                <input type="time"  name="jamselesai" style="width: 700px; height: 50px;" value="{{ $md->jam_selesai }}">
              </div>
              <div class="form-group">
                <label for="durasi_waktu">DURASI WAKTU ( JAM )</label>
                <input type="number"  name="durasi_waktu" style="width: 700px; height: 50px;" value="{{ $md->durasi_waktu }}">
              </div>
              
            
              
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
          </div>
        </div>
   
  

     
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
