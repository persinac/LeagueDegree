/**
 * Created by apersinger on 6/2/2016.
 */

function CreateTableForShowBucketSummoners(data, numOfTables, title) {
    colNum = 12 / numOfTables;
    html = '<div class="col-md-' + colNum + '">';
    html += "<h2>"+title+"</h2>";
    html += "<table><tr>";
    html += "<th>Bucket ID</th>";
    html += "<th>Summoner ID</th>";
    html += "<th>Actual User?</th>";
    html += "<th>Generated On</th>";
    html += "</tr>";

    $.each( data, function( i, val_1 ) {
        html += "<tr>";
        html += "<td>" + val_1.bucket_id + "</td>";
        html += "<td>" + val_1.summoner_id + "</td>";
        html += "<td>" + val_1.is_actual_user + "</td>";
        html += "<td>" + val_1.created_on + "</td>";
        html += "</tr>";
    });

    html += "</table></div>";
    return html;
}