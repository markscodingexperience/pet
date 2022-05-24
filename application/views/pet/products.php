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
                            <a class="nav-link " href="<?= base_url() ?>petshits/services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>petshits/employees">Employees</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url() ?>petshits/products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>petshits/dashboard2">Dashboard</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <button class="btn btn-success mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Add your Products Here</button>
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
            <div class="row table-responsive">
            <!-- <input id="myInput" type="text" placeholder="Search.." class="form-control mt-5" style="width: 35%"> -->
            <?= $this->session->flashdata('clinic_success'); ?>
            <!-- <?php extract($services); ?> -->
            <table class="table table-hover table-bordered  mt-5" id="bitchassmotherfucker">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Description</th>
                        <th scope="col" style="width:210px">Actions</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <?php extract($_SESSION['user']);
                            foreach($services as $key => $value) { ?>
                                <td><?= $value['product_name'] ?></td>
                                <td><?= $value['brand']  ?></td>
                                <td style="height:120px;width:120px"> <?php if ($value['image'] == NULL || $value['image'] == '') { ?>
                                        <img src="<?= base_url(); ?>/images/dog.jpg" style="width: 100px;" class="img-fluid img-thumbnail" alt="Product Image">
                                    <?php }else { ?>
                                        <img src="<?= base_url(); ?>/images/<?= $value['image'] ?>" class="img-fluid img-thumbnail" style="width: 100px;" alt="Product Image">
                                        
                                    <?php }?> </td>
                                <td><?= $value['price'] ?></td>
                                <td><?= $value['quantity'] ?></td>
                                <td><?= $value['description'] ?></td>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?= $value['id'] ?>">Edit</button><button type="button" class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#uploadModal<?= $value['id'] ?>">Upload Picture</button></td>
                            </tr>
                            <!-- upload picture for products modal -->
                            <div class="modal fade" id="uploadModal<?= $value['id'] ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Upload Picture for <?= $value['product_name'] ?></h5>
                                        </div>
                                        <form enctype="multipart/form-data" action="<?= base_url() ?>petshits/uploadPicofProduct/<?= $value['id'] ?>" method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label for="image" class="form-label">Upload Picture: </label>
                                                            <input type="file" required accept="image/*" name="image" id="image" oninput="frame.src=window.URL.createObjectURL(this.files[0])" class="form-control">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label for="gender" class="form-label">Photo: </label>
                                                            <img id="frame" src="" class="img-fluid" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" value="Save">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- edit modal -->
                            <div class="modal fade" id="editModal<?= $value['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit <?= $value['product_name'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url() ?>petshits/update_products/<?= $value['id'] ?>" method="post">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $value['product_name'] ?>" placeholder="name of your pet" required>
                                                        <label for="product_name" class="form-label">Product Name</label>
                                                    </div>

                                                </div>
                                                <div class="col-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="service" name="brand" value="<?= $value['brand'] ?>" placeholder="name of your pet" required>
                                                        <label for="brand" class="form-label">Brand</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="price" class="form-label">Price</label>
                                                    <input type="number" name="price" value="<?= $value['price'] ?>" class="form-control" min="1">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input type="number" name="quantity" value="<?= $value['quantity'] ?>"  class="form-control" min="1">
                                                </div>
                                            </div> 
                                            <label for="price" class="form-label">Description: </label>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea> 
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
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>petshits/add_products" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Name of Product" required>
                                <label for="product_name" class="form-label">Name of Product</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand name" required>
                                <label for="brand" class="form-label">Brand</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" min="1">
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" name="quantity" value="0" class="form-control" min="0">
                        </div>
                    </div>
                    <label for="price" class="form-label">Description: </label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" value="Add Product">
                </form>
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