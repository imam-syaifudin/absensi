<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  @include('Template.head');
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('Template.navbar');
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('Template.left-side');

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
    @if ( auth()->user()->level == "user")
          <div class="container">
          <div class="row">
            <div class="col-md-8 text-center">
              <form action="{{ url('users/' . auth()->user()->id ) }}" method="POST">
              @csrf
              <div class="input-group mb-3">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                <input type="hidden" name="level" value="{{ auth()->user()->level }}">
                <input type="hidden" name="sesi" value="{{ auth()->user()->sesi }}">
                @if ( auth()->user()->keterangan == "tidak hadir")
                <?php 
                date_default_timezone_set("Asia/Jakarta");
                              $sesi1 = [8,9,10];
                              $sesi2 = [12,13,14];
                              $sesi3 = [15,16,17];
                              $jamSekarang = date('H');
                              $default = "tidak hadir";
                              $alert = 
                              " 
                              <script>
                                  alert('Sekarang bukan sesi anda!!')
                              </script>        
                              ";
                    
                              if ( auth()->user()->sesi == 'sesi 1') {
                                if ( in_array($jamSekarang,$sesi1) ){
                                    $default = 'hadir';
                                } else if ( in_array($jamSekarang,[6,7,8])){
                                     echo $alert;
                                } 
                                else {
                                    $default = 'hadir ( telat )';
                                }
                                  } else if ( auth()->user()->sesi == 'sesi 2') {
                                      if ( in_array($jamSekarang,$sesi2) ){
                                          $default = 'hadir';
                                      } else if ( in_array($jamSekarang,[6,7,8,9,10,11])){
                                            echo $alert;
                                      }  
                                      else {
                                          $default = 'hadir ( telat )';
                                      }
                                  }  else if ( auth()->user()->sesi == 'sesi 3') {
                                      if ( in_array($jamSekarang,$sesi3) ){
                                          $default = 'hadir';
                                      } else if ( in_array($jamSekarang,[6,7,8,9,10,11,12,13,14])){
                                           echo $alert;
                                      }   
                                      else {
                                          $default = 'hadir ( telat )';
                                      }
                                   }
                  
                 echo "<input type='text' class='form-control' name='keterangan' value='$default' readonly>";
                ?>
                @else
                <input type="text" class="form-control" name="keterangan" value="anda sudah absen" disabled>
                @endif
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <input type="hidden" name="password" value="{{ auth()->user()->password }}">
                <input type="hidden" name="remember_token" value="{{auth()->user()->remember_token }}">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
                <!-- /.col -->
                @if ( auth()->user()->keterangan == 'tidak hadir' )
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block" style="margin-left: 210px;">KIRIM</button>
                </div>
                @else
                 <a href="#" class="btn btn-primary btn-block nav-link disabled text-dark">ANDA SUDAH ABSEN</a>
                @endif
                <!-- /.col -->
              </div>
            </form>
            </div>
          </div>
          </div>
     @endif
     @if ( auth()->user()->level == "admin")
     <a href="{{ url('/laporan') }}" class="btn btn-primary mb-3 ml-3">KEMBALI</a>
     <div class="container">
      <div class="row">
        <div class="col-md-8">
          <form action="/tanggal" method="get">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect01">Tanggal</label>
              
            </div>
            
            <select class="custom-select" name="tanggal" id="inputGroupSelect01">
              <option value="26-07-2022">26-07-2022</option>
              <option value="27-07-2022">27-07-2022</option>
              <option value="28-07-2022">28-07-2022</option>
            </select>
            <button type="submit" class="btn btn-primary">Cari...</button>
          </form>
          </div>
        </div>
      
      </div>
     </div>
     <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">LEVEL</th>
                <th scope="col">ID KARISMA</th>
                <th scope="col">SESI</th>
                <th scope="col">KETERANGAN</th>
                <th scope="col">JAM HADIR</th>
                <th scope="col">TANGGAL HADIR</th>
              </tr>
        </thead>
          <tbody>
            @foreach ( $md as $model)
                <tr>
                    <td>{{ $model->level }}</td>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->sesi }}</td>
                    <td>{{ $model->keterangan }}</td>
                    <td>{{ $model->jam_hadir }}</td>
                    <td>{{ $model->tanggalHadir }}</td>
                </tr>
            @endforeach
          </tbody>
      </table>
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
@include('Template.script');
</body>
</html>
