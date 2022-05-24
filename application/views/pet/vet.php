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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>
<body>
    <div class="container-fluid">
<?php extract($_SESSION['user']);?>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href=""><img class="img-fluid" src="<?= base_url() ?>images/logo_registration.png" alt="" width="70" height="70"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>petshits/services">Services</a>
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
                <button class="btn btn-success mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit your Clinic here</button>
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Menu </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <?php  
        extract($clinic);
        // var_dump($clinic);
     ?>
<div class="section ms-3 mt-2">
    <center><img src="<?= base_url() ?>images/<?= $image ?>" class="img-fluid my-3 text-center" style="width: 100px" alt=""></center>
    <h1 style="font-family: sans-serif;" class="text-center"><?= $clinic_name ?></h1>
    <h6 class="text-center"><?= $unit_number.' '.$street .' '. $municipality .' '. $city .', '.$country ?></h6>
    <p class="text-center">Opens on <?= $schedule ?></p>
    <p class="text-center">Opens on <?= date_format(date_create($monday_opening), 'h:i A')?>-<?= date_format(date_create($monday_closing), 'h:i A') ?>, <?= date_format(date_create($tuesday_opening), 'h:i A')?>-<?= date_format(date_create($tuesday_closing), 'h:i A') ?>, <?= date_format(date_create($wednesday_opening), 'h:i A')?>-<?= date_format(date_create($wednesday_closing), 'h:i A') ?>, <?= date_format(date_create($thursday_opening), 'h:i A')?>-<?= date_format(date_create($thursday_closing), 'h:i A') ?>, <?= date_format(date_create($friday_opening), 'h:i A')?>-<?= date_format(date_create($friday_closing), 'h:i A') ?>,</p>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload an image</button>
    <!-- upload picture for products modal -->
    <div class="modal fade" id="uploadModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Picture for <?= $clinic_name ?></h5>
                </div>
                <form enctype="multipart/form-data" action="<?= base_url() ?>petshits/upload_pic_for_clinic/<?= $id ?>" method="post">
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
    <div class="row">
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Clinic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>petshits/edit_clinics" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="name of your pet" value="<?= $clinic_name ?>" required>
                    <label for="name" class="form-label">Clinic Name</label>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input list="country" name="country" class="form-control" value="<?= $country ?>" />
                    <datalist id="country">
                        <option value="Afghanistan" />
                        <option value="Albania" />
                        <option value="Algeria" />
                        <option value="American Samoa" />
                        <option value="Andorra" />
                        <option value="Angola" />
                        <option value="Anguilla" />
                        <option value="Antarctica" />
                        <option value="Antigua and Barbuda" />
                        <option value="Argentina" />
                        <option value="Armenia" />
                        <option value="Aruba" />
                        <option value="Australia" />
                        <option value="Austria" />
                        <option value="Azerbaijan" />
                        <option value="Bahamas" />
                        <option value="Bahrain" />
                        <option value="Bangladesh" />
                        <option value="Barbados" />
                        <option value="Belarus" />
                        <option value="Belgium" />
                        <option value="Belize" />
                        <option value="Benin" />
                        <option value="Bermuda" />
                        <option value="Bhutan" />
                        <option value="Bolivia" />
                        <option value="Bosnia and Herzegovina" />
                        <option value="Botswana" />
                        <option value="Bouvet Island" />
                        <option value="Brazil" />
                        <option value="British Indian Ocean Territory" />
                        <option value="Brunei Darussalam" />
                        <option value="Bulgaria" />
                        <option value="Burkina Faso" />
                        <option value="Burundi" />
                        <option value="Cambodia" />
                        <option value="Cameroon" />
                        <option value="Canada" />
                        <option value="Cape Verde" />
                        <option value="Cayman Islands" />
                        <option value="Central African Republic" />
                        <option value="Chad" />
                        <option value="Chile" />
                        <option value="China" />
                        <option value="Christmas Island" />
                        <option value="Cocos (Keeling) Islands" />
                        <option value="Colombia" />
                        <option value="Comoros" />
                        <option value="Congo" />
                        <option value="Congo, The Democratic Republic of The" />
                        <option value="Cook Islands" />
                        <option value="Costa Rica" />
                        <option value="Cote D'ivoire" />
                        <option value="Croatia" />
                        <option value="Cuba" />
                        <option value="Cyprus" />
                        <option value="Czech Republic" />
                        <option value="Denmark" />
                        <option value="Djibouti" />
                        <option value="Dominica" />
                        <option value="Dominican Republic" />
                        <option value="Ecuador" />
                        <option value="Egypt" />
                        <option value="El Salvador" />
                        <option value="Equatorial Guinea" />
                        <option value="Eritrea" />
                        <option value="Estonia" />
                        <option value="Ethiopia" />
                        <option value="Falkland Islands (Malvinas)" />
                        <option value="Faroe Islands" />
                        <option value="Fiji" />
                        <option value="Finland" />
                        <option value="France" />
                        <option value="French Guiana" />
                        <option value="French Polynesia" />
                        <option value="French Southern Territories" />
                        <option value="Gabon" />
                        <option value="Gambia" />
                        <option value="Georgia" />
                        <option value="Germany" />
                        <option value="Ghana" />
                        <option value="Gibraltar" />
                        <option value="Greece" />
                        <option value="Greenland" />
                        <option value="Grenada" />
                        <option value="Guadeloupe" />
                        <option value="Guam" />
                        <option value="Guatemala" />
                        <option value="Guinea" />
                        <option value="Guinea-bissau" />
                        <option value="Guyana" />
                        <option value="Haiti" />
                        <option value="Heard Island and Mcdonald Islands" />
                        <option value="Holy See (Vatican City State)" />
                        <option value="Honduras" />
                        <option value="Hong Kong" />
                        <option value="Hungary" />
                        <option value="Iceland" />
                        <option value="India" />
                        <option value="Indonesia" />
                        <option value="Iran, Islamic Republic of" />
                        <option value="Iraq" />
                        <option value="Ireland" />
                        <option value="Israel" />
                        <option value="Italy" />
                        <option value="Jamaica" />
                        <option value="Japan" />
                        <option value="Jordan" />
                        <option value="Kazakhstan" />
                        <option value="Kenya" />
                        <option value="Kiribati" />
                        <option value="Korea, Democratic People's Republic of" />
                        <option value="Korea, Republic of" />
                        <option value="Kuwait" />
                        <option value="Kyrgyzstan" />
                        <option value="Lao People's Democratic Republic" />
                        <option value="Latvia" />
                        <option value="Lebanon" />
                        <option value="Lesotho" />
                        <option value="Liberia" />
                        <option value="Libyan Arab Jamahiriya" />
                        <option value="Liechtenstein" />
                        <option value="Lithuania" />
                        <option value="Luxembourg" />
                        <option value="Macao" />
                        <option value="Macedonia, The Former Yugoslav Republic of" />
                        <option value="Madagascar" />
                        <option value="Malawi" />
                        <option value="Malaysia" />
                        <option value="Maldives" />
                        <option value="Mali" />
                        <option value="Malta" />
                        <option value="Marshall Islands" />
                        <option value="Martinique" />
                        <option value="Mauritania" />
                        <option value="Mauritius" />
                        <option value="Mayotte" />
                        <option value="Mexico" />
                        <option value="Micronesia, Federated States of" />
                        <option value="Moldova, Republic of" />
                        <option value="Monaco" />
                        <option value="Mongolia" />
                        <option value="Montserrat" />
                        <option value="Morocco" />
                        <option value="Mozambique" />
                        <option value="Myanmar" />
                        <option value="Namibia" />
                        <option value="Nauru" />
                        <option value="Nepal" />
                        <option value="Netherlands" />
                        <option value="Netherlands Antilles" />
                        <option value="New Caledonia" />
                        <option value="New Zealand" />
                        <option value="Nicaragua" />
                        <option value="Niger" />
                        <option value="Nigeria" />
                        <option value="Niue" />
                        <option value="Norfolk Island" />
                        <option value="Northern Mariana Islands" />
                        <option value="Norway" />
                        <option value="Oman" />
                        <option value="Pakistan" />
                        <option value="Palau" />
                        <option value="Palestinian Territory, Occupied" />
                        <option value="Panama" />
                        <option value="Papua New Guinea" />
                        <option value="Paraguay" />
                        <option value="Peru" />
                        <option value="Philippines" />
                        <option value="Pitcairn" />
                        <option value="Poland" />
                        <option value="Portugal" />
                        <option value="Puerto Rico" />
                        <option value="Qatar" />
                        <option value="Reunion" />
                        <option value="Romania" />
                        <option value="Russian Federation" />
                        <option value="Rwanda" />
                        <option value="Saint Helena" />
                        <option value="Saint Kitts and Nevis" />
                        <option value="Saint Lucia" />
                        <option value="Saint Pierre and Miquelon" />
                        <option value="Saint Vincent and The Grenadines" />
                        <option value="Samoa" />
                        <option value="San Marino" />
                        <option value="Sao Tome and Principe" />
                        <option value="Saudi Arabia" />
                        <option value="Senegal" />
                        <option value="Serbia and Montenegro" />
                        <option value="Seychelles" />
                        <option value="Sierra Leone" />
                        <option value="Singapore" />
                        <option value="Slovakia" />
                        <option value="Slovenia" />
                        <option value="Solomon Islands" />
                        <option value="Somalia" />
                        <option value="South Africa" />
                        <option value="South Georgia and The South Sandwich Islands" />
                        <option value="Spain" />
                        <option value="Sri Lanka" />
                        <option value="Sudan" />
                        <option value="Suriname" />
                        <option value="Svalbard and Jan Mayen" />
                        <option value="Swaziland" />
                        <option value="Sweden" />
                        <option value="Switzerland" />
                        <option value="Syrian Arab Republic" />
                        <option value="Taiwan, Province of China" />
                        <option value="Tajikistan" />
                        <option value="Tanzania, United Republic of" />
                        <option value="Thailand" />
                        <option value="Timor-leste" />
                        <option value="Togo" />
                        <option value="Tokelau" />
                        <option value="Tonga" />
                        <option value="Trinidad and Tobago" />
                        <option value="Tunisia" />
                        <option value="Turkey" />
                        <option value="Turkmenistan" />
                        <option value="Turks and Caicos Islands" />
                        <option value="Tuvalu" />
                        <option value="Uganda" />
                        <option value="Ukraine" />
                        <option value="United Arab Emirates" />
                        <option value="United Kingdom" />
                        <option value="United States" />
                        <option value="United States Minor Outlying Islands" />
                        <option value="Uruguay" />
                        <option value="Uzbekistan" />
                        <option value="Vanuatu" />
                        <option value="Venezuela" />
                        <option value="Viet Nam" />
                        <option value="Virgin Islands, British" />
                        <option value="Virgin Islands, U.S" />
                        <option value="Wallis and Futuna" />
                        <option value="Western Sahara" />
                        <option value="Yemen" />
                        <option value="Zambia" />
                        <option value="Zimbabwe" />
                    </datalist>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="unit_number" class="form-label">Unit Number</label>
                            <input type="text" name="unit_number" class="form-control" id="unit_number" value="<?= $unit_number ?>" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="street" class="form-label">Street</label>
                            <input type="text" name="street" class="form-control" id="street" value="<?= $street ?>" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="municipality" class="form-label">Municipality</label>
                            <input type="text" name="municipality" class="form-control" id="municipality" value="<?= $municipality ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" id="city" value="<?= $city ?>" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Telephone</label>
                            <input type="text" name="telephone" class="form-control" id="telephone" value="<?= $telephone ?>" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="text" name="contact" class="form-control" id="contact" value="<?= $contact_number ?>" required>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <h6>Check the days your clinic is open</h6>
                    <div class="col-4">
                        <div class="form-check pt-4">
                            <input class="form-check-input" type="checkbox" id="monday" name="schedule[]" value="monday">
                            <label class="form-check-label" for="monday">Monday</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="opening" class="form-label">Opening Time</label>
                        <input type="time" class="form-control" id="mondayopening" name="mondayopening"
                         required>
                    </div>
                    <div class="col-4">
                        <label for="closing" class="form-label">Closing Time</label>
                        <input type="time" class="form-control" id="mondayclosing" name="mondayclosing"
                         >
                    </div>
                    <div class="col-4"><!-- tuesday -->
                        <div class="form-check pt-4">
                            <input class="form-check-input" type="checkbox" id="tuesday" name="schedule[]" value="tuesday">
                            <label class="form-check-label" for="schedule">Tuesday</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="opening" class="form-label"></label>
                        <input type="time" class="form-control" id="tuesdayopening" name="tuesdayopening"
                         >
                    </div>
                    <div class="col-4">
                        <label for="closing" class="form-label"></label>
                        <input type="time" class="form-control" id="tuesdayclosing" name="tuesdayclosing"
                         >
                    </div>
                    <div class="col-4"><!-- wednesday -->
                        <div class="form-check pt-4">
                            <input class="form-check-input" type="checkbox" id="wednesday" name="schedule[]" value="wednesday">
                            <label class="form-check-label" for="schedule">Wednesday</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="opening" class="form-label"></label>
                        <input type="time" class="form-control" id="wednesdayopening" name="wednesdayopening"
                         >
                    </div>
                    <div class="col-4">
                        <label for="closing" class="form-label"></label>
                        <input type="time" class="form-control" id="wednesdayclosing" name="wednesdayclosing"
                         >
                    </div>
                    <div class="col-4"><!-- thursday -->
                        <div class="form-check pt-4">
                            <input class="form-check-input" type="checkbox" id="thursday" name="schedule[]" value="thursday">
                            <label class="form-check-label" for="schedule">Thursday</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="opening" class="form-label"></label>
                        <input type="time" class="form-control" id="thursdayopening" name="thursdayopening"
                         >
                    </div>
                    <div class="col-4">
                        <label for="closing" class="form-label"></label>
                        <input type="time" class="form-control" id="thursdayclosing" name="thursdayclosing"
                         >
                    </div>
                    <div class="col-4"><!-- friday -->
                        <div class="form-check pt-4">
                            <input class="form-check-input" type="checkbox" id="friday" name="schedule[]" value="friday">
                            <label class="form-check-label" for="schedule">Friday</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="opening" class="form-label"></label>
                        <input type="time" class="form-control" id="fridayopening" name="fridayopening"
                         >
                    </div>
                    <div class="col-4">
                        <label for="closing" class="form-label"></label>
                        <input type="time" class="form-control" id="fridayclosing" name="fridayclosing"
                         >
                    </div>
                    <div class="col-4"><!-- saturday -->
                        <div class="form-check pt-4">
                            <input class="form-check-input" type="checkbox" id="saturday" name="schedule[]" value="saturday">
                            <label class="form-check-label" for="schedule">Saturday</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="opening" class="form-label"></label>
                        <input type="time" class="form-control" id="saturdayopening" name="saturdayopening"
                         >
                    </div>
                    <div class="col-4">
                        <label for="closing" class="form-label"></label>
                        <input type="time" class="form-control" id="saturdayclosing" name="saturdayclosing"
                         >
                    </div>
                    <div class="col-4"><!-- sunday -->
                        <div class="form-check pt-4">
                            <input class="form-check-input" type="checkbox" id="sunday" name="schedule[]" value="sunday">
                            <label class="form-check-label" for="schedule">Sunday</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="opening" class="form-label"></label>
                        <input type="time" class="form-control" id="sundayopening" name="sundayopening"
                        >
                    </div>
                    <div class="col-4">
                        <label for="closing" class="form-label"></label>
                        <input type="time" class="form-control" id="sundayclosing" name="sundayclosing"
                         >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Save Clinic">
            </div>
        </form>
    </div>
  </div>
</div>
<script>
   $(document).ready( function () {
    $('#service').DataTable();
    $('#product').DataTable();
} );
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