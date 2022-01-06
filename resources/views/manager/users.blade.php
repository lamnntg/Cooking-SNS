@extends('manager.index')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container mt-3">

            <h3>ユーザー</h3>
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">ユーザーネーム</th>
                                <th class="border-top-0">役割</th>
                                <th class="border-top-0">ステータス</th>
                                <th class="border-top-0">アクション</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    @if ($user->is_admin)
                                        <td>管理者</td>
                                    @else
                                        <td>ユーザー</td>
                                    @endif
                                    @if ($user->status != 1)
                                        <td style="color: red;">ブロックされた</td>
                                        <td>
                                            <a href={{ route('manager.block_user', ['id' => $user->id]) }}
                                                class="btn btn-sm btn-outline-success" style="width: 100px;">
                                                <i class="fas fa-lock-open"></i>
                                                アクティブ
                                            </a>
                                            <a href={{ route('manager.delete_user', ['id' => $user->id]) }}
                                                class="btn btn-sm btn-outline-secondary" style="width: 100px;">
                                                <i style="color: red;" class="fas fa-minus-circle"></i>
                                                削除
                                            </a>
                                        </td>
                                    @else
                                        <td style="color: green;">アクティブ</td>
                                        <td>
                                            <a href={{ route('manager.block_user', ['id' => $user->id]) }}
                                                class="btn btn-sm btn-outline-secondary" style="width: 100px;">
                                                <i class="fas fa-lock"></i>
                                                ブロック
                                            </a>
                                            <a href={{ route('manager.delete_user', ['id' => $user->id]) }}
                                                class="btn btn-sm btn-outline-secondary" style="width: 100px;">
                                                <i style="color: red;" class="fas fa-minus-circle"></i>
                                                削除
                                            </a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
@endsection
