<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Vets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- JavaScript Bundle with Popper -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    
    <!-- Link Full Calendar  -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <!--  -->
</head>
<body>
    <div class="container-fluid">
<?php extract($_SESSION['user']); extract($clinic);?>

  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href=""><img class="img-fluid" src="<?= base_url() ?>images/<?= $image ?>" alt="" width="70" height="70"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>petshits/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>petshits/history">Assigned Pets</a>
                </li>
            </ul>
            <ul class="navbar-nav">
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
<div class="section ms-3 mt-2">
    <center><img src="<?= base_url() ?>images/<?= $image ?>" class="img-fluid my-3 text-center" style="width: 100px" alt=""></center>
    <h1 style="font-family: sans-serif;" class="text-center"><?= $clinic_name ?></h1>
    <h6 class="text-center"><?= $unit_number.' '.$street .' '. $municipality .' '. $city .', '.$country ?></h6>
    <p class="text-center">Opens on <?= $schedule ?></p>
    <p class="text-center">Opens on <?= date_format(date_create($monday_opening), 'h:i A')?>-<?= date_format(date_create($monday_closing), 'h:i A') ?>, <?= date_format(date_create($tuesday_opening), 'h:i A')?>-<?= date_format(date_create($tuesday_closing), 'h:i A') ?>, <?= date_format(date_create($wednesday_opening), 'h:i A')?>-<?= date_format(date_create($wednesday_closing), 'h:i A') ?>, <?= date_format(date_create($thursday_opening), 'h:i A')?>-<?= date_format(date_create($thursday_closing), 'h:i A') ?>, <?= date_format(date_create($friday_opening), 'h:i A')?>-<?= date_format(date_create($friday_closing), 'h:i A') ?>,</p>
    <div class="row">
        <div id="calendar"></div>
            <h4>Services Offered</h4>
            <table class="table table-hover table-bordered" style="margin-top:70px;" id="service">
                <thead>
                    <tr>
                    <th>Service</th>
                    <th>Duration</th>
                    <th>Price</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr><?php foreach($services as $key => $value) { ?>
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
                    </tr><?php } ?>
                </tbody>
            </table>
        
        <div class="container">
            </div>
            <h4>Products Offered</h4>
            <table class="table table-hover table-bordered" style="margin-top:70px;" id="product">
                <thead>
                    <tr>
                    <th>Product Name</th>
                    <th>Brand Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr><?php foreach($products as $key => $value) { ?>
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
                    </tr><?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      initialDate: '<?= date("Y-m-d")?>',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: [
          <?php foreach ($appointments as $key => $value) { ?>
            {
                title: 'Appointment with <?= $value['name'] ?> and Pet <?= $value['pet'] ?>',
                start: '<?= $value['date'] ?>T<?= $value['time'] ?>',
                end: '<?= $value['date'] ?>',
            },
            <?php } ?>
      ]
    });

    calendar.render();
  });


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