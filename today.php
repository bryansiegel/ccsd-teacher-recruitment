<?php
include('includes/head.php');
include('includes/header.php');

// SQLite3 db connection
$db = new SQLite3('teacherRecruitment.db');

// Get today's date
$today = date("F j, Y");
?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Today's Records</h2>
                <table id="todayTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Active?</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Published</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Fetch data from the database where published date is today
                    $stmt = $db->prepare("SELECT * FROM teacherRecruitment WHERE published LIKE :today AND active = 1 ORDER BY published DESC");
                    $stmt->bindValue(':today', '%' . $today . '%', SQLITE3_TEXT);
                    $results = $stmt->execute();

                    while ($row = $results->fetchArray(SQLITE3_ASSOC)) { ?>
                        <tr>
                            <td><input id="active" type='checkbox' name='active' data-id='<?php echo $row['id']; ?>' <?php echo $row['active'] ? 'checked' : ''; ?>/></td>
                            <td><a href='<?php echo $row['link']; ?>'><?php echo $row['title']; ?></a></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $row['published'] ?></td>
                        </tr>
                        <?php
                    }
                    // Close the database connection
                    $db->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- /.container -->

<?php include('includes/footer.php'); ?>