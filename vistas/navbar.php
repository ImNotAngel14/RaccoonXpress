<?php
function printNavbar($user_id)
{
    echo "
    <div class='row align-items-center general_navbar py-1'>
        <div class='col-0 col-md-2  d-none d-md-block d-lg-block d-xl-block'>
            <a class='navbar-brand d-flex justify-content-center' href='../index.php'>
                <img src='images/Imagotipo.png' alt='' height='30 rem'>
            </a>
        </div>
        <div class='col-md-8 col-8'>
            <form class='' method='get' action='buscador.php'>
                <div class='input-group'>
                    <input class='form-control' type='search' placeholder='Buscar...' aria-label='Search' id='id_search' name='search'>
                    <div class='input-group-append'>
                        <button id='id_navbar_search' class='btn' type='submit' style='background-color: white; border-left: white; border-color: #ced4da;'>
                            <i class='fa fa-search' aria-hidden='true'></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class='col-md-12'>
            <nav class='navbar navbar-expand-md navbar-light '>
                <div class='container-fluid justify-content-center'>
                    <div class='flex-row'>
                        <button class='navbar-toggler col' type='button' data-bs-toggle='collapse'
                            data-bs-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false'
                            aria-label='Toggle navigation'>
                            <span class='navbar-toggler-icon'></span>
                        </button>
                        <div class='collapse navbar-collapse' id='navbarNavDropdown'>
                            <ul class='navbar-nav'>
                                <li class='nav-item'>
                                    <a class='nav-link' aria-current='page' href='profileRedirection.php?profile=". $user_id . "'>Perfil</a>
                                </li>
    
                                <li class='nav-item'>
                                    <a class='nav-link' aria-current='page' href='#'>Mis compras</a>
                                </li>
    
                                <li class='nav-item' id='wishLists'>
                                    <a class='nav-link' aria-current='page' href='lists.php'>Mis listas</a>
                                </li>
    
                                <li class='nav-item' id='shoppingCart'>
                                    <a class='nav-link' aria-current='page' href='shopping_cart.php'>Carrito de compras</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    ";
    return;
}
?>