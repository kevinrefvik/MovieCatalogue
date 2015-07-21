<h1>Movie Catalogue</h1>

<h2>Add movie</h2>
@if (count($categories))
	<form method="POST" action="/movie">
		<input type="hidden" name="_method" value="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<p>
			<input type="text" name="title" placeholder="Title">
			<input type="text" name="secondary_title" placeholder="Secondary title">
			<input type="checkbox" name="favourite" id="favourite" value="1"> <label for="favourite">Favourite?</label>
			<input type="checkbox" name="watched" id="watched" value="1" checked="checked"> <label for="watched">Watched?</label>
		</p>

		<p>
			<input type="radio" name="format"> Blu-ray
			<input type="radio" name="format"> Blu-ray 3D
			<input type="radio" name="format"> DVD<br>
		</p>
		
		<p>
			@foreach ($categories as $category)
				<input type="radio" name="format"> {{ $category->name }}
			@endforeach
		</p>
		<p><button type="submit">Add</button></p>
	</form>
@else
	<p>Please add some categories first!</p>
@endif

<h2>Add category</h2>

<form method="POST" action="/category">
	<input type="hidden" name="_method" value="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="text" name="name" placeholder="Name">
	<button type="submit">Add</button>
</form>

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
				<td>{{ $movie->format }}</td>
				<td>{{ $movie->category->name }}</td>
			</tr>
		@endforeach
	</table>
@endif