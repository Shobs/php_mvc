$(function() {


    // User file upload initialize
    $("#user-file-upload").fileinput({
        showUpload: false,
        dropZoneEnabled: false,
        maxFileCount: 1,
        readonly: true,
        mainClass: "input-group-lg"
    });

    // Admin table initialize
    $("#tabulator-example").tabulator({
        height:205, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
        layout:"fitColumns", //fit columns to width of table (optional)
        columns:[ //Define Table Columns
            {title:"Name", field:"name", width:150},
            {title:"Age", field:"age", align:"left", formatter:"progress"},
            {title:"Favourite Color", field:"col"},
            {title:"Date Of Birth", field:"dob", sorter:"date", align:"center"},
        ],
        rowClick:function(e, row){ //trigger an alert message when the row is clicked
            alert("Row " + row.getData().id + " Clicked!!!!");
        },
    });

});