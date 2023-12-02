<?php
require('../koneksi.php');
session_start();
error_reporting(0);
$userName = $_SESSION['name'];
$query_mysql = mysqli_query($koneksi, "select * from user_detail where user_fullname = '$userName'");
$data = mysqli_fetch_array($query_mysql);
if (isset($_POST['update'])) {
    $id_progres = $_POST['txt_id'];
    $query = "SELECT pemesanan_rumah.nama_pemesan, proggres.id_user, proggres.tanggal, proggres.id, proggres.id_pemesanan, proggres.status, proggres.keterangan, proggres.foto FROM proggres INNER JOIN pemesanan_rumah ON pemesanan_rumah.id_pemesanan_rumah=proggres.id_pemesanan WHERE id='$id_progres'";
    $result1 = mysqli_query($koneksi, $query);
    
    $id_pemesanan_rumah = $_POST['id_pemesanan_rumah'];
    $id_user = $_POST['id_user'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];
    $fotolama = $row['foto_progreslama'];
    // $filter = $_POST['txt_filter'];
    $target_dir = "../img/proggres/";
    $target_file = $target_dir . basename($_FILES["txt_fotocluster"]["name"]);
    $uploadprogres = $_FILES['txt_fotocluster']['name'];
    $filecluster = $_FILES['temp_name'];
    $image_files = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  

    //cek jika ada foto baru
    if ($uploadprogres) {
        //kalau ada gambar
        //hapus gambar lama
        unlink('img/proggres/' . $fotolama);


        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["txt_fotocluster"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["txt_fotocluster"]["tmp_name"], $target_file)) {
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        //membuat query
        $query = "UPDATE progres SET status='$status', tanggal='$tanggal',keterangan='$keterangan',foto='$uploadfoto' WHERE id='$id_progres'";
    } else {
        $query = "UPDATE progres SET status='$status', tanggal='$tanggal',keterangan='$keterangan' WHERE id='$id_progres'";

    }
    echo $query;
    $result = mysqli_query($koneksi, $query);
    $result1 = mysqli_query($koneksi, $queryy);
    // header('Location: form-edit-cluster.php');

    if ($result) {
        echo "<script>alert('Data Telah Berhasil Di Update');window.location='../admin/cluster.php'</script>";
    }
}


    $id_progres = $_GET['id'];
$query = "SELECT * FROM proggres JOIN pemesanan_rumah ON pemesanan_rumah.id_pemesanan_rumah=proggres.id_pemesanan WHERE id='$id_progres'";
$result = mysqli_query($koneksi, $query);
//$nomor = 1;
while ($row = mysqli_fetch_array($result)) {
    $id_progres    = $row['id'];
    $id_pemesanan_rumah = $row['id_pemesanan_rumah'];
    $id_user = $row['id_user'];
    $nama_pemesan = $row['nama_pemesan'];
    $status = $row['status'];
    $tanggal = $row['tanggal'];
    $keterangan = $row['keterangan'];
    $uploadfoto = $row['foto'];
}

                          
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Konten - Bernady Land Slawu</title>
    <!-- Favicons -->
    <link href="../img/logo-bernady.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->
                <div class="sidebar-brand-text mx-3">Admin Keuangan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kelola Data
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="list-pemesanan.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                </svg>
                <span class="ml-3">Data Pemesanan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pembayaran.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                </svg>
                <span class="ml-3">Pembayaran</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pembayaran.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                </svg>
                <span class="ml-3">Progres</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userName ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800 text-center">Edit Progres <?php echo $nama_cluster ?></h1> -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 m-auto" style="width: 600px;">
                        <div class="card-body">
                            <form class="php-email-form" action="../admin/edit_progres.php" method="POST" enctype="multipart/form-data">
                                <div class="col">
                                    <h1 class="text-center"><span>Update Progres Pemesanan</span></h1>
                                    <div>
                                        <!-- <label>ID Progres</label> -->
                                        <input type="hidden" name="txt_id" value="<?php echo $id_progres; ?>" />
                                    </div>
                                    <div class="row-md-6 form-group mb-3">
                                        <label>Id User</label>
                                        <input class="form-control" type="text" name="id_user" value="<?php echo $id_user; ?>" />    
                                        </select>
                                    </div>
                                    <div class="row-md-6 form-group mb-3">
                                        <label>Id Pemesanan Rumah</label>
                                        <input class="form-control" type="text" name="id_pemesanan_rumah" value="<?php echo $id_pemesanan_rumah; ?>" />
                                    </div>
                                    <div class="row-md-6 form-group mb-3">
                                        <label>Nama Pemesan</label>
                                        <input class="form-control" type="text" name="nama_pemesan" value="<?php echo $nama_pemesan; ?>" />
                                    </div>
                                    <div class="row-md-6 form-group mb-3">
                                        <label>Tanggal</label>
                                        <input class="form-control" type="date" name="tanggal" value="<?php echo $tanggal; ?>" />
                                    </div>
                                    <div class="row-md-6 form-group mb-3">
                                    <label>Status</label>
                                    <input class="form-control" type="text" name="status" value="<?php echo $status; ?>" />
                                    </div>
                                    <div class="row-md-6 form-group mt-3 mt-md-0 mb-3">
                                        <label>Keterangan</label>
                                        <textarea class="form-control"  name="keterangan" placeholder="Keterangan" maxlength="500" rows="2"><?php echo $keterangan;?></textarea>
                                    </div>
                                <div class="row-md-6 form-group mt-3 mt-md-0 mb-3">
                                    <label>Foto Progres</label>
                                    <div class="image-wrapper">
                                        <img src="img/proggres/<?php echo $row['foto'] ?>">
                                    </div>
                                    <input type="file" name="txt_fotocluster" value="" />
                                    <input type="hidden" name="txt_fotoprogreslama" value="<?php echo $row['foto']; ?>" />
                                </div>
                                <div class="group">
                                    <input type="submit" name="update" class="btn btn-info btn-md" value="Update">
                                </div>
                                <!-- <div class="row-md-6 form-group mt-3 mt-md-0 mb-3"> 
                <center><button type="submit" class="btn btn-outline-info" name="Update">Update</button></center>
                </div> -->
                        </div>

                        <!-- <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required disabled>
              </div> -->
                        <!-- <div class="text-center"><button type="submit">Send Message</button></div> -->
                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>