@extends('layouts.app')
@section('content')
    @if (session('role'))
        <div class="alert alert-success">
            <ul>
                {{ session('role') }}
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @forelse($users as $user)
                    @if ($user->deleted_at)
                        <div class="card mb-4 alert alert-danger my-2 border -danger">
                            <div class="card-body">
                                <div class="small text-muted">{{ $user->phone }}</div>
                                <h2 class="card-title">{{ $user->email }}</h2>
                                <p class="card-text">{{ $user->name }}</p>
                                <form style="display:inline" method="post"
                                    onclick="return confirm('Deactivate user permenantly?')"
                                    action="{{ route('admin.user.forceDelete', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                                </form>

                                <form style="display:inline" method="post"
                                    action="{{ route('admin.user.restore', $user) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-success" type="submit">Activate</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="card mb-4 my-2 border border -black">
                            <div class="card-body">
                                <div class="small text-muted">{{ $user->phone }}</div>
                                <h2 class="card-title">{{ $user->email }}</h2>
                                <p class="card-text">{{ $user->name }}</p>
                                <div class="row">
                                    <form style="display:inline" class="col"
                                        action=" {{ route('admin.user.destroy', $user) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">Deactivate</button>
                                    </form>
                                    <form class="input-group col" action=" {{ route('admin.user.update', $user) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select" name="role">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}" @if ($user->getRoleNames()->first() == $role) selected="selected" @endif>
                                                    {{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary" type="sumbit">Apply</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Nothing here</h4>
                    </div>
                @endforelse
                @foreach ($user->getRoleNames() as $role)
                    {{ $role }}
                @endforeach
                <div class="m-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
