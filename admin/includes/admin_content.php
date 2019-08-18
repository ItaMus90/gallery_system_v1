<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                ADMIN
                <small>Subheading</small>
            </h1>
            <?php

                $user = new User();
                $result = $user->get_users();


                while ($row = mysqli_fetch_array($result)){

                    print_r($row);
                    echo "<br>";

                }

                $result = $user->get_user_by_id(1);
                print_r($result);

            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->