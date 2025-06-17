import OperatorSupport from "./OperatorSupport.js";

const operatorSupportObj = new OperatorSupport();

$(document).ready(function () {
    $('#vacancyTable').DataTable({
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records..."
        }
    });

    $('#vacancyTable2').DataTable({
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records..."
        }
    });

    // *** Allocate Process ***
    $(document).on('submit', '#allocate-form', async function (e) {
        try {
            e.preventDefault();
            operatorSupportObj.allocateVacency('#allocate-form');
        } catch (error) {
            Swal.fire("Initialized error execute!");
        }
    })

});
