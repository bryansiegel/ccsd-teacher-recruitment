<?php //TODO: NEED TO COMBINE rssFetch and insert into one file and fix the includes
//page refresh every 2 hours ?>

<?php include('includes/head.php'); ?>
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


                   <?php include('includes/rssFetchDbInsert.php') ?>
                   <?php // Fetch data from the database to display in the table
                   //@var $db SQLite3 database connection

                   $results = $db->query("SELECT * FROM teacherRecruitment");
                   while ($row = $results->fetchArray(SQLITE3_ASSOC)) { ?>
                        <tr>
                        <td><input type='checkbox' name='remove' checked/></td>
                        <td><a href='<?php echo $row['link']; ?>'><?php echo $row['title']; ?></a></td>
                        <td><?php echo $row['content']; ?></td>
                        <td><?php echo $row['published'] ?></td>
                        <td><a href='' class='btn btn-primary'>Save</a></td>
                        </tr>


                    <?php }

                    // Close the database connection
                    $db->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- /.container -->

<?php include('includes/footer.php') ?>