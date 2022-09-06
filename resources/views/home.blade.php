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
       <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
           

              <!-- Modal -->
              <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <form action="{{ route('userimport') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="file" name="file">
                     
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Import</button>
                    </div>
                  </div>
                </form>

                </div>
              </div>


            <table class="table">
              <thead class="thead" style="background-color: rgb(0, 162, 255);">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">ID USER</th>
                  <th scope="col">SESI</th>
                  <th scope="col" class="text-center">Action</th>
                </tr>
              </thead>
              <tbody> 
                @php
                    $i = 1;
                @endphp
                @foreach ( $user as $use)
                    <tr>
                      <td>{{ $i++ ;}}</td>
                      <td>{{ $use->name }}</td>
                      @if ( $use->level == "user")
                      <td>{{ $use->pengaturan->sesi }}</td>
                      @endif
                      <td class="text-center">
                        @if ( $use->level == "admin") 
                        @else
                        <a href="{{ url('users/' . $use->id . '/edit' ) }}" class=""><i class="fas fa-pen ml-3"></i></a>
                        <a href="{{ url('hapususer/'.$use->id) }}"  class="btn"><i class="fas fa-trash"></i></a>
                        @endif
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            {{ $user->links() }}
            <a href="{{ url('laporan') }}" class="btn btn-block btn-primary mb-3">Laporan</a>
            {{-- <a href="{{ url('register') }}" class="btn btn-danger mb-3">Register</a> --}}
            <a href="#" class="btn btn-block btn-success mb-3" data-toggle="modal" data-target="#exampleModalLong">Import</a>
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
