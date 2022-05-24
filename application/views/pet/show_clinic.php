<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url()?>/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  <style>
        .mh-100{
            height: 180vh;
        }
    </style>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        $clinic = $data;
        $_SESSION['clinicid'] = $clinic['id']; 
        extract($clinic); extract($_SESSION['user']); extract($_SESSION['picture']); ?>

    <div class="container-fluid">
    <div class="row">
            <div class="col-lg-3">
            <div class="mh-100 text-start">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light h-100" style="width: 280px;">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <img src="<?= base_url() ?>/images/logo.png" alt="" class="img-fluid">
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?= base_url()?>pets/login" class="nav-link link-dark" aria-current="page">
                            <i class="fa-solid fa-house pe-2"></i>Home
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-dark">
                            <i class="fa-solid fa-paw pe-2"></i>Pet History
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>pets/show_orders" class="nav-link link-dark">
                            <i class="fa-solid fa-cart-shopping pe-2"></i>Orders
                        </a>
                    </li>
                    <li class="nav-item">
                            <a href="<?= base_url() ?>pets/items" class="nav-link link-dark" aria-current="page">
                                <i class="fa-solid fa-house pe-2"></i>Items
                            </a>
                        </li>
                    <li>
                        <a href="<?= base_url() ?>pets/your_clinic" class="nav-link link-dark">
                            <i class="fa-solid fa-house-chimney-medical pe-2"></i>Your Clinics
                        </a>
                    </li>
                    <li>
                        <a href="pet" class="nav-link link-dark">
                            <i class="fa-solid fa-otter pe-2"></i>Pets
                        </a>
                    </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if($profile == NULL){ ?>
                                <img src="<?php base_url()?>/images/logo_registration.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <?php   } else { ?>
                                <img src="<?php base_url()?>/images/<?= $email ?>/profile/<?= $profile->image_name?>" alt="" width="32" height="32" class="rounded-circle me-2">
                        <?php   } ?>
                            <strong><?= $first_name; ?></strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="profile">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-lg-9">

                <div class="container-fluid text-start">
                    <!-- <h1>Basic Information</h1> -->
                    <h1 class="text-center py-5"><?= $clinic_name; ?> </h1>
                    <?= $this->session->flashdata('appointment'); ?>
                    <h6>Opens in <?= $schedule?></h6>
                    <h6><?= date_format(date_create($monday_opening), 'h:i A')?>-<?= date_format(date_create($monday_closing), 'h:i A') ?>, <?= date_format(date_create($tuesday_opening), 'h:i A')?>-<?= date_format(date_create($tuesday_closing), 'h:i A') ?>, <?= date_format(date_create($wednesday_opening), 'h:i A')?>-<?= date_format(date_create($wednesday_closing), 'h:i A') ?>, <?= date_format(date_create($thursday_opening), 'h:i A')?>-<?= date_format(date_create($thursday_closing), 'h:i A') ?>, <?= date_format(date_create($friday_opening), 'h:i A')?>-<?= date_format(date_create($friday_closing), 'h:i A') ?>, <?= date_format(date_create($saturday_opening), 'h:i A')?>-<?= date_format(date_create($saturday_closing), 'h:i A') ?>, <?= date_format(date_create($sunday_opening), 'h:i A')?>-<?= date_format(date_create($sunday_closing), 'h:i A') ?></h6>
                    <form action="<?= base_url() ?>petshits/set_appointment/<?= $clinic['id'] ?>" method="POST">
                        <label for="date" class="form-label">Set an appointment</label>
                        <input type="date" name="date" id="date" min="<?= date("Y-m-d") ?>" class="form-control">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" name="time" id="time" class="form-control" required>
                        <input type="hidden" name="name_of_pet_user" value="<?= $_SESSION['user']['first_name']. ' '. $_SESSION['user']['last_name'] ?>" id="time" class="form-control" required>
                        <label for="pets" class="form-label">Select a pet to come with you..</label>
                        <select name="pets" id="" class="form-select">
                            <?php foreach ($pets as $key => $value) { ?>
                                <option value="<?= $value['name'] ?>"><?= $value['name'] ?></option>
                                
                            <?php  } ?> <?php if ($value['id'] == NULL) { ?>
                                
                            <?php }else{ ?>
                                <input type="hidden" name="pet_id" value="<?= $value['id'] ?>">
                            <?php } ?>
                        </select>
                        <div class="form-floating mt-2">
                            <textarea class="form-control" name="note" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Leave a note(optional)</label>
                        </div>
                        <input type="submit" value="Set Appointment" class="btn btn-success mt-3">
                    </form>
                    <h4 class="py-2"><?= $clinic_name ?> offers these services</h4>
                    <table id="bitchass" class="table table-bordered mt-5">
                        <thead>
                            <tr>
                            <th>Service</th>
                            <th>Duration</th>
                            <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php foreach ($services as $key => $value) { ?>
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
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <h4 class="py-2"><?= $clinic_name ?> offers these products</h4>
                    <table id="bitchassmotherfucker" class="table table-bordered mt-5">
                        <thead>
                            <tr>
                            <th>Product Name</th>
                            <th>Brand Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php foreach ($products as $key => $value) { ?>
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
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $value['id'] ?>">Add to Cart</button></td>
                            </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?= $value['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add <?= $value['product_name'] ?> to cart</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url() ?>petshits/add_to_cart/<?= $value['id'] ?>" method="POST">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="quantity" class="form-label">Quantity</label>
                                                            <input type="number" name="ordered_quantity" onchange="calcPrice(<?= $value['id'] ?>)" required min='1' max='<?= $value['quantity'] ?>' class="form-control" id="quantity<?= $value['id'] ?>">
                                                        </div>
                                                        <div class="col">
                                                            <label for="price" class="form-label">Price</label>
                                                            <input type="text"  class="form-control" id="price<?= $value['id'] ?>" value="<?= $value['price'] ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="form-control" id="oldprice<?= $value['id'] ?>" value="<?= $value['price'] ?>">
                                                    <input type="hidden" name="sub_total_price" class="form-control" id="hiddenquantity<?= $value['id'] ?>" value="<?= $value['price'] ?>">
                                                    <input type="hidden" name="clinic_id" class="form-control" id="hiddenquantity<?= $value['id'] ?>" value="<?= $_SESSION['clinicid'] ?>">
                                                    <input type="hidden" name="product_name" class="form-control" id="hiddenquantity<?= $value['id'] ?>" value="<?= $value['product_name'] ?>">
                                                    <input type="hidden" name="quantity" class="form-control" id="hiddenquantity<?= $value['id'] ?>" max='<?= $value['quantity'] ?>' value="<?= $value['quantity'] ?>">
                                                    <input type="hidden" name="image" class="form-control" id="hiddenquantity<?= $value['id'] ?>" value="<?= $value['image'] ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" value="Add to Cart">
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
    
    <script>
        var date_input = document.getElementById('date');
        date_input.valueAsDate = new Date();

        date_input.onchange = function(){
            console.log(this.value);
            $.ajax({
                url: '<?= base_url() ?>petshits/data',
                dataType: 'json',
                data: {date_input:date_input},
                success: function(data) {
                    console.log(data);
                }
            });
        }
        $("#datepicker").datepicker({
        beforeShowDay: noPasok
        });

    function noPasok(date){
        console.log('<?= $schedule ?>');
    }

    </script>
<script>
   $(document).ready( function () {

    $('#bitchassmotherfucker').DataTable();
    $('#bitchass').DataTable();
    });

    function calcPrice(id){
        $('#price'+id).val();
        var oldprice = $('#oldprice'+id).val();
        var quantity = parseInt($('#quantity'+id).val());
        var value = parseInt(oldprice) * quantity;
        $('#price'+id).val(value);
        $('#hiddenquantity'+id).val(value);
    }
</script>

</body>
</html>