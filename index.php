<?php include("includes/header.php"); ?>

<?php


    $page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1;

    $items_per_page = 4;

    $items_total_count = Photo::count_all();

    $paginate = new Paginate($page, $items_per_page, $items_total_count);

    $offset = $paginate->offset();

    $sql  = "SELECT * FROM photos ";
    $sql .= "LIMIT " . $items_per_page . " ";
    $sql .= "OFFSET " . $offset;

    $photos = Photo::query($sql);



?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                <div class="thumbnail row">

                    <?php foreach ($photos as $photo): ?>

                            <div class="col-xs-6 col-md-3">

                                <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">

                                    <img src="admin/<?php echo $photo->get_images_path() ?>" class="photo-thumbnail" alt="">

                                </a>
                            </div>




                    <?php endforeach; ?>

                </div><!--thumbnail row -->


                <div class="row">
                    <ul class="pager">

                        <?php

                            if ($paginate->page_total() > 1) {

                                if ($paginate->has_next()) {

                                    echo "<li class='next'><a href='index.php?page=".$paginate->next()."'>Next</a></li>";

                                }

                                if ($paginate->has_previous()) {

                                    echo "<li class='previous'><a href='index.php?page=".$paginate->previous()."'>Previous</a></li>";

                                }


                            }

                        ?>


                    </ul>
                </div>

            </div>




            <!-- Blog Sidebar Widgets Column -->
<!--            <div class="col-md-4">-->

            
                 <?php //include("includes/sidebar.php"); ?>



<!--        </div>-->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
