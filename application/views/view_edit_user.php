<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url('public/template/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <title>Ubah Pengguna</title>
</head>

<body>
    <div class="row justify-content-center">
        <div class="card col-md-8 mt-5 ">
            <div class="card-header">
                <h1>Edit User</h1>
            </div>
            <div class="card-body">
                <div class="form-user">
                    <form action="<?php echo base_url('dashboard/update_user'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $user->id; ?>">

                        <div class="mb-1">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>" />
                            <div class="error-block"></div>
                        </div>

                        <div class="mb-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $user->password; ?>" />
                            <div class="error-block"></div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3 ">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('public/template/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/template/js/jquery-3.7.1.min.js'); ?>"></script>

</body>

</html>
