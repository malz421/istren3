function ajaxCall() {
    this.send = function (data, url, method, success, type) {

        type = type || 'json';
        var successRes = function (data) {
            success(data);
        };

        var errorRes = function (e) {
            console.log(e.status + " " + e.statusText);
            console.log(JSON.stringify(e));
            // alert(e);
            // let err = eval("(" + e.responseText + ")");
            alert("Error Code: " + e.status + " \nError Message: " + e.statusText + "\nExtra Info: " + JSON.stringify(e));
        };
        $.ajax({
            url: url,
            type: method,
            data: data,
            success: successRes,
            error: errorRes,
            dataType: type,
            timeout: 60000
        });

    }

}

function locationInfo() {
    var rootUrl = base_url + "admin/common/";
    var call = new ajaxCall();
    this.getCities = function (id) {
        $(".cities option:gt(0)").remove();
        var url = rootUrl + 'getCities/'+id;
        var method = "post";
        var data = {};
        $('.cities').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function (data) {
            $('.cities').find("option:eq(0)").html("Select City");
            if (data.tp === 1) {
                setSelect2BS4($(".cities"));
                // alert(data);
                $.each(data['result'], function (key, val) {
                    var option = $('<option />');
                    option.attr('value', key).text(val);
                    $('.cities').append(option);
                });
                $(".cities").prop("disabled", false);
                setSelect2BS4($(".cities"));

            } else {
                alert("Error: " + data.msg);
            }
        });
    };

    this.getStates = function (id) {
        $(".states option:gt(0)").remove();
        $(".cities option:gt(0)").remove();
        var url = rootUrl + 'getStates/'+id;
        var method = "post";
        var data = {};
        $('.states').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function (data) {

            $('.states').find("option:eq(0)").html("Select State");
            setSelect2BS4($(".states"));
            if (data.tp == 1) {
                $.each(data['result'], function (key, val) {
                    var option = $('<option />');
                    option.attr('value', key).text(val);
                    $('.states').append(option);
                });
                $(".states").prop("disabled", false);
                setSelect2BS4($(".states"));
            } else {
                alert(data.msg);
            }
        });
    };

    this.getCountries = function () {
        var url = rootUrl + 'getCountries';
        var method = "post";
        var data = {};
        $('.countries').find("option:eq(0)").html("Please wait..");
        call.send(data, url, method, function (data) {
            $('.countries').find("option:eq(0)").html("Select Country");
            setSelect2BS4($(".countries"));

            if (data.tp == 1) {
                $.each(data['result'], function (key, val) {
                    var option = $('<option />');
                    option.attr('value', key).text(val);
                    $('.countries').append(option);
                });
                $(".countries").prop("disabled", false);
            } else {
                alert(data.msg);
            }
            setSelect2BS4($(".countries"));

        });
    };

}

$(function () {
    var loc = new locationInfo();
    // loc.getCountries();
    $(document).on("change, select2:close", ".countries", function (ev) {
        var countryId = $(this).val();
        if (countryId !== '') {
            loc.getStates(countryId);
        } else {
            $(".states option:gt(0)").remove();
        }
    });
    $(document).on("change, select2:close", ".states", function (ev) {
        var stateId = $(this).val();
        if (stateId !== '') {
            loc.getCities(stateId);
        } else {
            $(".cities option:gt(0)").remove();
        }
    });
});


