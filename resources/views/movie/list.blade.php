@extends('layouts.master')

@section('content')
	<h1>Movie Catalogue</h1>

	<div class="row">
		<div class="col-sm-6 col-md-8">
			<h2>Add movie</h2>
			@if (count($formats) && count($categories))
				<form method="POST" action="/movie">
					<input type="hidden" name="_method" value="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
					<div class="row">
						<div class="col-sm-6"><p><input type="text" name="title" placeholder="Title" class="form-control"></p></div>
						<div class="col-sm-6"><p><input type="text" name="secondary_title" placeholder="Secondary title" class="form-control"></p></div>
					</div>

					<p>
						<label class="checkbox-inline"><input type="checkbox" name="favourite" value="1"> Favourite?</label>
						<label class="checkbox-inline"><input type="checkbox" name="watched" value="1" checked="checked"> Watched?</label>
					</p>


					<p>
						@foreach ($formats as $format)
							<label class="radio-inline"><input type="radio" name="format" value="{{ $format->id }}"> {{ $format->name }}</label>
						@endforeach
					</p>
					
					<p>
						@foreach ($categories as $category)
							<label class="radio-inline"><input type="radio" name="category" value="{{ $category->id }}"> {{ $category->name }}</label>
						@endforeach
					</p>
					<p><button type="submit" class="btn btn-primary">Add movie</button></p>
				</form>
			@else
				<p>Please add some formats and categories first!</p>
			@endif
		</div>

		<div class="col-sm-6 col-md-4">
			<h2>Add format</h2>
			<form method="POST" action="/format" class="form-inline">
				<input type="hidden" name="_method" value="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" name="name" placeholder="Name" class="form-control">
				<button type="submit" class="btn btn-primary">Add format</button>
			</form>

			<h2>Add category</h2>
			<form method="POST" action="/category" class="form-inline">
				<input type="hidden" name="_method" value="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" name="name" placeholder="Name" class="form-control">
				<button type="submit" class="btn btn-primary">Add category</button>
			</form>
		</div>
	</div>

	@if (count($movies) > 0)
		<h2>Movie list contains {{ count($movies) }} movies</h2>
		<table>
			<tr>
				<th><a href="/list">Titel</a></th>
				<th></th>
				<th></th>
				<th><a href="/list/format">Format</a></th>
				<th><a href="/list/category">Kategori</a></th>
			</tr>
			@foreach ($movies as $movie)
				<tr>
					<td>{{ $movie->title }}</td>
					<td>{{ $movie->favourite ? '[F]' : '' }}</td>
					<td>{{ !$movie->watched ? '[N]' : '' }}</td>
					<td>{{ $movie->format->name }}</td>
					<td>{{ $movie->category->name }}</td>
				</tr>
			@endforeach
		</table>
	@endif
@endsection