
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<div id="loadingOverlay"></div>
<div id="loadingSpinner" style="display:none;">
    <img src="spinner.gif" alt="Loading...">
</div>
<script>
    $(document).ready(function() {
        // Initialize DataTable for the recruitment table
        $('#recruitmentTable').DataTable();

        // Set the timeout for 2 hours (2 * 60 * 60 * 1000 milliseconds)
        setTimeout(function() {
            location.reload();
        }, 2 * 60 * 60 * 1000);

        // Onclick event for active checkbox
        $('input[name="active"]').on('change', function() {
            var id = $(this).data('id');
            var active = $(this).is(':checked') ? 1 : 0;

            $('#loadingOverlay').show(); // Show the loading overlay

            $.ajax({
                url: 'updateActive.php',
                type: 'POST',
                data: { id: id, active: active },
                success: function(response) {
                    console.log('Update successful');
                    window.location.reload(); // Reload the page
                },
                error: function(xhr, status, error) {
                    console.error('Update failed: ' + error);
                },
                complete: function() {
                    $('#loadingOverlay').hide(); // Hide the loading overlay
                    $('#loadingSpinner').hide(); // Hide the loading spinner
                }
            });
        });

        // Onclick event for save button
        $('.saveButton').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $('#loadingSpinner').show(); // Show the loading spinner

            $.ajax({
                url: 'updateSaved.php',
                type: 'POST',
                data: { id: id, saved: 1 },
                success: function(response) {
                    console.log('Save successful');
                    window.location.reload(); // Reload the page
                },
                error: function(xhr, status, error) {
                    console.error('Save failed: ' + error);
                },
                complete: function() {
                    $('#loadingSpinner').hide(); // Hide the loading spinner
                }
            });
        });
    });
</script>
</body>
</html>