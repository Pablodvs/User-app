@extends('layouts.app')

@php($user = Auth::user()) {{-- Confirmation message--}}

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit user') }}</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @if (isset(session('modifiedFields')['name']))
                                <p>Name changed to: {{ session('modifiedFields')['name'] }}</p>
                            @endif
                            @if (isset(session('modifiedFields')['username']))
                                <p>User name changed to: {{ session('modifiedFields')['username'] }}</p>
                            @endif
                            @if (isset(session('modifiedFields')['email']))
                                <p>Email changed to: {{ session('modifiedFields')['email'] }}</p>
                            @endif
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form class="update-form" action="{{ route('update_user', $user->id )}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="username">User name:</label>
                                <input type="text" name="username" id="username" value="{{ $user->username }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn mt-2 btn-primary">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Confirmation message--}}
    <script>
        $('.update-form').submit(function (e){
            e.preventDefault()
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                   this.submit()
                }
            })
        })
    </script>
    @endsection


