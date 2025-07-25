$(document).ready(function () {
    $('#reportPage').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            }
        ],
        responsive: true,
        pageLength: 10,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records..."
        }
    });
});
