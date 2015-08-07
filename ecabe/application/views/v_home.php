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

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="cell size-x200" id="cell-sidebar" style="background-color: #71b1d1; height: 100%">
                    <ul class="sidebar">
                        <li><a href="#">
                            <span class="mif-apps icon"></span>
                            <span class="title">all items</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-vpn-publ icon"></span>
                            <span class="title">websites</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li class="active"><a href="#">
                            <span class="mif-drive-eta icon"></span>
                            <span class="title">Virtual machines</span>
                            <span class="counter">2</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-cloud icon"></span>
                            <span class="title">Cloud services</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-database icon"></span>
                            <span class="title">SQL Databases</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-cogs icon"></span>
                            <span class="title">Automation</span>
                            <span class="counter">0</span>
                        </a></li>
                        <li><a href="#">
                            <span class="mif-apps icon"></span>
                            <span class="title">all items</span>
                            <span class="counter">0</span>
                        </a></li>
                    </ul>
                </div>
                <div class="cell auto-size padding20 bg-white" id="cell-content">
                    <h1 class="text-light">Virtual machines <span class="mif-drive-eta place-right"></span></h1>
                    <hr class="thin bg-grayLighter">
                    <button class="button primary" onclick="pushMessage('info')"><span class="mif-plus"></span> Create...</button>
                    <button class="button success" onclick="pushMessage('success')"><span class="mif-play"></span> Start</button>
                    <button class="button warning" onclick="pushMessage('warning')"><span class="mif-loop2"></span> Restart</button>
                    <button class="button alert" onclick="pushMessage('alert')">Stop all machines</button>
                    <hr class="thin bg-grayLighter">
                    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
                        <thead>
                        <tr>
                            <td style="width: 20px">
                            </td>
                            <td class="sortable-column sort-asc" style="width: 100px">ID</td>
                            <td class="sortable-column">Machine name</td>
                            <td class="sortable-column">Address</td>
                            <td class="sortable-column" style="width: 20px">Status</td>
                            <td style="width: 20px">Switch</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <label class="input-control checkbox small-check no-margin">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                </label>
                            </td>
                            <td>123890723212</td>
                            <td>Machine number 1</td>
                            <td><a href="http://virtuals.com/machines/123890723212">link</a></td>
                            <td class="align-center"><span class="mif-checkmark fg-green"></span></td>
                            <td>
                                <label class="switch-original">
                                    <input type="checkbox" checked>
                                    <span class="check"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="input-control checkbox small-check no-margin">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                </label>
                            </td>
                            <td>123890723212</td>
                            <td>Machine number 2</td>
                            <td><a href="http://virtuals.com/machines/123890723212">link</a></td>
                            <td class="align-center"><span class="mif-stop fg-red"></span></td>
                            <td>
                                <label class="switch-original">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>