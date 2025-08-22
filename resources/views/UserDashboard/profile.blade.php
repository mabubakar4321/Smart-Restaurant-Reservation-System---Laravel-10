<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* General Reset */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #eceff1, #f8f9fa);
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        /* Top Bar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn {
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-back {
            background: #e0e0e0;
            color: #333;
        }
        .btn-back:hover { background: #d5d5d5; }

        .btn-logout {
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            color: #fff;
        }
        .btn-logout:hover { opacity: 0.9; }

        /* Card */
        .card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }

        h1 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        p.subtitle {
            color: #666;
            margin-bottom: 22px;
        }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-weight: 500;
        }
        .alert-success { background: rgba(46,204,113,.12); color: #27ae60; }
        .alert-error { background: rgba(231,76,60,.12); color: #c0392b; }

        /* Form */
        form { margin-top: 15px; }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #444;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 15px;
            transition: 0.2s;
        }
        input:focus {
            border-color: #185a9d;
            box-shadow: 0 0 0 3px rgba(24,90,157,0.1);
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-top: 15px;
        }

        .row { margin-top: 18px; }

        .btn-save {
            width: 100%;
            margin-top: 22px;
            background: linear-gradient(90deg,#43cea2,#185a9d);
            color: #fff;
            font-size: 16px;
        }
        .btn-save:hover { opacity: 0.9; }
    </style>
</head>
<body>
<div class="container">

    <!-- Top Bar -->
    <div class="topbar">
        <a href="{{ url()->previous() }}" class="btn btn-back">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <form action="{{ route('logout') }}" method="POST">@csrf
            <button class="btn btn-logout"><i class="fa fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>

    <!-- Profile Card -->
    <div class="card">
        <h1>My Profile</h1>
        <p class="subtitle">Manage your account details and update your password.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0;padding-left:18px">
                    @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="grid">
                <div class="row">
                    <label for="name">Full Name</label>
                    <input id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="row">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
            </div>

            <div class="row">
                <label for="current_password">Current Password <small>(only if changing password)</small></label>
                <input id="current_password" type="password" name="current_password" placeholder="Enter current password">
            </div>

            <div class="grid">
                <div class="row">
                    <label for="password">New Password</label>
                    <input id="password" type="password" name="password" placeholder="Min 8 characters">
                </div>
                <div class="row">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Retype new password">
                </div>
            </div>

            <div class="row">
                <button class="btn btn-save"><i class="fa fa-save"></i> Save Changes</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
