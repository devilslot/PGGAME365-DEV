function GetEnum(url, callback) {
    $.getJSON(url, function (res) {
        var arr = [];
        $.each(res, function (key, value) {
            var set = {
              'value':key,
              'html':value
            };
            arr.push(set);
        });
        callback(arr);
    });
};

function Enum(params, value) {
    var data;
    $.each(params, function (key, val) {
        if (String(val["value"]) === String(value)) {
            data = val["html"];
        }
    });
    return data;
};
