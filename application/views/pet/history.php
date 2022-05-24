<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Pets</title>
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
                    <a class="nav-link" aria-current="page" href="<?= base_url() ?>petshits/frontdesk">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>petshits/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url() ?>petshits/history">Assigned Pets</a>
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
    <div class="row justify-content-center">
        <div class="container">
            <?= $this->session->flashdata('medical'); ?>
            <table class="table">
                <thead>
                    <tr>
                        <td>Client Name</td>
                        <td>Pet</td>
                        <td>Appointment Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            foreach ($appointments as $key => $value) { ?>
                                <td><?= $value['name'] ?></td>
                                <td><?= $value['pet'] ?></td>
                                <td><?= $value['date'] ?></td>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $value['pet_id'] ?>">Submit Medical History</button></td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $value['pet_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <form action="<?= base_url() ?>petshits/medical/<?= $value['pet_id'] ?>" method="post">
                                            <h5 class="modal-title" id="exampleModalLabel">What happened to <?= $value['pet'] ?>?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Comments</label>
                                                <input type="text" class="form-control" name="comments" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-success" value="Submit">
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                </tbody>
            </table>
        </div>
            
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