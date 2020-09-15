<div>
    <div class="float-left">        
        <p>
            <a href="index.php?task=report">All Student</a> |
            <a href="index.php?task=add">Add</a> |
            <a href="index.php?task=seed">Seed</a>
        </p>
    </div>
    <div class="float-right">
        <?php if( isset($_SESSION['login']) == false ): ?>  
            <a href='auth.php'>Login</a>
        <?php else: ?>
            <a href='auth.php?logout=true'>Logout </a>
        <?php endif; ?>
        
    </div>
    <p></p>
</div>