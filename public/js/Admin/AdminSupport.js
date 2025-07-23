import RequestSupport from "../Support/RequestSupport.js";
import Reuseable from "../Support/Reuseable.js";
const reuseableObj = new Reuseable();
class AdminSupport extends RequestSupport {
    constructor() {
        super();
    }
    addSchoolVacency = async (form) => {
        try {
            reuseableObj.processingStatus('#subject-school-vacency');
            var form_data = new FormData($(form)[0]);
            this.formPostReponse = async (response) => {
                console.log(response);
                if (response?.resData?.statusCode == 200) {

                } else if (response?.resData?.statusCode == 400) {
                    Swal.fire(response?.resData?.message);
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
