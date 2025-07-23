class RequestSupport {
    constructor() {

    }
    // ---------------- request form using post method --------------
    formPost = async (form_data, api_route, is_html = false) => {
        var self = this;

        await $.ajax({
            type: "post",
            url: api_route,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            dataType: is_html ? "html" : "json",
            contentType: false,
            processData: false,
            success: function (response) {
                self.formPostReponse(response);
            }, error: function (data) {
                console.log(data);
            }
        });
    }
    // -------------- process server response data ------------------
    formPostReponse = async (response) => {
        // ---------------- write your code ------------------
    }
    formGet = async (form_data, api_route, is_html = false) => {
        var self = this;
        await $.ajax({
            type: "get",
            url: api_route,
            data: form_data,
            dataType: is_html ? "html" : "json",
            success: function (response) {

                self.formPostReponse(response);
            }, error: function (data) {
                // console.log(data);
            }
        });
    }



}

export default RequestSupport;
