@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>MailBnB</h1>
        @if ($messages->isEmpty())

            <h2>Nothing to display</h2>

        @else
            <table class="table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>From</th>
                        <th>Email</th>
                        <th>Object</th>
                        <th>Message</th>
                        <th>Send at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ $message->name }} {{ $message->lastname }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->title }}</td>
                            <td>{{ Str::limit($message->body, 150, '...') }}</td>
                            <td>{{ $message->created_at }}</td>

                            <td class="text-center d-flex flex-column">
                                <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-primary mb-2">
                                    <i class="fas fa-envelope-open-text"></i>
                                </a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#message-{{ $message->id }}">
                                    <i class="fas fa-trash fa-sm fa-fw"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="message-{{ $message->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="message-{{ $message->email }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete message from {{ $message->email }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the message?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>

                                                <form action="{{ route('admin.messages.destroy', $message->id) }}"
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
    </div>
@endsection
