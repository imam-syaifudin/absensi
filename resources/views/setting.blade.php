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
   
    <!-- /.content-header -->

    <!-- Main content -->

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

           <div class="container">
            <div class="row">
              <div class="col-md-8">
                <a href="{{ url('pengaturan/create') }}" class="btn btn-primary mb-3">TAMBAH DATA</a>
                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">SESI</th>
                      <th scope="col">JAM MULAI</th>
                      <th scope="col">JAM TELAT</th>
                      <th scope="col">DURASI</th>
                      <th scope="col">ACTION</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @foreach ( $user as $use)
                        <tr>
                          <td>{{ $use->sesi }}</td>
                          <td>{{ $use->jam_mulai }}</td>
                          <td>{{ $use->jam_selesai }}</td>
                          <td>{{ $use->durasi_waktu }} Jam</td>
                          <td>
                            <a href="{{ url('pengaturan/' . $use->id . '/edits' ) }}" class="btn btn-success">edit data</a>
                            {{-- <a href="{{ url('hapuspengaturan/' . $use->id ) }}"><i class="fas fa-trash"></i></a> --}}
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                
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
