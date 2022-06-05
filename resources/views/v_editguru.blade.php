@extends('layout.v_template')
@section('title', 'EDIT GURU')
@section('content')
<form action="/guru/update/{{ $guru->id_guru }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="content">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="">NIP</label>
					<input type="text" name="nip" class="form-control" value="{{ $guru->nip }}" readonly>
					<div class="text-danger">
						@error('nip')
                          {{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label for="">NAMA GURU</label>
					<input type="text" name="nama_guru" class="form-control" value="{{ $guru->nama_guru }}">
					<div class="text-danger">
						@error('nama_guru')
                          {{ $message }}
						@enderror
					</div>
				</div>

				<div class="form-group">
					<label for="">MATA PELAJARAN</label>
					<input type="text" name="mapel" class="form-control" value="{{ $guru->mapel }}">
					<div class="text-danger">
						@error('mapel')
                          {{ $message }}
						@enderror
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-4">
						<img src="{{ url('img/'.$guru->foto_guru) }}" width="100px" alt="">
					</div>
					<div class="col-sm-8">
						<div class="form-group">
							<label for="">FOTO GURU</label>
							<input type="file" name="foto_guru" class="form-control">
							<div class="text-danger">
								@error('foto_guru')
		                          {{ $message }}
								@enderror
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<button class="btn btn-sm btn-primary">SIMPAN</button>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
