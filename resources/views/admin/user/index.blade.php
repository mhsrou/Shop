@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @forelse($users as $user)
                    @if ($user->deleted_at)
                    <div class="card mb-4 alert alert-danger my-2 border -danger">
                        <div class="card-body">
                            <div class="small text-muted">{{ $user->phone }}</div>
                            <h2 class="card-title">{{ $user->email }}</h2>
                            <p class="card-text">{{ Str::limit($user->name, 20) }}</p>
                            @if(!$user->is_admin)
                                <form style="display:inline" method="post" action="{{ route('admin.user.forceDelete', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                                </form>

                                <form style="display:inline" method="post" action="{{ route('admin.user.restore', $user) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-success" type="submit">Activate</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @else
                        <div class="card mb-4 my-2 border border -black">
                            <div class="card-body">
                                <div class="small text-muted">{{ $user->phone }}</div>
                                <h2 class="card-title">{{ $user->email }}</h2>
                                <p class="card-text">{{ Str::limit($user->name, 20) }}</p>
                                @if(!$user->is_admin)
                                    <form id="delete-frm" onclick="return confirm('Deactivate user?')"
                                          action=" {{ route('admin.user.destroy', $user) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">Deactivate</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Nothing here</h4>
                    </div>
                @endforelse
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>
            </div>
        </div>
    </div>
@endsection
