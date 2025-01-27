<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url('public/template/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
    <div class="row justify-content-center">
        <div class="card col-md-8 mt-5 ">
            <div class="card-header">
                <h1 class="text-center">Halaman Dashboard</h1>
            </div>
            <div class="card-body">
                <?php if ($this->session->flashdata('notification')): ?>
                    <div class="alert alert-info"><?= $this->session->flashdata('notification'); ?></div>
                <?php endif; ?>

                <div class="container mt-2 mb-2">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addUserForm">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                        <div class="error-block text-danger"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        <div class="error-block text-danger"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="saveBtn" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="">
                    <a href="<?= base_url('dashboard/add'); ?>" class="btn btn-success">Add User</a>
                </div> -->

                <div class="table-user">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <?php
                            $no = 1;
                            foreach ($users as $user) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $user->username ?></td>
                                    <td><?= $user->password ?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateUserModal">
                                            Update User
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?php echo base_url('dashboard/update_user'); ?>" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="password" class="form-label">Password</label>
                                                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $user->password; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <a href="<?= base_url('dashboard/edit/' . $user->id); ?>" class="btn btn-success">Edit</a> -->

                                        <a href="<?= base_url('dashboard/delete/' . $user->id); ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('public/template/js/jquery-3.7.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/template/js/bootstrap.bundle.min.js'); ?>"></script>

    <script>
        // AJAX untuk menambahkan user tanpa me-refresh halaman
        $(document).ready(function() {
            $('#form_add_user').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '<?= base_url('dashboard/ajax_save') ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            alert(response.message);

                            // Menambahkan user baru ke tabel tanpa refresh halaman
                            const newRow = `
                        <tr>
                            <td>${response.no}</td>
                            <td>${response.username}</td>
                            <td>${response.password}</td>
                            <td>
                                <a href="<?= base_url('dashboard/edit/'); ?>${response.id}" class="btn btn-primary">Edit</a>
                                <a href="<?= base_url('dashboard/delete/'); ?>${response.id}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>`;

                            $('#userTableBody').append(newRow);
                            $('#addUserModal').modal('hide');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan ketika menyimpan data');
                    }
                });
            });
            // Handle save button click event
            $('#saveBtn').click(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '<?= base_url('dashboard/ajax_save') ?>',
                    type: 'POST',
                    data: {
                        username: $('#username').val(),
                        password: $('#password').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                        if (response.status) {
                            // Redirect to the dashboard after successful save
                            location.href = '<?= base_url('dashboard') ?>';
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan ketika menyimpan data');
                    }
                });
            });
        });
    </script>
</body>

</html>