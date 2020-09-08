<?php

    define('DB_NAME','D:\xampp\htdocs\demo\phpcrud\data\data.txt');

    function seed() {

        // data create
        $data = array(
            array(
                'id'=> 1,
                'fname'=> 'Jubayer',
                'lname'=> 'Alam',
                'profession'=> 'Web Developer',
                'employee_id'=>1
            ),
            array(
                'id'=> 2,
                'fname'=> 'Shzu',
                'lname'=> 'Ahmed',
                'profession'=> 'UI/UX Designer',
                'employee_id'=>2
            ),
            array(
                'id'=> 3,
                'fname'=> 'Rashed',
                'lname'=> 'Ahmed',
                'profession'=> 'UI/UX Designer',
                'employee_id'=>3
            ),
            array(
                'id'=> 4,
                'fname'=> 'Tanveerul',
                'lname'=> 'Islam',
                'profession'=> 'Web Developer',
                'employee_id'=>4
            ),
            array(
                'id'=> 5,
                'fname'=> 'Ohidul',
                'lname'=> 'Islam',
                'profession'=> 'SEO',
                'employee_id'=>5
            )
        );

        // convert Associative Array to serialize
        $serializeData = serialize($data);

        // data store in data.txt file
        file_put_contents(DB_NAME,$serializeData,LOCK_EX);

    }

    // all data get
    function generateReport(){

        // serialize data load
        $serializedData = file_get_contents(DB_NAME);

        // convert serialize to unserialize
        $students = unserialize($serializedData);

        ?>

        <table>

            <tr>
                <th>Name</th>
                <th>Profession</th>
                <th>Employee Id</th>
                <th>Action</th>
            </tr>

            <?php foreach($students as $student) { ?>

            <tr>
                <td> <?php printf('%s %s',$student['fname'],$student['lname']) ?> </td>
                <td> <?php printf('%s',$student['profession']) ?> </td>
                <td> <?php printf('%s',$student['employee_id']) ?> </td>
                <td> 
                    <?php 
                        printf('<a href="index.php?task=edit&id=%s">Edit</a> | <a href="index.php?task=delete&id=%s">Delete</a>',$student['id'],$student['id']) 
                    ?> 
                </td>
            </tr>

            <?php  } ?>

        </table>

    <?php

    }

    function addStudent($fname,$lname,$profession,$employee_id) {
        
        $found = false;
        $serializedData = file_get_contents(DB_NAME);
        $students = unserialize($serializedData);

        foreach($students as $_student) {
            if($_student['employee_id'] == $employee_id) {
                $found = true;
                break;
            }
        }

        if(!$found) {
            $newId = count($students) + 1;

            $student = array(
                'id'=> $newId,
                'fname'=> $fname,
                'lname'=> $lname,
                'profession' => $profession,
                'employee_id'=> $employee_id
            );

            array_push($students,$student);

            $serializeData = serialize($students);
            file_put_contents(DB_NAME,$serializeData,LOCK_EX);
            return true;
        }

        return false;
        
    }

    function get_student($id) {
        $serializeData = file_get_contents(DB_NAME);
        $students = unserialize($serializeData);

        foreach($students as $student) {
            if($student['id'] == $id) {
                return $student;
            }
        }

        return false;
    }