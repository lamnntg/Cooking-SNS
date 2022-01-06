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
                                            <a class="btn btn-sm btn-outline-secondary" style="width: 100px;"
                                                data-bs-toggle="modal" data-bs-target="#modal-user-delete-{{ $user->id }}">
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
                                            <a class="btn btn-sm btn-outline-secondary" style="width: 100px;"
                                                data-bs-toggle="modal" data-bs-target="#modal-user-delete-{{ $user->id }}">
                                                <i style="color: red;" class="fas fa-minus-circle"></i>
                                                削除
                                            </a>
                                        </td>
                                    @endif

                                {{-- user-delete-modal --}}
                                    <div id="modal-user-delete-{{ $user->id }}" class="modal fade" tabindex="-1"
                                        role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title fw-bold">削除確認</h6>
                                                    <button type="button" class="btn close ms-auto" data-bs-dismiss="modal"
                                                        aria-label="閉じる">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST"
                                                    action="{{ route('manager.delete_user', ['id' => $user->id]) }}">
                                                    @csrf
                                                    @method('GET')
                                                    <div class="modal-body">
                                                        {{ $user->name }}を削除します。よろしいですか？
                                                    </div>
                                                    <div class="modal-footer flex-end">
                                                        <a class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">キャンセル</a>
                                                        <button type="submit" class="btn btn-danger">削除する</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                {{-- user-delete-modal --}}
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
@endsection
