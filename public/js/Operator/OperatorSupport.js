import RequestSupport from "../Support/RequestSupport.js";

import Reuseable from "../Support/Reuseable.js";
const reuseableObj = new Reuseable();

class OperatorSupport extends RequestSupport {
    constructor() {
        super();
    }

    allocateVacency = async (form) => {
        try {
            let confirm = await reuseableObj.confirmSwal("Are you sure you want to allocate?");
            if (confirm.isConfirmed) {
                reuseableObj.processingStatus('#allocate-btn');
                var form_data = new FormData($(form)[0]);
                form_data.append('requestType', 'allocate');
                this.formPostReponse = async (response) => {
                    if (response?.resData?.statusCode == 200) {
                        // window.location.href = `/operator/`
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response?.resData?.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });

                    } else if (response?.resData?.statusCode == 400) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Information!',
                            text: response?.resData?.message
                        });
                    } else {
                        Swal.fire("Something went wrong");
                    }
                }
                await this.formPost(form_data, '/operator/search-vacent-code');
                reuseableObj.processingStatus('#allocate-btn', 'end', 'Search');
            }

        } catch (error) {
            Swal.fire("Server error please try later !");
        }
    }
}

export default OperatorSupport;
