<div>
    <div class="float-left">        
        <p>
            <a href="index.php?task=report">All Student</a> |
            <a href="index.php?task=add">Add</a> |
            <a href="index.php?task=seed">Seed</a>
        </p>
    </div>
    <div class="float-right">
        <?php 
            if( isset($_SESSION['login']) == false) {
                echo "<a href='/auth.php'>Login</a>";
            }
            else {
                echo "<a href='/auth.php?logout=true'>Logout </a>";
            }
        ?>
        
    </div>
</div>