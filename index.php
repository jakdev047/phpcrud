<?php 

    // session start
    session_start([
        'cookie_lifetime'=> 300
    ]);
    
    require_once('inc/functions.php');

    // seed function exicutive 
    $info = '';
    $task = $_GET['task'] ?? 'report'; // url task="seed"
    $error = $_GET['error'] ?? '0'; 

    // url mode
    if('seed' == $task){
        seed();
        $info = "Seeding is Complete...";
    }

    // delete url
    if('delete' == $task) {
        $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
        if($id > 0) {
            deleteStudent($id);
            header('location:index.php?task=report');
        }
    }

    $fname ='';
    $lname = '';
    $profession = '';
    $employee_id = '';

    // add function
    if(isset($_POST['submit'])) {
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
        $fname = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
        $fname = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
        $lname = filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
        $profession = filter_input(INPUT_POST,'profession',FILTER_SANITIZE_STRING);
        $employee_id = filter_input(INPUT_POST,'employee_id',FILTER_SANITIZE_STRING);

        if($id) {
            // update employee
            if( $fname != '' && $lname != '' && $profession != '' &&  $employee_id != '') {
                $result = updateStudent($id,$fname,$lname,$profession,$employee_id);
                if($result) {
                    header('location:index.php?task=report');
                }
                else{
                    $error = 1;
                }
            }
        }
        else {
            // add a new employee
            if( $fname != '' && $lname != '' && $profession != '' &&  $employee_id != '') {
                $result = addStudent($fname,$lname,$profession,$employee_id);
                if($result) {
                    header('location:index.php?task=report');
                }
                else{
                    $error = 1;
                }
            }
        }

        
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP CRUD</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.0/milligram.css">

        <style>
            body{margin-top: 30px;}
        </style>

    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="column column-60 column-offset-20">
                    <h2>CRUD</h2>
                    <p>
                        A simple project to perform CRUD oparations using plain files and PHP
                    </p>
                    <?php include_once('inc/templates/nav.php') ?>

                    <?php 
                        if($info != '') {
                            echo "<p>{$info}</p>";
                        }
                    ?>

                    <?php if('1' == $error) { ?>

                    <div class="row">
                        <div class="column">
                            <blockquote>Employee Id Duplicate</blockquote>
                        </div>
                    </div>

                    <?php } ?>

                    <?php if('report' == $task) { ?>

                        <div class="row">
                            <div class="column">
                                <?php generateReport() ?>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if('add' == $task) { ?>

                        <div class="row">
                            <div class="column column-60 ">
                                <form action="index.php?task=add" method="POST">

                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>">

                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>">

                                    <label for="profession">Profession</label>
                                    <input type="text" id="profession" name="profession" value="<?php echo $profession; ?>">

                                    <label for="employee_id">Employee ID</label>
                                    <input type="number" id="employee_id" name="employee_id" value="<?php echo $employee_id; ?>">

                                    <button type="submit" name="submit" class="button-primary">Submit</button>
                                </form>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if('edit' == $task): 

                        $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
                        $student = get_student($id);
                        
                        if($student):

                    ?>

                        <div class="row">
                            <div class="column column-60 ">
                                <form  method="POST">

                                    <input type="hidden" value="<?php echo $id; ?>" name="id">

                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" value="<?php echo $student['fname']; ?>">

                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" value="<?php echo $student['lname']; ?>">

                                    <label for="profession">Profession</label>
                                    <input type="text" id="profession" name="profession" value="<?php echo $student['profession']; ?>">

                                    <label for="employee_id">Employee ID</label>
                                    <input type="number" id="employee_id" name="employee_id" value="<?php echo $student['employee_id']; ?>">

                                    <button type="submit" name="submit" class="button-primary">Update</button>
                                </form>
                            </div>
                        </div>

                    <?php  
                        endif;
                        endif;
                    ?>

                </div>
            </div>
        </div>

        <script src="assets/js/app.js"></script>
    </body>

</html>