<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="pt-4">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="" class="navbar-brand"></a>
            
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                <li class="navbar-item mx-4">
    <button type="button" class="btn btn-dark position-relative">
        <i class="bi bi-bell text-white"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            99+
            <span class="visually-hidden">unread messages</span>
        </span>
    </button>
</li>

                    <li class="navbar-item mx-1">
                        <img style="border:3px solid rgb(8, 90, 8);width: 40px; height: 40px;border-radius: 50%;" src="./img/usuario.png" alt="">
                    </li>
                    <li class="navbar-item dropdown">
                        <a href="" class="nav-link dropdown-toggle text-white" 
                            id="userDropdown" role="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php 
                            if (isset($_SESSION['user_data'])) {
                                echo $_SESSION['user_data']['name'] . ' ' . $_SESSION['user_data']['last_name'];
                            } else {
                                echo "Usuario no disponible";
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark text-white" aria-labelledby="userDropdown">
                           <li>
                             <a href="" class="dropdown-item text-white"> 
                           <i class="bi bi-person"></i> 
                                     Perfil
                                      </a>
                           </li>
                           <li>
                        <hr class="dropdown-divider" />
                           </li>
                           <li>
                           <a href="login.php" class="dropdown-item text-white">
                             <i class="bi bi-box-arrow-left"></i>
                             Cerrar Sesión
                               </a>
                             </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

