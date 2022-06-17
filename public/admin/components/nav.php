<div class="nav-div" title="Catalogs">
    <a style="color: gray;" href="dashboard.php">
        <div id="nav-item-library" class="nav-item">
            <i class="fa-solid fa-book-open-reader fs-24 "></i>
            <span class="nav-name fs-24 ps-3">Catalogs</span>
        </div>
    </a>

    <a href="addItem.php" title="Add Catalog">
        <div id="nav-item-addItem" class="nav-item ">
            <i class="fa-solid fa-book-open fs-24"></i>
            <span class="nav-name fs-24 ps-3">Add Catalog</span>
        </div>
    </a>
    <a href="reservations.php">
<!-- 
        <div class="nav-item" id="nav-item-reservations">
            <i class="fa-solid fa-swatchbook fs-24"></i>
            <span class="nav-name fs-24 ps-3">Reservations</span>
        </div> -->




        <div id="nav-item-reservations" class="nav-item position-relativ" style="display:flex ; align-items:center">
            <span style="width:auto ; position:relative; ">
                <i style="display: inline-block;" class="fa-solid fa-swatchbook position-relative fs-24"> </i>
                    <div id="pending_reservations">
                        
                    </div>
            </span>
            <span class="nav-name fs-24 ps-3 position-relative px-2" >
                Reservations
            </span>
        </div>
    </a>

    <a href="borrow.php">
        <div id="nav-item-borrow" class="nav-item position-relative">
            <i class="fa-solid fa-clone fs-24"></i>
            <span class="nav-name fs-24 ps-3 position-relative px-2">
                Borrow
            </span>
            
        </div>
    </a>


    <a href="../admin/pendingAccount.php" title="Pending Accounts">
        <div id="nav-item-pending" class="nav-item position-relativ" style="display:flex ; align-items:center">
            <span style="width:auto ; position:relative; ">
                <i style="display: inline-block;" class="fa-solid fa-person-circle-question position-relative fs-24"> </i>
                   <div id="pending_account_div">
                       
                    </div>
            </span>
            <span class="nav-name fs-24 ps-3 position-relative px-2" >
                Pending Account
            </span>
        </div>
    </a>

    <a href="../admin/accounts.php" title="Accounts">
        <div id="nav-item-approved" class="nav-item position-relativ" style="display:flex ; align-items:center">
            <span style="width:auto ; position:relative; ">
                <i style="display: inline-block;" class="fa-solid fa-user-group position-relative fs-24"> </i>
            </span>
            <span class="nav-name fs-24 ps-3 position-relative px-2" >
                Accounts
            </span>
        </div>
    </a>
</div>  

<!-- change reservation status to expired -->
<script>
    function reservation_check_expiration(){
        $.ajax({
            method:'POST',
            url: "../../actions.php",
            dataType: "text",
            data: {action:"check_reservation_date"},
            success: function (response){
                console.log(response);
            }
        });
    
    }

    setInterval(reservation_check_expiration,1000);
</script>

<!-- detect overdue on borrow -->
<script>
    function reservation_check_expiration(){
        $.ajax({
            method:'POST',
            url: "../../actions.php",
            dataType: "text",
            data: {action:"check_overdue_borrow"},
            success: function (response){
            }
        });
    }
    
    setInterval(reservation_check_expiration,1000);
</script>

<!-- detect new pending account  -->
<script>
    function check_pending_accounnts(){
        $.ajax({
            method:'POST',
            url: "../../actions.php",
            dataType: "text",
            data: {action:"check_pending_account"},
            success: function (response){
                document.getElementById("pending_account_div").innerHTML = response;
            }
        });
    }
    
    setInterval(check_pending_accounnts,250);
</script>


<!-- detect new pending reservations  -->
<script>
    function check_pending_accounnts(){
        $.ajax({
            method:'POST',
            url: "../../actions.php",
            dataType: "text",
            data: {action:"check_pending_reservations"},
            success: function (response){
                document.getElementById("pending_reservations").innerHTML = response;
            }
        });
    }
    
    setInterval(check_pending_accounnts,250);
</script>