@extends('layouts.admin')

@section('content')

<div class="table-responsive">
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>City</th>
            <th>Address</th>
            <th>Description</th>
            <th>Visible</th>
            <th>Action</th>
            <th><a href="{{ route('admin.apartments.create') }}"><i class="fas fa-plus createcircle"></i></a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($apartments as $apartment)
        <tr>
            <td>{{ $apartment->id }}</td>
            <td>{{ $apartment->title }}</td>
            <td><img width="100" src="{{ $apartment->image }}" alt=""></td>
            <td>{{ $apartment->city }}</td>
            <td>{{ $apartment->address }}</td>
            <td>{{ $apartment->description }}</td>
            <td>{{ $apartment->visible }}</td>
           
            <td class="text-center">
                <a href="{{route('admin.apartments.show', $apartment->id )}}" class="btn btn-primary mt-3 mb-3">
                    <i class="fas fa-eye fa-sm fa-fw"></i>
                </a>
                <a href="{{route('admin.apartments.edit', $apartment->id )}}" class="btn btn-secondary mb-3">
                    <i class="fas fa-pencil-alt fa-sm fa-fw"></i>
                </a>
                <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash fa-sm fa-fw"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
    
@endsection