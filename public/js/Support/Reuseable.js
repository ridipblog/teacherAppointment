class Reuseable {
    constructor() {

    }

    // *** Process Status ***
    processingStatus = async (process_btn, process_type = "start", text = "Processing") => {
        $(process_btn).attr('disabled', process_type === "start" ? true : false);

        if (process_type === "start") {
            $(process_btn).html(
                `<div class="h-4 w-4 rounded-full border-2 border-white/50 relative inline-block">
                <div class="h-4 w-4 rounded-full border-t-2 border-l-2 z-10 -top-0.5 -left-0.5 border-white absolute inline-block animate-spin"></div>
            </div> ${text}`
            );
        } else {
            $(process_btn).html(text);
        }
    };

    // *** confirmation Swal ***
    confirmSwal = async ($message) => {
        return Swal.fire({
            title: 'Are you sure?',
            text: $message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563EB', // Tailwind blue-600
            cancelButtonColor: '#DC2626',  // Tailwind red-600
            confirmButtonText: 'Yes, allocate',
            cancelButtonText: 'Cancel'
        });

    }
}

export default Reuseable;
