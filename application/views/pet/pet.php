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
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .mh-100{
            height: 100vh;
        }
    </style>
</head>
<body>
    <?php 
        // $user = $this->session->userdata('user');
        $_SESSION['user'] = $this->session->userdata('user');
        extract($_SESSION['user']);
        $this->session->userdata('picture'); 
        $_SESSION['picture'] = $this->session->userdata('picture');
        extract($_SESSION['picture']);
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
                            <a href="items" class="nav-link link-dark" aria-current="page">
                                <i class="fa-solid fa-house pe-2"></i>Items
                            </a>
                        </li>
                    <li>
                        <a href="<?= base_url() ?>pets/your_clinic" class="nav-link link-dark">
                            <i class="fa-solid fa-house-chimney-medical pe-2"></i>Your Clinics
                        </a>
                    </li>
                    <li>
                        <a href="pet" class="nav-link active">
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
            <!-- THIS IS MODAL -->
            <div class="col-lg-9 py-5">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add a Pet</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xs">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Pet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= site_url() ?>petshits/add_pet" method="post" name="myForm"  required>
                                <div class="modal-body">
                                    <!-- YOOOOOOOOOOO THIS IS THE FORM!! -->
                                    <div class="form-floating mb-3">
                                        <!-- YOOOOOO THIS IS THE PET NAME INPUT! -->
                                        <input type="text" class="form-control" id="pet-name" name="pet-name" placeholder="name of your pet" required>
                                        <label for="pet-name">Name of Pet</label>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div id="selection">
                                                    <select name="type" id="type" class="form-select">
                                                        <option value="dog">Dog</option>
                                                        <option value="cat">Cat</option>
                                                        <option value="bird">Bird</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col lg-6 autocomplete">
                                                <input  type="text"  placeholder="Breed" list="breeds" name="breed" id="breed" class="form-control" required>
                                                <datalist id="breeds">
                                                    <!-- dogs -->
                                                    <option value="Affenpinscher">Affenpinscher</option>
                                                    <option value="Afghan hound">Afghan hound</option>
                                                    <option value="Airedale terrier">Airedale terrier</option>
                                                    <option value="Akita">Akita</option>
                                                    <option value="Alaskan Malamute">Alaskan Malamute</option>
                                                    <option value="American Staffordshire terrier">American Staffordshire terrier</option>
                                                    <option value="American water spaniel">American water spaniel</option>
                                                    <option value="Australian cattle dog">Australian cattle dog</option>
                                                    <option value="Australian shepherd">Australian shepherd</option>
                                                    <option value="Basenji">Basenji</option>
                                                    <option value="Basset hound">Basset hound</option>
                                                    <option value="Beagle">Beagle</option>
                                                    <option value="Bearded collie">Bearded collie</option>
                                                    <option value="Bedlington terrier">Bedlington terrier</option>
                                                    <option value="Bernese mountain dog">Bernese mountain dog</option>
                                                    <option value="Bichon frise">Bichon frise</option>
                                                    <option value="Black and tan coonhound">Black and tan coonhound</option>
                                                    <option value="Bloodhound">Bloodhound</option>
                                                    <option value="Border collie">Border collie</option>
                                                    <option value="Border terrier">Border terrier</option>
                                                    <option value="Borzoi">Borzoi</option>
                                                    <option value="Boston terrier">Boston terrier</option>
                                                    <option value="Boxer">Boxer</option>
                                                    <option value="Bulldog">Bulldog</option>
                                                    <option value="Cairn terrier">Cairn terrier</option>
                                                    <option value="Canaan dog">Canaan dog</option>
                                                    <option value="Chesapeake Bay retriever">Chesapeake Bay retriever</option>
                                                    <option value="Chihuahua">Chihuahua</option>
                                                    <option value="Chinese crested"> Chinese crested </option>
                                                    <option value="Chinese shar-pei">Chinese shar-pei</option>
                                                    <option value="Chow chow">Chow chow</option>
                                                    <option value="Clumber spaniel">Clumber spaniel</option>
                                                    <option value="Cocker spaniel">Cocker spaniel</option>
                                                    <option value="Collie">Collie</option>
                                                    <option value="Curly-coated retriever">Curly-coated retriever</option>
                                                    <option value="Dachshund">Dachshund</option>
                                                    <option value="Dalmatian">Dalmatian</option>
                                                    <option value="Doberman pinscher">Doberman pinscher</option>
                                                    <option value="Eskimo dog">Eskimo dog</option>
                                                    <option value="Flat-coated retriever">Flat-coated retriever</option>
                                                    <option value="Fox terrier">Fox terrier</option>
                                                    <option value="Foxhound">Foxhound</option>
                                                    <option value="French bulldog">French bulldog</option>
                                                    <option value="German shepherd">German shepherd</option>
                                                    <option value="Gordon setter">Gordon setter</option>
                                                    <option value="Greyhound">Greyhound</option>
                                                    <option value="Irish setter">Irish setter</option>
                                                    <option value="Irish wolfhound">Irish wolfhound</option>
                                                    <option value="keeshond">keeshond</option>
                                                    <option value="Labrador retriever">Labrador retriever</option>
                                                    <option value="Mexican hairless">Mexican hairless</option>
                                                    <option value="Newfoundland">Newfoundland</option>
                                                    <option value="Norwegian elkhound">Norwegian elkhound</option>
                                                    <option value="Norwich terrier">Norwich terrier</option>
                                                    <option value="Otterhound ">Otterhound</option>
                                                    <option value="Papillon">Papillon</option>
                                                    <option value="Pekingese">Pekingese</option>
                                                    <option value="Pomeranian">Pomeranian</option>
                                                    <option value="Poodle">Poodle</option>
                                                    <option value="Pug">Pug</option>
                                                    <option value="Rhodesian ridgeback">Rhodesian ridgeback</option>
                                                    <option value="Rottweiler">Rottweiler</option>
                                                    <option value="Saint Bernard">Saint Bernard</option>
                                                    <option value="Saluki">Saluki</option>
                                                    <option value="Shih tzu">Shih tzu</option>
                                                    <option value="Siberian husky">Siberian husky</option>
                                                    <option value="Silky terrier">Silky terrier</option>
                                                    <option value="Staffordshire bull terrier">Staffordshire bull terrier</option>
                                                    <option value="Sussex spaniel">Sussex spaniel</option>
                                                    <option value="Spitz">Spitz</option>
                                                    <option value="Tibetan terrier">Tibetan terrier</option>
                                                    <option value="Vizsla">Vizsla</option>
                                                    <option value="Weimaraner">Weimaraner</option>
                                                    <option value="Welsh terrier">Welsh terrier</option>
                                                    <option value="West Highland white terrier">West Highland white terrier</option>
                                                    <option value="Whippet">Whippet</option>
                                                    <option value="Yorkshire terrier">Yorkshire terrier</option>

                                                    <!-- Cats -->
                                                    <option value="American Curl">American Curl</option>
                                                    <option value="British Shorthair">British Shorthair</option>
                                                    <option value="Bengal Cat">Bengal Cat</option>
                                                    <option value="Exotic Shorthair">Exotic Shorthair</option>
                                                    <option value="American Shorthair">American Shorthair</option>
                                                    <option value="Russian Blue">Russian Blue</option>
                                                    <option value="Himalayan Cat">Himalayan Cat</option>
                                                    <option value="Siamese Cat">Siamese Cat</option>
                                                    <option value="Persian Cat">Persian Cat</option>
                                                    <option value="Philippine Shorthair (Puspin)"> Philippine Shorthair (Puspin)</option>
                                                    <!-- birds -->
                                                    <option value=" Philippine frogmouth">Philippine frogmouth</option>
                                                    <option value="Rose-ringed parakeet">Rose-ringed parakeet</option>
                                                    <option value="Philippine pygmy woodpecker"> Philippine pygmy woodpecker </option>
                                                    <option value="Philippine falconet">Philippine falconet</option>
                                                    <option value="Rufous hornbill">Rufous hornbill</option>
                                                    <option value="Grey parrot">Grey parrot</option>
                                                    <option value="Palawan peacock-pheasant">Palawan peacock-pheasant</option>
                                                    <option value="Eclectus parrot">Eclectus parrot</option>
                                                    <option value="Amazon parrots">Amazon parrots</option>
                                                    <option value="Cockatoos">Cockatoos</option>
                                                    <option value="Macaw">Macaw</option>
                                                </datalist> 
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Birthdate INPUT HERE -->
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="birth" class="form-label">Birthdate: </label>
                                                <input type="date" name="birth" id="birth" class="form-control" max=<?= date("Y-m-d") ?> required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="gender" class="form-label">Gender: </label>
                                                <select name="gender" class="form-select">
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Description of the pet" id="description" name="description" style="height: 100px"></textarea>
                                        <label for="description">Description of the pet</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="row row-cols-6 row-cols-md-3 g-4 mt-3">
                        <?php foreach($peta as $key => $value) { ?>
                        <div class="col px-0">
                            <div class="card me-2 px-0" style="width: 18rem;">
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editPicture<?= $value['id'] ?>">
                                    <?php if ($value['photo'] == NULL || $value['photo'] == '') { ?>
                                        <img src="<?= base_url(); ?>/images/dog.jpg" class="card-img-top" alt="...">
                                    <?php }else { ?>
                                        <img src="<?= base_url(); ?>/images/<?= $email ?>/pets/<?= $value['photo'] ?>" class="card-img-top" alt="...">
                                        
                                    <?php }?>
                    
                                
                                </button>
                                <div class="modal fade" id="editPicture<?= $value['id'] ?>" tabindex="-1" aria-labelledby="editPicture" aria-hidden="true">
                                    <div class="modal-dialog modal-xs">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editPicture">Edit Picture</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url() ?>petshits/uploadPicofPet/<?= $value['id'] ?>" method="post" name="myForm" enctype="multipart/form-data"  required>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label for="image" class="form-label">Upload Picture: </label>
                                                                <input type="file" accept="image/*" name="image" id="image" oninput="frame.src=window.URL.createObjectURL(this.files[0])" class="form-control">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="gender" class="form-label">Photo: </label>
                                                                <img id="frame" src="" class="img-fluid" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <button onclick="clearImage()" id="clear" type="reset" class="btn btn-secondary">Clear</button> -->
                                                    <button type="submit" class="btn btn-primary">Upload</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $value['name']; ?></h5>
                                    <p class="card-text"><?= $value['description']; ?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Birthdate: <?= date_format(date_create($value['birthdate']), "F j, Y"); ?> 
                                    <p class="mt-2 mb-0"><?php if($value['year'] > 1){ echo $value['year']; ?> years <?php }else{ echo $value['year'];?> year <?php } ?><?php if($value['month'] > 1){ echo $value['month']; ?> months <?php }else{echo $value['month'];?> month <?php } ?></p></li>
                                    <li class="list-group-item"><?= $value['breed']; ?><small class="text-muted my-0"><p class="mb-0"><?= $value['gender']; ?>
                                        <?= $value['type']; ?></p></small></li>
                                    <li class="list-group-item">Last visit to clinic:</li>
                                </ul>
                                <div class="card-body">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal<?=$value['id']?>">Edit Details</button>
                                </div>
                                <!-- EDIT MODAL IS HERE -->
                                <div class="modal fade" id="editModal<?=$value['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xs">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= $value['name'] ?>'s Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- YOOOOOOOOOOO THIS IS THE EDIT FORM!! -->
                                            <form action="<?= site_url() ?>petshits/edit/<?= $value['id'] ?>" method="post" required>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <!-- YOOOOOO THIS IS THE PET NAME INPUT! -->
                                                        <input type="text" class="form-control" value="<?= $value['name'] ?>" id="pet-name" name="pet-name" placeholder="name of your pet" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <!-- TYPE SELECTION -->
                                                                <div id="selection">
                                                                    <select name="type" id="type" class="form-select">
                                                                        <option value="dog">Dog</option>
                                                                        <option value="cat">Cat</option>
                                                                        <option value="bird">Bird</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- BREED INPUT TEXT -->
                                                            <div class="col lg-6 autocomplete">
                                                                <input  type="text" value="<?= $value['breed'] ?>"  placeholder="Breed" list="breeds" name="breed" id="breed" class="form-control" required>
                                                                <datalist id="breeds">
                                                                    <!-- dogs -->
                                                                    <option value="Affenpinscher">Affenpinscher</option>
                                                                    <option value="Afghan hound">Afghan hound</option>
                                                                    <option value="Airedale terrier">Airedale terrier</option>
                                                                    <option value="Akita">Akita</option>
                                                                    <option value="Alaskan Malamute">Alaskan Malamute</option>
                                                                    <option value="American Staffordshire terrier">American Staffordshire terrier</option>
                                                                    <option value="American water spaniel">American water spaniel</option>
                                                                    <option value="Australian cattle dog">Australian cattle dog</option>
                                                                    <option value="Australian shepherd">Australian shepherd</option>
                                                                    <option value="Basenji">Basenji</option>
                                                                    <option value="Basset hound">Basset hound</option>
                                                                    <option value="Beagle">Beagle</option>
                                                                    <option value="Bearded collie">Bearded collie</option>
                                                                    <option value="Bedlington terrier">Bedlington terrier</option>
                                                                    <option value="Bernese mountain dog">Bernese mountain dog</option>
                                                                    <option value="Bichon frise">Bichon frise</option>
                                                                    <option value="Black and tan coonhound">Black and tan coonhound</option>
                                                                    <option value="Bloodhound">Bloodhound</option>
                                                                    <option value="Border collie">Border collie</option>
                                                                    <option value="Border terrier">Border terrier</option>
                                                                    <option value="Borzoi">Borzoi</option>
                                                                    <option value="Boston terrier">Boston terrier</option>
                                                                    <option value="Boxer">Boxer</option>
                                                                    <option value="Bulldog">Bulldog</option>
                                                                    <option value="Cairn terrier">Cairn terrier</option>
                                                                    <option value="Canaan dog">Canaan dog</option>
                                                                    <option value="Chesapeake Bay retriever">Chesapeake Bay retriever</option>
                                                                    <option value="Chihuahua">Chihuahua</option>
                                                                    <option value="Chinese crested"> Chinese crested </option>
                                                                    <option value="Chinese shar-pei">Chinese shar-pei</option>
                                                                    <option value="Chow chow">Chow chow</option>
                                                                    <option value="Clumber spaniel">Clumber spaniel</option>
                                                                    <option value="Cocker spaniel">Cocker spaniel</option>
                                                                    <option value="Collie">Collie</option>
                                                                    <option value="Curly-coated retriever">Curly-coated retriever</option>
                                                                    <option value="Dachshund">Dachshund</option>
                                                                    <option value="Dalmatian">Dalmatian</option>
                                                                    <option value="Doberman pinscher">Doberman pinscher</option>
                                                                    <option value="Eskimo dog">Eskimo dog</option>
                                                                    <option value="Flat-coated retriever">Flat-coated retriever</option>
                                                                    <option value="Fox terrier">Fox terrier</option>
                                                                    <option value="Foxhound">Foxhound</option>
                                                                    <option value="French bulldog">French bulldog</option>
                                                                    <option value="German shepherd">German shepherd</option>
                                                                    <option value="Gordon setter">Gordon setter</option>
                                                                    <option value="Greyhound">Greyhound</option>
                                                                    <option value="Irish setter">Irish setter</option>
                                                                    <option value="Irish wolfhound">Irish wolfhound</option>
                                                                    <option value="keeshond">keeshond</option>
                                                                    <option value="Labrador retriever">Labrador retriever</option>
                                                                    <option value="Mexican hairless">Mexican hairless</option>
                                                                    <option value="Newfoundland">Newfoundland</option>
                                                                    <option value="Norwegian elkhound">Norwegian elkhound</option>
                                                                    <option value="Norwich terrier">Norwich terrier</option>
                                                                    <option value="Otterhound ">Otterhound</option>
                                                                    <option value="Papillon">Papillon</option>
                                                                    <option value="Pekingese">Pekingese</option>
                                                                    <option value="Pomeranian">Pomeranian</option>
                                                                    <option value="Poodle">Poodle</option>
                                                                    <option value="Pug">Pug</option>
                                                                    <option value="Rhodesian ridgeback">Rhodesian ridgeback</option>
                                                                    <option value="Rottweiler">Rottweiler</option>
                                                                    <option value="Saint Bernard">Saint Bernard</option>
                                                                    <option value="Saluki">Saluki</option>
                                                                    <option value="Shih tzu">Shih tzu</option>
                                                                    <option value="Siberian husky">Siberian husky</option>
                                                                    <option value="Silky terrier">Silky terrier</option>
                                                                    <option value="Staffordshire bull terrier">Staffordshire bull terrier</option>
                                                                    <option value="Sussex spaniel">Sussex spaniel</option>
                                                                    <option value="Spitz">Spitz</option>
                                                                    <option value="Tibetan terrier">Tibetan terrier</option>
                                                                    <option value="Vizsla">Vizsla</option>
                                                                    <option value="Weimaraner">Weimaraner</option>
                                                                    <option value="Welsh terrier">Welsh terrier</option>
                                                                    <option value="West Highland white terrier">West Highland white terrier</option>
                                                                    <option value="Whippet">Whippet</option>
                                                                    <option value="Yorkshire terrier">Yorkshire terrier</option>

                                                                    <!-- Cats -->
                                                                    <option value="American Curl">American Curl</option>
                                                                    <option value="British Shorthair">British Shorthair</option>
                                                                    <option value="Bengal Cat">Bengal Cat</option>
                                                                    <option value="Exotic Shorthair">Exotic Shorthair</option>
                                                                    <option value="American Shorthair">American Shorthair</option>
                                                                    <option value="Russian Blue">Russian Blue</option>
                                                                    <option value="Himalayan Cat">Himalayan Cat</option>
                                                                    <option value="Siamese Cat">Siamese Cat</option>
                                                                    <option value="Persian Cat">Persian Cat</option>
                                                                    <option value="Philippine Shorthair (Puspin)"> Philippine Shorthair (Puspin)</option>
                                                                    <!-- birds -->
                                                                    <option value=" Philippine frogmouth">Philippine frogmouth</option>
                                                                    <option value="Rose-ringed parakeet">Rose-ringed parakeet</option>
                                                                    <option value="Philippine pygmy woodpecker"> Philippine pygmy woodpecker </option>
                                                                    <option value="Philippine falconet">Philippine falconet</option>
                                                                    <option value="Rufous hornbill">Rufous hornbill</option>
                                                                    <option value="Grey parrot">Grey parrot</option>
                                                                    <option value="Palawan peacock-pheasant">Palawan peacock-pheasant</option>
                                                                    <option value="Eclectus parrot">Eclectus parrot</option>
                                                                    <option value="Amazon parrots">Amazon parrots</option>
                                                                    <option value="Cockatoos">Cockatoos</option>
                                                                    <option value="Macaw">Macaw</option>
                                                                </datalist> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Birthdate INPUT HERE -->
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label for="birth" class="form-label">Birthdate: </label>
                                                                <input type="date" value="<?= $value['birthdate'] ?>" name="birth" id="birth" class="form-control" max=<?= date("Y-m-d") ?> required>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="gender" class="form-label">Gender: </label>
                                                                <select name="gender" class="form-select">
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Description of the pet" id="description" name="description" style="height: 100px"></textarea>
                                                        <label for="description">Description of the pet</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><?php  } ?>
                    </div>
            </div>
        </div>
    </div>
    
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