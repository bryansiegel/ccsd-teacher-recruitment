<?php include('includes/head.php'); ?>
<?php include('includes/header.php'); ?>
    <div class="container">
        <?php echo date("now"); ?>
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

                    /** @var $db */
                    $results = $db->query("SELECT * FROM teacherRecruitment WHERE active = 1 ORDER BY published ASC");

                    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                        $publishedDate = date("F j, Y, g:i a", strtotime($row['published']));
                        ?>
                        <tr>
                            <td><label for="active"></label><input id="active" type='checkbox' name='active' data-id='<?php echo $row['id']; ?>' checked/></td>
                            <td><a href='<?php echo $row['link']; ?>'><?php echo $row['title']; ?></a></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $publishedDate ?></td>
                            <?php if ($row['saved'] == 1) { ?><td><a href='#' class='btn btn-success saveButton' data-id='<?php echo $row['id']; ?>'>Saved</a></td>
                            <?php } else { ?>
                                <td><a href='#' class='btn btn-primary saveButton' data-id='<?php echo $row['id']; ?>'>Save</a></td>
                                <?php
                            } ?>
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