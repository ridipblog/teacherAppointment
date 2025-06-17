import RequestSupport from "../Support/RequestSupport.js";
import Reuseable from "../Support/Reuseable.js";
const reuseableObj=new Reuseable();
class AuthSupport extends RequestSupport {
    constructor(){
        super();
    }
    userLogin=async(form)=>{
        reuseableObj.processingStatus('#login-btn');
        var form_data = new FormData($(form)[0]);
        this.formPostReponse = async (response) => {
            if (response?.resData?.statusCode == 200) {
                window.location.href = `/operator/`
            } else if (response?.resData?.statusCode == 400) {
                Swal.fire(response?.resData?.message);
            } else {
                window.location.href = `/operator/`
            }
        }
        await this.formPost(form_data, '/login-post');
        // reuse_module.processingStatus('.registration-OTP-btn', 'end', 'Login');
    }
}

export default AuthSupport;
