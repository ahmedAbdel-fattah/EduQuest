@extends('admin.layouts.dash')
@section('content')

<div class="content-header">
    <h1>Contact Messages</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->message }}</td>
                    <td>
                        @if($contact->is_handled)
                            <span class="badge badge-success">Handled</span>
                        @else
                            <span class="badge badge-danger">Not Handled</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('contacts.updateStatus', $contact->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning">
                                {{ $contact->is_handled ? 'Mark as Not Handled' : 'Mark as Handled' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
