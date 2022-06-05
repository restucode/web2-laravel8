@extends('layout.v_template')
@section('title', 'DETAIL GURU')
@section('content')
	<table class="table">
		<tr>
			<th width="150px">NIP</th>
			<th width="30px">:</th>
			<th>{{ $guru->nip }}</th>
		</tr>		

		<tr>
			<th width="150px">NAMA GURU</th>
			<th width="30px">:</th>
			<th>{{ $guru->nama_guru }}</th>
		</tr>		

		<tr>
			<th width="150px">MATA PELAJARAN</th>
			<th width="30px">:</th>
			<th>{{ $guru->mapel }}</th>
		</tr>		

		<tr>
			<th width="150px">FOTO</th>
			<th width="30px">:</th>
			<th><img src="{{ url('img/'.$guru->foto_guru) }}" alt="" width="200px"></th>
		</tr>
		<tr>
			<td><a href="/guru" class="btn btn-success">Kembali</a></td>
		</tr>
	</table>
@endsection