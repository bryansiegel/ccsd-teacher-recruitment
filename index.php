<?php //TODO: NEED TO COMBINE rssFetch and insert into one file and fix the includes ?>


<?php include('includes/head.php'); ?>

<?php include('includes/rssFetch.php'); ?>

<?php include('includes/header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <table id="recruitmentTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Active?</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Published</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var TYPE_NAME $rss */
                //have all rss items go into sqlite db
                foreach ($rss as $item) { ?>

                    <?php if (!empty($item->published)) {
                        $pubDate = date("F j, Y, g:i a", strtotime($item->published)); ?>

                        <?php include('includes/db/insert.php'); ?>

                        <tr>
                            <td><input type="checkbox" name="remove" checked/></td>
                            <td><a href='<?php echo $item->link['href']; ?>'><?php echo $item->title; ?></a></td>
                            <td><?php echo $item->content ?></td>
                            <td><?php echo $pubDate ?></td>

                            <td><a href="" class="btn btn-primary">Save</a></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>


            </table>
        </div>
    </div>
</div> <!-- /.container -->

<?php include('includes/footer.php') ?>



