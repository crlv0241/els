<div class="main-header ">
    <div class="logo-wrapper">
        <img src="/els/images/system/logo.png" alt="">
    </div>

    <div class="system-name-wrapper">
        <h1 class="fs-24 bold fc-white">GMATHS LIBRARY SYSTEM</h1>
    </div>

    <!-- Example single danger button -->
    <div class="profile-wrapper">
        <div class="btn-group">
            <div data-bs-toggle="dropdown" >
                <div class="profile-image-wrapper">
                    <?php if ( isset( $client['image']  )): ?>
                        <img src=" <?php echo $client['image'] ?>">
                    <?php endif; ?>
                </div>
            </div>
            
            <ul class="dropdown-menu mt-2">
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="./login.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <i id="nav-toggler" class="fa-solid fa-bars"></i>        
        
    
</div>