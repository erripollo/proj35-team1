@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center my-3">
        <h1>All Apartments</h1>
        <a class="btn btn-primary" role="button" href="{{ route('admin.apartments.create') }}"><i
                class="fas fa-plus createcircle"></i> New Apartment</a>
    </div>

    @if ($apartments->isEmpty())

        <h2>Nothing to display</h2>

    @else
        <table class="table table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Visible</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                    <tr>
                        <td>{{ $apartment->id }}</td>
                        <td><img width="100" src="{{ asset('storage/' . $apartment->image) }}"
                                alt="{{ $apartment->title }}"></td>
                        <td>{{ $apartment->title }}</td>
                        <td>{{ Str::limit($apartment->description, 150, '...') }}</td>
                        <td>{{ $apartment->address }}</td>
                        <td>{{ $apartment->visible ? 'YES' : 'NO' }}</td>

                        <td class="text-center d-flex flex-column">
                            <a href="{{ route('admin.stats', $apartment->id) }}">stats</a>
                            <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-primary">
                                <i class="fas fa-eye fa-sm fa-fw"></i>
                            </a>
                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-secondary my-1">
                                <i class="fas fa-pencil-alt fa-sm fa-fw"></i>
                            </a>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#apartment-{{ $apartment->id }}">
                                <i class="fas fa-trash fa-sm fa-fw"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="apartment-{{ $apartment->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="apartment-{{ $apartment->title }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete apartment {{ $apartment->title }}</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the apartment?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif


@endsection
