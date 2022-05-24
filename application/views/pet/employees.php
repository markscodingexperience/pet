<?php extract($clinic); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees of <?= $name ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>js/html-table-search.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href=""><img class="img-fluid" src="<?= base_url() ?>images/logo_registration.png" alt="" width="70" height="70"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?= base_url() ?>pets/login">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= base_url() ?>petshits/services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url() ?>petshits/employees">Employees</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= base_url() ?>petshits/products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>petshits/dashboard2">Dashboard</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <button class="btn btn-success mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Add your Employees Here</button>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Menu </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?= base_url() ?>pets/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row ">
                <?= $this->session->flashdata('clinic_success') ?>
            <!-- <input id="myInput" type="text" placeholder="Search.." class="form-control mt-5" style="width: 35%"> -->
            <!-- <?php extract($services); ?> -->
            <table class="table table-hover table-bordered mt-5" id="bitchassmotherfucker">
                <thead>
                    <tr>
                    <th>Employee Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <?php extract($_SESSION['user']);
                            foreach($employee as $key => $value) { ?>
                                <td><?= $value['name'] ?></td>
                                <td><?php if ($value['role'] == '3') { ?>
                                    Vet Receptionist </td>
                                <?php }else if($value['role'] == '4'){ ?>
                                    Vet Technician     </td>
                                <?php } else{ ?>
                                    Vet Surgeon  </td>
                                <?php } ?>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id'] ?>">Edit</button></td>
                            </tr>
                            <!-- edit modal employee -->
                            <div class="modal fade" id="editModal<?= $value['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit <?= $value['name'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url() ?>petshits/update_employees/<?= $value['id'] ?>" method="post">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="name" name="name" value="<?= $value['name'] ?>" placeholder="name of your pet" disabled>
                                                <label for="product_name" class="form-label">Employee Name</label>
                                            </div>  
                                            <div class="mb-3">
                                                <label class="form-label">Select Role</label>
                                                <select class="form-select" name="role_employee">
                                                    <option value="3">Vet Receptionist</option>
                                                    <option value="4">Vet Technician</option>
                                                    <option value="5">Vet Surgeon</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="email" value="<?= $value['email'] ?>" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-success" value="Save">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

<!-- Modal for addming employees-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>petshits/add_employees" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="first_name" name="first_name_employee" placeholder="Name of Employee" required>
                            <label for="first_name" class="form-label">First Name of Employee</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="last_name" name="last_name_employee" placeholder="Name of Employee" required>
                            <label for="last_name" class="form-label">Last Name of Employee</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Select Role</label>
                    <select class="form-select" name="role_employee">
                        <option value="3">Vet Receptionist</option>
                        <option value="4">Vet Technician</option>
                        <option value="5">Vet Surgeon</option>
                    </select>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email_employee" name="email_employee" placeholder="Email" required>
                    <label for="email_employee" class="form-label">Email of Employee</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" type="password" name="password_employee" placeholder="user"/>
                    <label for="username" class="form-label">Password</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" value="Add Employee">
            </form>
        </div>
    </div>
</div>
</div>
        </div>
    </div>
        </div>
  </div>
</div>
<script>
$(document).ready( function () {
    $('#bitchassmotherfucker').DataTable();
} );

//    $(document).ready(function(){
//   $("#myInput").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#myTable tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// });
</script>

<script>
        function preview(){
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
        function clearImage() {
                document.getElementById('image').value = null;
                frame.src = "";
            }
            $("#clear").click(function(){
                $("#frame").hide();
            });
            // image.onchange = evt => {
        //     const [file] = image.files
        //     if (file) {
        //         frame.src = URL.createObjectURL(file)
        //     }
        // }
    </script>
</body>
</html>