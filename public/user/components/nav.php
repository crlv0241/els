
<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color: var(--primary) ;">
        <div class="container" style="display: flex; justify-content:space-between;" >
            <a style="text-decoration: none; color: white" >
                <img style="padding:2px; margin-right:1rem; background:white; border-radius:50% " width="50" src="../../images/system/logo.png" alt="">
                GMATHS LIBRARY SYSTEM    
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse1">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse1" style="justify-content:flex-end; ">
                <div class="navbar-nav" >
                    <a href="catalogs.php" class="nav-item-catalogs nav-link">Catalogs</a>
                    <a href="bookmark.php" class="nav-item-bookmarks nav-link position-relative">Bookmarks</a>

           

                    <a href="reservations.php" class="nav-item-reservations nav-link" >
                        <span  class=" position-relative">
                        Reservations
                            <div id="reservation_notif">

                            </div>
                        </span>
                    </a>
                    <a href="./uborrow.php" class="nav-item-borrowed nav-link">
                        <span  class=" position-relative">
                        Borrowed
                            <div id="borrowed_notif">

                            </div>
                        </span>
                        
                    </a>
                    <hr class="nav-divider">
                    <a class="nav-item-borrowed nav-link" href="profile.php">Account</a>
                    <a  class="nav-item-borrowed nav-link" href="./logout.php">Sign out <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </div>
        </div>
    </nav>`

    <!-- COUNT THE NUMBERS OF RESERVATIONS -->
    <script>
        setInterval(
            function(){
                $.ajax({
                    method : "POST",
                    url: "../../actions.php",
                    data: {action : "user_reservation_notifcation_count"},
                    success: function (response){
                        document.getElementById("reservation_notif").innerHTML = response;
                    }
                });
            }
            ,250)
    </script>

    <!-- COUNT THE NUMBERS OF BORROW  -->
    <script>
        setInterval(
            function(){
                $.ajax({
                    method : "POST",
                    url: "../../actions.php",
                    data: {action : "user_borrow_notifcation_count"},
                    success: function (response){
                        document.getElementById("borrowed_notif").innerHTML = response;
                    }
                });
            }
            ,250)
    </script>