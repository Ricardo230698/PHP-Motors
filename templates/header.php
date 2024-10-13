<header>

    <span id="logo">
        <img src="/phpmotors/images/site/logo.png" alt="logo">        
        <?php            
            if(isset($_SESSION['loggedin'])) {                
                echo "<a href='/phpmotors/accounts/'>WELCOME ".$_SESSION['clientData']['clientFirstname']."</a>";
                echo "<a id='account' href='/phpmotors/accounts/index.php?action=Logout'>Logout</a>";
            } else {
                echo "<a id='account' href='/phpmotors/accounts/index.php?action=login'>My Account</a>";
            }
        ?>
    </span>

    <form action="/phpmotors/searches/" method="post" style="display:flex; flex-direction:row; justify-content:space-evenly;">
        <label for="userSearch">Search</label>
        <input type="text" id="userSearch" name="userSearch" placeholder="Type here to search">
        <input type="submit" value="🔍" style="width:auto;">

        <!-- The hidden input -->
        <input type="hidden" name="action" value="search">
        <input type="hidden" name="page" value="1">
    </form>

</header>