<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid full-height">
        <div class="row full-height">
            <div class="col-lg-8 col-md-10 mx-auto center-vertically-horizontally">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="text-center mb-4">User Registration</h1>
                        <form id="registrationForm">
                            @csrf

                            <div class="form-group">
                                <label for="name" class="mb-0 mt-1"><h5>Name</h5></label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="mb-0 mt-1"><h5>Email</h5></label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password" class="mb-0 mt-1"><h5>Password</h5></label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="mb-0 mt-1"><h5>Confirm Password</h5></label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="button" onclick="registerUser()" class="btn btn-primary btn-block mt-4"><h3>Register</h3></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function registerUser() {
            var formData = new FormData(document.getElementById('registrationForm'));
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('register.submit') }}', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Registration successful, redirect to login page
                    window.location.href = "{{ route('login') }}";
                } else {
                    // Handle error
                    console.error('Error:', xhr.responseText);
                }
            };
            xhr.onerror = function() {
                console.error('Request failed.');
            };
            xhr.send(formData);
        }
    </script>
</body>

</html>
