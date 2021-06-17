$(document).ready(function () {
    bindForms();
});

function bindForms() {
    $("form").submit(function (event) {
        let csrfParam = $('meta[name="csrf-param"]').attr("content");
        let csrfToken = $('meta[name="csrf-token"]').attr("content");
        let thisEl = $(this);
        let url = thisEl.attr("action");
        let data = {}
        let method = thisEl.attr("method");

        let inputEls = thisEl.find("input[type=text]").each(function () {
            data[this.getAttribute('name')] = this.value;
            console.debug(this);
        });

        data[csrfParam] = csrfToken;
        let apiToken = data['_token'];
        delete data['_token'];

        let resEl = thisEl.parent().parent().find(".res");
        resEl.html('<div style="text-align: center;"><img src="/load.gif"></div>');

        $.ajax({
            url: url,
            type: method,
            data: data,
            headers: {
                'X-TESTAPI-TOKEN': apiToken
            },
            success: function (ans) {
                printAns(resEl, ans, inputEls);
//                for (let e of inputEls) {
//                    e.value = "";
//                }
            },
            error: function ( jqXHR, textStatus, errorThrown) {
                printAns(resEl, jqXHR.responseText, inputEls);
            }
        });

        event.preventDefault();

        return false;
    });
}

function printAns(resEl, ans, inputEls) {
    resEl.html('<pre>' + ans + '</pre>');

}
