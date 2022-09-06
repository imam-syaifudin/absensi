@extends('template')

@section('main')

<h1 class="text-center">Data Siswa</h1>
<a href="{{url('siswa/create')}}" class="btn btn-primary mb-3">Tambah Data</a>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">NIS</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Jenis Kelamin</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   @foreach ($data as $d)
    <tr>
        <td>{{ $d->nis }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->alamat }}</td>
        <td>{{ $d->jenis_kelamin }}</td>
        <td>
            <a href="{{ url('siswa/'.$d->id.'/edit')}}" class="mr-4 btn btn-warning"><i class="fas fa-pen"></i></a>
            <a href="{{url('hapussiswa/'.$d->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
        </td>
    </tr>
   @endforeach
  </tbody>
</table>

@stop