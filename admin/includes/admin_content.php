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
//                  $users = User::get_all();
//
//                  print_r($users);

                $user = new User();

                $user->username = "StaticDB";
                $user->password = "Qq1234";
                $user->first_name = "StaDB";
                $user->last_name = "TicDB";

                $user->save();


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