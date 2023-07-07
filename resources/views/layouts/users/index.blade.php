@extends('layouts.app')
@php($user = Auth::user()) {{-- Confirmation message --}}

@section('content')

    <style>
        /* Styles for the main container */
        .containerM {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F3F4F6;
        }

        /* Styles for the inner box */
        .inner-box {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Styles for the title */
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #374151;
            text-align: center;
            margin-bottom: 16px;
        }

        /* Styles for the subtitle */
        .subtitle {
            font-size: 14px;
            color: #6B7280;
            text-align: center;
            margin-bottom: 32px;
        }

        /* Styles for the buttons */
        .btn {
            display: block;
            width: 100%;
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        /* Styles for the delete form */
        .delete-form {
            display: none;
        }

        /* Styles for the delete form when shown */
        .delete-form.show {
            display: block;
        }
    </style>

    <div class="containerM">
        <div class="inner-box">
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="title">Welcome {{$user->name}}!</h1>
            <p class="subtitle">Please choose an option:</p>
            <a href="{{ route('list_users') }}" class="btn btn-warning my-3">List Users</a>
            <a href="{{ route('edit_users', $user->id) }}" class="btn my-3 btn-dark">Modify user data</a>
            <button id="deleteBtn" class="btn btn-danger">Delete Users</button>
            <form id="deleteForm" action="" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID:</label>
                    <input type="text" class="form-control" id="user_id" name="user_id" required>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <script>
        const deleteBtn = document.getElementById('deleteBtn');
        const deleteForm = document.getElementById('deleteForm');

        deleteBtn.addEventListener('click', () => {
            deleteForm.classList.toggle('show');
        });

        deleteForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente

            const user_id = document.getElementById('user_id').value;

            // Genera la URL con el parámetro id incluido
            const actionUrl = "{{ route('users.destroy', ['id']) }}";
            const updatedActionUrl = actionUrl.replace('id', user_id);

            deleteForm.setAttribute('action', updatedActionUrl);
        });

    </script>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Confirmation message--}}
    <script>
        $('.delete-form').submit(function (e) {
            e.preventDefault()
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit()
                }
            })
        })
    </script>
@endsection
