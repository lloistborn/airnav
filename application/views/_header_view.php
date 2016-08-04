<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

   	<?php 
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url().$this->uri->segment(1); ?>">
                <img src="<?php echo base_url().'assets/logo/logo_airnav.jpg' ?>">
            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
            <?php if($this->session->userdata("logged_in")): ?>
                <a href="<?php echo base_url(); ?>auth/logout/"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            <?php endif; ?>
            </li>
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <?php if($this->uri->segment(1) == "admin"): ?>
                            <img src="<?php echo base_url().'assets/foto_profil/admin.jpg' ?>">
                            <a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fa fa-dashboard fa-fw"></i> Data Maskapai</a>
                            <a href="<?php echo base_url('admin/alternatif'); ?>"><i class="fa fa-line-chart "></i> Alternatif</a>
                            <a href="<?php echo base_url('admin/user'); ?>"><i class="fa fa-users "></i> User</a>
                        <?php endif; ?>
                        
                        <?php if($this->uri->segment(1) == "maskapai"): ?>
                            <img src="<?php echo base_url().'assets/foto_profil/maskapai.jpg' ?>">
                            <a href="<?php echo base_url().$this->uri->segment(1); ?>"><i class="fa fa-dashboard fa-fw"></i> Data Alternatif Harga</a>
                        <?php endif; ?>

                        <?php if($this->uri->segment(1) == "manager"): ?>
                            <img src="<?php echo base_url().'assets/foto_profil/manager.jpg' ?>">
                            <a href="<?php echo base_url().$this->uri->segment(1); ?>"><i class="fa fa-dashboard fa-fw"></i> Laporan ALternatif Harga</a>
                        <?php endif; ?>                        
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>