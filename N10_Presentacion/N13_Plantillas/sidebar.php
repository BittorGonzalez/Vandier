<?php

require_once 'N00_Config\app.php';

?>


<ul class="navbar-nav bg-white sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href=<?php echo APP_URL ?>>
                <img class="mt-4" src="N10_Presentacion\N14_Assets\Images\logo.png" width="80em" alt="">
            </a>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item mt-5">
                <a class="nav-link text-dark" href="<?php echo APP_URL?>/dashboard">
                    <i class="fa-solid fa-chart-line text-dark fs-4"></i>
                    <span class="fs-5 fw-bold ms-2">Balance</span>
                </a>
            </li>

            <!-- Nav Item - Productos -->
            <li class="nav-item mt-3">
                <a class="nav-link text-dark" href="<?php echo APP_URL?>/productos" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-box text-dark fs-4"></i>
                    <span class="fs-5 fw-bold ms-2">Productos</span>
                </a>
            </li>

            <!-- Nav Item - Pedidos -->
            <li class="nav-item mt-3">
                <a class="nav-link text-dark" href="<?php echo APP_URL?>/pedidos" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-cart-shopping text-dark fs-4"></i>
                    <span class="fs-5 fw-bold ms-2" >Pedidos</span>
                </a>
            </li>

            <!-- Nav Item - Usuarios -->
            <li class="nav-item mt-3">
                <a class="nav-link text-dark" href="<?php echo APP_URL?>/usuarios" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-user text-dark fs-4"></i>
                    <span class="fs-5 fw-bold ms-2">Usuarios</span>
                </a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item mt-3">
                <a class="nav-link text-dark" href="<?php echo APP_URL?>/descuentos">
                    <i class="fa-solid fa-tags text-dark fs-4"></i>
                    <span class="fs-5 fw-bold ms-2">Descuentos</span></a>
            </li>

        </ul>