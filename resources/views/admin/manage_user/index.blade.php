@extends('layouts.admin_app')

@section('title', 'Rahat Combined Dashboard')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid my-4">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">

                                <h5 class="card-title mb-0">User List </h5>

                                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">+ Create User</a>
                            </div>

                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>SRNO</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>

                                                <td>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST" style="display:inline-block;"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>

                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No users found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
