<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services for your Clinic</title>
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
                            <a class="nav-link active" href="<?= base_url() ?>petshits/services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>petshits/employees">Employees</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>petshits/products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>petshits/dashboard2">Dashboard</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <button class="btn btn-success mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Add your Services Here</button>
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
            <!-- <input id="myInput" type="text" placeholder="Search.." class="form-control mt-5" style="width: 35%"> -->
            <?php extract($services); ?>
            <?= $this->session->flashdata('clinic_success'); ?>
            <table class="table table-hover table-bordered pt-5" style="margin-top:70px;" id="bitchassmotherfucker">
                <thead>
                    <tr>
                    <th>Service</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <?php
                            foreach($services as $key => $value) { ?>
                                <td><?= $value['name'] ?></td>
                                <td> <?php if($value['hour'] > 1 && $value['minute'] > 1) { ?>
                                    <?= $value['hour'].' hours '. $value['minute']  ?> minutes</td>
                                <?php }else if($value['hour'] < 2 && $value['minute'] > 1){ ?>
                                    <?= $value['hour'].' hour '. $value['minute']  ?> minutes</td>
                                <?php }else if($value['hour'] > 1 && $value['minute'] < 2){ ?>
                                    <?= $value['hour'].' hours '. $value['minute']  ?> minute</td>
                                <?php }else{ ?>
                                    <?= $value['hour'].' hour '. $value['minute']  ?> minute</td>
                                <?php } ?>   
                                <td><?= $value['price'] ?></td>
                                <td><button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id'] ?>">Edit</button><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $value['id'] ?>">Delete</button></td>

                            </tr>
                            <!-- delete modal -->
                            <div class="modal fade" id="deleteModal<?= $value['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Delete <?= $value['name'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url() ?>petshits/delete_services/<?= $value['id'] ?>" method="post">
                                                <center> <img src="<?= base_url() ?>images/delete_logo.png" class="img-fluid" style="width:100px" alt="Delete Logo"></center>
                                                <center><h4>Are you sure?</h4></center>
                                                <center><h5 class="text-muted">Are you sure to delete this particular service?</h5></center>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go back</button>
                                                <input type="submit" class="btn btn-success" value="Yes, I'm sure">
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- edit modal -->
                            <div class="modal fade" id="editModal<?= $value['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit <?= $value['name'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url() ?>petshits/update_services/<?= $value['id'] ?>" method="post">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="service" name="service" value="<?= $value['name'] ?>" placeholder="name of your pet" required>
                                                <label for="service" class="form-label">Title of Service</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="duration" class="form-label">Duration of Service (Hour)</label>
                                                    <input type="number" name="hour" value="0" class="form-control" min="0">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="duration" class="form-label">Duration of Service (Minutes)</label>
                                                    <input type="number" name="minute" value="0" class="form-control" min="0" max="59">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="price" class="form-label">Price of Service: </label>
                                                    <input type="text" value="<?= $value['price'] ?>" class="form-control" id="price" name="price" placeholder="Ex: 143" required>
                                                </div>
                                            </div>  
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
    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Services</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>petshits/add_services" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="service" name="service" placeholder="name of your pet" required>
                    <label for="service" class="form-label">Title of Service</label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="duration" class="form-label">Duration of Service (Hour)</label>
                        <input type="number" name="hour" class="form-control" min="1">
                    </div>
                    <div class="col-md-6">
                        <label for="duration" class="form-label">Duration of Service (Minutes)</label>
                        <input type="number" name="minute" value="0" class="form-control" min="0" max="59">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="price" class="form-label">Price of Service: </label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Ex: 143" required>
                    </div>
                </div>  
            </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" value="Add Service">
        </form>
      </div>
    </div>
  </div>
</div>
<script>
   $(document).ready( function () {
    $('#bitchassmotherfucker').DataTable();
} );
</script>
</body>
</html>