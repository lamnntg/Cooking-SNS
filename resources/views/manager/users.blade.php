@extends('manager.index')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container mt-3">
            <h3>Users</h3>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Username</th>
                                <th class="border-top-0">Role</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    @if ($user->is_admin)
                                        <td>Admin</td>
                                    @else
                                        <td>Normal</td>
                                    @endif
                                    @if ($user->status != 1)
                                        <td style="color: red;">Blocked</td>
                                    @else
                                        <td style="color: green;">Active</td>
                                    @endif
                                    <td>
                                        <a href={{ route('manager.block_user', ['id' => $user->id]) }} class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-ban"></i>
                                            Block
                                        </a>
                                        <a href={{ route('manager.delete_user', ['id' => $user->id]) }} class="btn btn-sm btn-outline-secondary">
                                            <i style="color: red;" class="fas fa-minus-circle"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
