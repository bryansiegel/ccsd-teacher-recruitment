<?php
// TODO: ONLY SHOW SAVED AND ACTIVE
// TODO: ADD ACTIVE COLUMN REFRESH

include('includes/header.php');

// SQLite3 db connection
$db = new SQLite3('teacherRecruitment.db');
?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Saved Records</h2>
                <table id="savedTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Published</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Fetch data from the database where saved = 1
                    $results = $db->query("SELECT * FROM teacherRecruitment WHERE saved = 1");

                    while ($row = $results->fetchArray(SQLITE3_ASSOC)) { ?>
                        <tr>
                            <td><a href='<?php echo $row['link']; ?>'><?php echo $row['title']; ?></a></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $row['published']; ?></td>
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

<?php include('includes/footer.php'); ?>