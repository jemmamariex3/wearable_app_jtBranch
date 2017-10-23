/*
* This file provides an API for hitting the context-aware PHP backend.
*/

function formatResponse(data, cb) {
    results = [];
    data.forEach(function(row) {
        results.push({
            id: parseInt(row[0]),
            data: parseInt(row[1]),
            time: parseInt(row[2])
        });
    });
    return cb(results);
}

function getDataByTime(func, start, end, cb) {
    var url = "/php/getPlayers.php?func=" + func + "&start=" + start + "&end=" + end;
    $.ajax({
        url: url,
        success: function (data) { return formatResponse(data, cb); }
    });
}

var wearables = {
    getHeartRateByTime: function(start, end, cb) { getDataByTime("allHRTime", start, end, cb); },
    getGSRByTime: function (start, end, cb) { getDataByTime("allGSRTime", start, end, cb); },
    getSkinByTime: function (start, end, cb) { getDataByTime("allSkinTime", start, end, cb); }
}
