import RequestSupport from "../Support/RequestSupport.js";
import Reuseable from "../Support/Reuseable.js";
const reuseableObj = new Reuseable();
class AdminSupport extends RequestSupport {
    constructor() {
        super();
    }

    // *** Add and update school vacecny details ***
    addSchoolVacency = async (form, actionBtn, requestType) => {
        try {
            reuseableObj.processingStatus(actionBtn);
            var form_data = new FormData($(form)[0]);
            form_data.append('requestType', requestType);
            this.formPostReponse = async (response) => {
                if (response?.resData?.statusCode == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response?.resData?.message,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });

                } else if (response?.resData?.statusCode == 400) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Success',
                        text: response?.resData?.message,
                        confirmButtonText: 'OK'
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Success',
                        text: "Something went wrong",
                        confirmButtonText: 'OK'
                    });
                }
            }
            await this.formPost(form_data, '/admin/add-school-vacency-post');
            reuseableObj.processingStatus(actionBtn, 'end', 'Submit Vacancy Information');

        } catch (error) {
            console.log(error);
            reuseableObj.processingStatus(actionBtn, 'end', 'Submit Vacancy Information');
            Swal.fire("Server error please try later !");
        }
    }

    // *** Delete vacency details row ***
    deleteVacencyDetailsRow = async (actionBtn) => {
        try {
            reuseableObj.processingStatus(actionBtn);
            let confirm = await reuseableObj.confirmSwal("Are you sure you want to delete?");
            if (confirm.isConfirmed) {

                var form_data = new FormData();
                let schoolCodeId = $('#school-code-id').val();
                let vacencyRowId = actionBtn.val();
                form_data.append('schoolCodeId', schoolCodeId);
                form_data.append('vacencyRowId', vacencyRowId);

                this.formPostReponse = async (response) => {
                    if (response?.resData?.statusCode == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response?.resData?.message,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });

                    } else if (response?.resData?.statusCode == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Success',
                            text: response?.resData?.message,
                            confirmButtonText: 'OK'
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Success',
                            text: "Something went wrong",
                            confirmButtonText: 'OK'
                        });
                    }
                }
                await this.formPost(form_data, '/admin/delete-vacency-row');
            }
            reuseableObj.processingStatus(actionBtn, 'end', `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7L5 7M6 7L6 19a2 2 0 002 2h8a2 2 0 002-2V7M10 11v6m4-6v6M9 7V4h6v3" />
                </svg>
                Delete`);

        } catch (error) {
            reuseableObj.processingStatus(actionBtn, 'end', `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M19 7L5 7M6 7L6 19a2 2 0 002 2h8a2 2 0 002-2V7M10 11v6m4-6v6M9 7V4h6v3" />
                </svg>
                Delete`);
            Swal.fire("Server error please try later !");
        }
    }

    // *** Delete school details ***
    deleteSchoolDetails = async (actionBtn) => {
        try {
            reuseableObj.processingStatus(actionBtn);
            let confirm = await reuseableObj.confirmSwal("Are you sure you want to delete?");
            if (confirm.isConfirmed) {

                var form_data = new FormData();
                let schoolCodeId = $('#school-code-id').val();
                form_data.append('schoolCodeId', schoolCodeId);

                this.formPostReponse = async (response) => {
                    if (response?.resData?.statusCode == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response?.resData?.message,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });

                    } else if (response?.resData?.statusCode == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Success',
                            text: response?.resData?.message,
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Success',
                            text: "Something went wrong",
                            confirmButtonText: 'OK'
                        });
                    }
                }
                await this.formPost(form_data, '/admin/delete-school-details');
            }
            reuseableObj.processingStatus(actionBtn, 'end', `Delete School Information`);

        } catch (error) {
            console.log(error);
            reuseableObj.processingStatus(actionBtn, 'end', `Delete School Information`);
            Swal.fire("Server error please try later !");
        }
    }
}

export default AdminSupport;
