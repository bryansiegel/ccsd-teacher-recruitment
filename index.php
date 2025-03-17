<?php include('includes/head.php'); ?>

<?php include('includes/rssFetch.php'); ?>

<?php include('includes/header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col">

            <table id="recruitmentTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Remove?</th>
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

                    <?php if (!empty($item->published)) { ?>

                            <?php
                        $pubDate = date("F j, Y, g:i a", strtotime($item->published));


                        //sqlite3 db connection
                        $db = new SQLite3('teacherRecruitment.db');

                        // Create table if it doesn't exist
                        $db->exec("CREATE TABLE IF NOT EXISTS teacherRecruitment (id INTEGER PRIMARY KEY, title TEXT UNIQUE, content TEXT UNIQUE, published TEXT, link TEXT UNIQUE)");

                        //prepare
                        $stmt = $db->prepare("INSERT OR IGNORE INTO teacherRecruitment (title, content, published, link) VALUES (:title, :content, :published, :link)");

                        //bind params
                        $stmt->bindParam(':title', $item->title, SQLITE3_TEXT);
                        $stmt->bindParam(':content', $item->content, SQLITE3_TEXT);
                        $stmt->bindParam(':published', $pubDate, SQLITE3_TEXT);
                        $stmt->bindParam(':link', $item->link['href'], SQLITE3_TEXT);

                        $result = $stmt->execute();

//                        if ($result) {
//                            echo "Data inserted successfully.";
//                        } else {
//                            echo "Error inserting data: " . $db->lastErrorMsg();
//                        }

                        //close db
                        $db->close();
                        ?>

                        <tr>
                            <td><input type="checkbox" name="remove"/></td>
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



