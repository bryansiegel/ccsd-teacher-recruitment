<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

<script>
    // Initialize DataTable for the recruitment table
    $(document).ready( function () {
        $('#recruitmentTable').DataTable();
    } );
</script>
<script>
    //refresh page every 2 hours
    $(document).ready(function() {
        // Set the timeout for 2 hours (2 * 60 * 60 * 1000 milliseconds)
        setTimeout(function() {
            location.reload();
        }, 2 * 60 * 60 * 1000);
    });
</script>

</body>
</html>