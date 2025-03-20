<div class="container pt-5 pb-3">
    <div class="row">
        <div class="col">
            <h1 class="text-center pb-5">CCSD Teacher Recruitment Application</h1>
            <hr/>
            <?php
            $currentUri = $_SERVER['REQUEST_URI'];
            if ($currentUri == '/ccsd-teacher-recruitment/saved.php') {
                ?><ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/ccsd-teacher-recruitment/">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ccsd-teacher-recruitment/today.php">Today</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/ccsd-teacher-recruitment/saved.php">Saved</a>
                    </li>
                </ul>
                <a href="exportToExcel.php" class="btn btn-success float-end" style="margin-top: -40px">Export to Excel</a>

            <?php } elseif ($currentUri == '/ccsd-teacher-recruitment/') { ?>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/ccsd-teacher-recruitment/">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ccsd-teacher-recruitment/today.php">Today</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ccsd-teacher-recruitment/saved.php">Saved</a>
                    </li>
                </ul>
                <a href="exportToExcel.php" class="btn btn-success float-end" style="margin-top: -40px">Export to Excel</a>

            <?php } elseif ($currentUri == '/ccsd-teacher-recruitment/today.php') { ?>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/ccsd-teacher-recruitment/">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/ccsd-teacher-recruitment/today.php">Today</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ccsd-teacher-recruitment/saved.php">Saved</a>
                    </li>
                </ul>
                <a href="exportToExcel.php" class="btn btn-success float-end" style="margin-top: -40px">Export to Excel</a>

            <?php } ?>
            <hr/>
        </div>
    </div>


</div>