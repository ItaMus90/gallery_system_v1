<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                ADMIN
                <small>Subheading</small>
            </h1>
            <?php

//                $user = User::get_user_by_id(6);
//
//                $user->delete();

//
//                  $user = User::get_user_by_id(5);
//
//                  $user->username = "Borkez";
//
//                  $user->save();

                $user = new User();

                $user->username = "Abstarct";
                $user->password = "Qq1234";
                $user->first_name = "Abs";
                $user->last_name = "Tract";

                $user->create();


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