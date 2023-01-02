<?php
            $q = intval($_GET['q']);
           include('db_connect.php');

            $sql="SELECT facilitators.id as facilitator_id, facilitators.email, programme.course FROM facilitators INNER JOIN programme on facilitators.programme_id=programme.id where facilitators.programme_id='".$q."' ORDER BY RAND() LIMIT 1;";
            
            $result = mysqli_query($conn,$sql);
            if($row = mysqli_fetch_array($result)) {

    echo '<input type="hidden" name="facilitator_id" id="facilitator_id" value="'.$row['facilitator_id'].'" readonly>';
    echo '<input type="hidden" name="facilitator_email" id="facilitator_email" value="'.$row['email'].'" readonly>'; 
    echo '<input type="hidden" name="title" id="title" value="'.$row['course'].'" readonly>';

            } else {
                echo "<i>No facilitator for selected programme</i>";
            }
            mysqli_close($conn);
 ?>
