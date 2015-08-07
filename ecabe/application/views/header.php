<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <link href="<?php echo base_url('assets/css/metro.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/metro.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
    <link href="<?php echo base_url('assets/css/metro-icons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/metro-responsive.css'); ?>" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
        }
        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }

        @media screen and (max-width: 800px){
            #cell-sidebar {
                flex-basis: 52px;
            }
            #cell-content {
                flex-basis: calc(100% - 52px);
            }
        }
    </style>
</head>
<body class="bg-steel">
<div class="app-bar fixed-top darcula" data-role="appbar">
    <a class="app-bar-element branding">eCabe</a>
    <span class="app-bar-divider"></span>
    <ul class="app-bar-menu">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Berita</a></li>
        <li>
            <a href="" class="dropdown-toggle">Statistik</a>
            <ul class="d-menu" data-role="dropdown">
                <li><a href="">Statistik Harga Cabe</a></li>
                <li><a href="">Statistik per-Wilayah</a></li>
            </ul>
        </li>
        <li><a href="">Pasar</a></li>
        <li><a href="">Petani</a></li>
        <li><a href="">Tentang eCabe</a></li>
    </ul>

    <div class="app-bar-element place-right">
        <span class="dropdown-toggle"><span class="mif-cog"></span> User Name</span>
        <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
            <h2 class="text-light">Quick settings</h2>
            <ul class="unstyled-list fg-dark">
                <li><a href="" class="fg-white1 fg-hover-yellow">Profile</a></li>
                <li><a href="" class="fg-white2 fg-hover-yellow">Security</a></li>
                <li><a href="" class="fg-white3 fg-hover-yellow">Exit</a></li>
            </ul>
        </div>
    </div>
</div>