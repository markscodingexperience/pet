<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>

        #id{
            background-size:cover;
        }

    </style>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        .mh-100{
            height: 100vh;
        }
        .card {
            border-style: none;
        }
            .card-title{
                overflow: hidden;
                display: inline-block;
                text-overflow: ellipsis;
                white-space: nowrap;
                width:170px; //change based on when you want the dots to appear
            }
            .hover{
                overflow: hidden;
            }
            .hover img{
                transition: transform .5s ease;
            }
            .hover:hover img{
                transform: scale(1.135);
            }
    </style>
</head>
<body>
    <?php 
        // $user = $this->session->userdata('user');
        $_SESSION['user'] = $this->session->userdata('user');
        extract($_SESSION['user']);
        $_SESSION['picture'] = $this->session->userdata('picture');
        extract($_SESSION['picture']);
        echo $this->session->flashdata('email_sent');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="mh-100">
                    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light h-100" style="width: 280px;">
                        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <img src="<?= base_url() ?>/images/logo.png" alt="" class="img-fluid">
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="<?= base_url()?>pets/login" class="nav-link active" aria-current="page">
                                <i class="fa-solid fa-house pe-2"></i>Home
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url()?>pets/pet_history" class="nav-link link-dark">
                                <i class="fa-solid fa-paw pe-2"></i>Pet History
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>pets/show_orders" class="nav-link link-dark">
                                <i class="fa-solid fa-cart-shopping pe-2"></i>Orders
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>pets/items" class="nav-link link-dark">
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
            <?php               } else { ?>
                                    <img src="<?php base_url()?>/images/<?= $email ?>/profile/<?= $profile->image_name?>" alt="" width="32" height="32" class="rounded-circle me-2">
            <?php               } ?>
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
            <div class="col-lg-9 py-5">
                <h1 class="pb-3">Clinics you might want to check</h1>
                <button class="btn btn-primary" id = "find-me">Update my location</button><br/>
                <p id = "status"></p>
                <a id = "map-link" target="_blank"></a>

                <div class="row row-cols-6 row-cols-md-3 g-4">
                    <!-- FOREACH IS HERE FOR CLINICS DISPLAY -->
                    <?php foreach ($clinics as $key => $value) { ?>
                        <div class="col px-0" id="container">
                            <div class="card mb-3 pe-0 mx-0" id="card<?= $value['id'] ?>" style="max-width: 18rem;">
                                <a href="get/<?= $value['id']; ?>">
                                    <div class="hover" id="hover">
                                        <?php 
                                            if ($value['image'] == '') { ?>
                                                <img src="<?= base_url() ?>images/dog.jpg ?>" class="card-img-top img-fluid" alt="...">           
                                        <?php    } else{ ?>
                                            <img src="<?= base_url() ?>images/<?= $value['image'] ?>" class="card-img-top img-fluid" alt="...">
                                        <?php }
                                        ?>
                                    </div>
                                    <div>
                                        <h5 class="card-title pt-2 mb-0 pb-0"><?= $value['clinic_name'] ?></h5>
                                        <!-- <span class="float-end text-primary pt-2"><i class="fa-solid fa-star"></i>3/5</span> -->
                                        <!-- <ul class="list-inline">
                                            <li class="list-inline-item"><small class="text-muted my-0">dog</small></li>
                                            <li class="list-inline-item"><small class="text-muted my-0">cats</small></li>
                                            <li class="list-inline-item"><small class="text-muted my-0">services</small></li>
                                        </ul> -->
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php    } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function geoFindMe() {

const status = document.querySelector('#status');
const mapLink = document.querySelector('#map-link');

mapLink.href = '';
mapLink.textContent = '';

function success(position) {
  const latitude  = position.coords.latitude;
  const longitude = position.coords.longitude;

  status.textContent = '';
//   mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
  mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
  var settings = {
  "async": true,
  "crossDomain": true,
  "url": "https://us1.locationiq.com/v1/reverse.php?key=pk.833e1ba38dc446a34e12d6a1979598d0&lat="+ latitude +"&lon="+ longitude +"&format=json",
  "method": "GET"
}

$.ajax(settings).done(function (response) {
  console.log(response['address']['city']);
  jQuery.ajax({
    type: "POST",
    url: '<?= base_url().'pets/location' ?>',
    dataType: 'json',
    data: {city: response['address']['city']},

    // success: function (obj, textstatus) {
    //               if( !('error' in obj) ) {
    //                   yourVariable = obj.result;
    //               }
    //               else {
    //                   console.log(obj.error);
    //               }
    //         }
    success: function(data){
        console.log(data);
        for (let index = 0; index < data.data.length; index++) {
            var card = document.createElement("div");
            card.className = "card";
            var link = document.createElement("a");
            var img = document.createElement("img");
            <?php foreach ($clinics as $key => $value) { ?>
                var div = document.getElementById("card<?= $value['id'] ?>");
                link.href = "get/<?= $value['id'] ?>";
                <?php  if ($value['image'] == '') { ?>
                    img.src = "<?= base_url() ?>images/dog.jpg ?>";     
                    img.className = "card-img-top img-fluid";
                <?php    } else{ ?>
                    img.src = "<?= base_url() ?>images/<?= $value['image'] ?>";
                    img.className = "card-img-top img-fluid";
                <?php } ?>
                div.style.display = "none";
                card.appendChild(link);
                link.appendChild(hover);
                hover = document.getElementById("hover");
                hover.appendChild(img);
                bendover = document.getElementById("container");
                bendover.appendChild(card);
                <?php } ?>
            
        }
    }
});

});


}

function error() {
  status.textContent = 'Unable to retrieve your location';
}

if(!navigator.geolocation) {
  status.textContent = 'Geolocation is not supported by your browser';
} else {
  status.textContent = 'Locating…';
  navigator.geolocation.getCurrentPosition(success, error);
}

}

document.querySelector('#find-me').addEventListener('click', geoFindMe);

    </script>
</body>
</html>