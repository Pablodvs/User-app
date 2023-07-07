@extends('layouts.app')

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

        /* Styles for the paragraph */
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

    </style>

    <div class="containerM">
        <div class="inner-box">
            <h1 class="title">Welcome!</h1>
            <p class="subtitle">Please choose an option:</p>
            <a href="{{ route('login') }}" class="btn btn-primary my-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary my-2">Register</a>
        </div>
    </div>
@endsection


