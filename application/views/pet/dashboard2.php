<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- JavaScript Bundle with Popper -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    
    <!-- Link Full Calendar  -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <!--  -->
    <script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var options = {
	title: {
		text: "Report of total sales for items"              
	},
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "column",
		dataPoints: [
            <?php foreach ($sales as $key => $value) { ?>
                { label: "<?= $value['product_name'] ?>",  y: <?= $value['amount_paid'] ?>  },
            <?php } ?>
		]
	}
	]
};

var pie = {
	title: {
		text: "Customers bought more"
	},
	data: [{
			type: "pie",
			startAngle: 45,
			showInLegend: "true",
			legendText: "{label}",
			indexLabel: "{label} ({y})",
			yValueFormatString:"#,##0.#"%"",
			dataPoints: [
                <?php foreach ($pie as $key => $value) { ?>
                    { label: "<?= $value['product'] ?>", y: <?= $value['count'] ?> },
                    
                <?php } ?>

			]
	}]
};

$("#chartContainer").CanvasJSChart(options);
$("#pieChart").CanvasJSChart(pie);
}
</script>
</head>
<body>
    <div class="container-fluid">
<?php extract($_SESSION['user']); 
extract($clinic); 
extract($monthly);?>

  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href=""><img class="img-fluid" src="<?= base_url() ?>images/<?= $image ?>" alt="" width="70" height="70"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?= base_url() ?>pets/login">Home</a>
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
                            <a class="nav-link  active" href="<?= base_url() ?>petshits/dashboard2">Dashboard</a>
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
<div class="container ms-3 mt-2">
    <div class="row">
        <div class="col-6">
            <div class="sales border-3 border-start border-info shadow rounded py-3 px-3">
                <h6 class="text-info">Earnings <small>(MONTHLY)</small> </h6>
                <div class="sales">
                    <h4>$ <?= $monthly['sale']; ?> </h4>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="sales border-3 border-start border-primary shadow rounded py-3 px-3">
                <h6 class="text-primary">Earnings <small>(ANNUAL)</small></h6>
                <div class="sales">
                    <h4>$ <?= $yearly['sale']; ?></h4>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row pt-4">
        <div class="col-9">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
        <div class="col-3">
            <div id="pieChart" style="height: 370px; width: 100%;"></div>
        </div>
    </div>
           
</div>
</div>
<!-- modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

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