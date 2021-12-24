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
                        <tr>
                            <td>1</td>
                            <td>Deshmukh</td>
                            <td>Admin</td>
                            <td style="color: red;">Blocked</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-ban"></i>
                                    Block
                                </button>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i style="color: red;" class="fas fa-minus-circle"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Deshmukh</td>
                            <td>Gaylord</td>
                            <td style="color: green;">Active</td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-ban"></i>
                                    Block
                                </button>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i style="color: red;" class="fas fa-minus-circle"></i>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection