@extends('template')

@section('main')

<h1 class="text-center">Tambah Data Siswa</h1>

<form action="{{route('siswa.store')}}" method="POST">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">NIS</label>
    <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{old('nis')}}" placeholder="Masukkan NIS">
   </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nama</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}" placeholder="Masukkan Nama">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Alamat</label>
    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{old('alamat')}}" placeholder="Masukkan Alamat">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"id="jenis_kelamin">
      <option value="Laki-Laki">Laki-Laki</option>
      <option value="Perempuan">Perempuan</option>
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@stop