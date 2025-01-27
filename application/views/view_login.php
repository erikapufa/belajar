<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
    <link href="<?php echo base_url('public/template/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>

<body>
    <div class="row justify-content-center">
        <div class="card col-md-8 mt-5">
            <div class="card-header">
                <h1>Sign In</h1>
            </div>
            <div class="card-body">
                <div class="form-login">
                    <form id="form_login" action="<?php echo base_url('login/proses_login'); ?>" method="post">
                        <div class="mb-1">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <div class="error-block text-danger"></div>
                        </div>
                        <div class="mb-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="error-block text-danger"></div>
                        </div>

                        <button type="button" id="loginBtn" class="btn btn-success mt-3">Login</button>
                    </form>
                    <div>
                    </div>
                    <div class="login-error mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('public/template/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/template/js/jquery-3.7.1.min.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#loginBtn').click(function() {
                let formdata = new FormData($("#form_login")[0]);
                $('.error-block').html(''); // Clear previous error messages
                $('input').removeClass('is-invalid'); // Remove invalid class

                $.ajax({
                    url: '<?php echo base_url('login/proses_login'); ?>',
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            // Redirect to admin page if login is successful
                            window.location.href = '<?php echo base_url('admin'); ?>';
                        } else {
                            if (response.error) {
                                // Display field-specific validation errors
                                for (let prop in response.error) {
                                    if (response.error[prop]) {
                                        $(`#form_login [name=${prop}]`).addClass('is-invalid')
                                            .next('.error-block').html(response.error[prop]);
                                    }
                                }
                            } else {
                                // Display general error message
                                $('.login-error').html(response.message).addClass('alert alert-danger');
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>