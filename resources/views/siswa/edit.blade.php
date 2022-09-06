@extends('template')

@section('main')

<h1 class="text-center">Edit Data Siswa</h1>

<form action="{{ url('siswa/'.$data->id) }}" method="POST">
    @csrf
    @method('put')
  <div class="form-group">
    <label for="exampleInputEmail1">NIS</label>
    <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{$data->nis}}" placeholder="Masukkan NIS">
   </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nama</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{$data->nama}}" placeholder="Masukkan Nama">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Alamat</label>
    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{$data->alamat}}" placeholder="Masukkan Alamat">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"id="jenis_kelamin">
      <option value="Laki-Laki" @if( $data->jenis_kelamin == "Laki-Laki") selected @endif >Laki-Laki</option>
      <option value="Perempuan" @if( $data->jenis_kelamin == "Perempuan") selected @endif >Perempuan</option>
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>



@stop