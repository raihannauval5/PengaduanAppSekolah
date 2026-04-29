<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - PengaduanAppSekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; max-width: 400px; }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">PengaduanApp</h3>
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                @if($errors->any())
                    <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>