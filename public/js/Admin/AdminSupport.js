import RequestSupport from "../Support/RequestSupport.js";
import Reuseable from "../Support/Reuseable.js";
const reuseableObj = new Reuseable();
class AdminSupport extends RequestSupport {
    constructor() {
        super();
    }
    addSchoolVacency = async (form, requestType) => {
        try {
            reuseableObj.processingStatus('#subject-school-vacency');
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
                    Swal.fire("Something went wrong");
                }
            }
            await this.formPost(form_data, '/admin/add-school-vacency-post');
            reuseableObj.processingStatus('#subject-school-vacency', 'end', 'Submit Vacancy Information');

        } catch (error) {
            console.log(error);
            reuseableObj.processingStatus('#subject-school-vacency', 'end', 'Submit Vacancy Information');
            Swal.fire("Server error please try later !");
        }
    }
}

export default AdminSupport;
