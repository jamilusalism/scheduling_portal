
        <?php
            $q = intval($_GET['q']);

            $con = mysqli_connect('localhost','root','root','scheduling_db');
            if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
            }

            $sql="SELECT facilitators.id as facilitator_id, programme.course FROM facilitators INNER JOIN programme on facilitators.programme_id=programme.id where facilitators.programme_id='".$q."' ORDER BY RAND() LIMIT 1;";
            
            $result = mysqli_query($con,$sql);
            if($row = mysqli_fetch_array($result)) {

            echo 'Fac.ID <input type="text" name="facilitator_id" id="facilitator_id" value="'.$row['facilitator_id'].'" placeholder="Tutor ID" readonly>';
            echo 'Prog. <input type="text" name="title" id="title" value="'.$row['course'].'" placeholder="programme title"  readonly>';

            } else {
                echo "<i>No facilitator for selected programme</i>";
            }
            mysqli_close($con);
        ?>
