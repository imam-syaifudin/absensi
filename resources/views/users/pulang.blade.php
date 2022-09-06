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
    <div class="container">
      <div class="row">
          <div class="col-md-8">
              <form action="{{ url('updatelaporan/' . $arr["data"]->id) }}" method="POST">
                @csrf
                  <div class="form-group">
                    <label for="oi">Absen</label>
                    <input type="hidden" name="realid" value={{ auth()->user()->id}}>
                    <input type="hidden" name="id" value="{{ $arr['data']->id }}">
                    <input type="hidden" name="name" value="{{ $arr['data']->name }}">
                    <input type="text" class="form-control" id="oi" value="{{ $arr['value']}}" name="absenpulang" aria-describedby="" readonly>
                  </div>
                  @if ( $arr['value'] != "anda sudah absen pulang")
                  <button type="submit" class="btn btn-primary">Submit</button>
                  @endif
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
