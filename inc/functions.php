<?php

    define('DB_NAME','D:\xampp\htdocs\demo\phpcrud\data\data.txt');

    function seed() {

        // data create
        $data = array(
            array(
                'id'=> 1,
                'fname'=> 'Jubayer',
                'lname'=> 'Alam',
                'profession'=> 'Web Developer'
            ),
            array(
                'id'=> 2,
                'fname'=> 'Shzu',
                'lname'=> 'Ahmed',
                'profession'=> 'UI/UX Designer'
            ),
            array(
                'id'=> 3,
                'fname'=> 'Rashed',
                'lname'=> 'Ahmed',
                'profession'=> 'UI/UX Designer'
            ),
            array(
                'id'=> 4,
                'fname'=> 'Tanveerul',
                'lname'=> 'Islam',
                'profession'=> 'Web Developer'
            ),
            array(
                'id'=> 5,
                'fname'=> 'Ohidul',
                'lname'=> 'Islam',
                'profession'=> 'SEO'
            ),
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
                <th>Action</th>
            </tr>

            <?php foreach($students as $student) { ?>

            <tr>
                <td> <?php printf('%s %s',$student['fname'],$student['lname']) ?> </td>
                <td> <?php printf('%s',$student['profession']) ?> </td>
                <td> <a href="#">Edit</a> |  <a href="#">Delete</a> </td>
            </tr>

            <?php  } ?>

        </table>

    <?php

    }