<?php 
    require_once('inc/functions.php');
?>

<div>
    <div class="float-left">        
        <p>
            <a href="index.php?task=report">All Student</a> 

            <?php if( hasPrivilege() ): ?>
            | <a href="index.php?task=add">Add</a> 
            <?php endif; ?>

            <?php if(isAdmin()): ?>
            | <a href="index.php?task=seed">Seed</a>
            <?php endif; ?>
        </p>
    </div>
    <div class="float-right">
        <?php if( isset($_SESSION['login']) == false ): ?>  
            <a href='auth.php'>Login</a>
        <?php else: ?>
            <a href='auth.php?logout=true'>
                Logout ( <?php echo $_SESSION['roll']; ?> )
            </a>
        <?php endif; ?>
        
    </div>
    <p></p>
</div>