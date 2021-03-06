$(function() {

    // User file upload initialize
    if ($( "#inputFileHome" ).length) {
        $("#inputFileHome").fileinput({
            showUpload: true,
            dropZoneEnabled: false,
            maxFileCount: 1,
            readonly: true,
            showUploadedThumbs:false,
            hiddenThumbnailContent:true,
            showPreview:false,
            mainClass: "input-group-lg"
        });
    }

    // Admin table initialize
    if ($( "#tabulator-table" ).length) {
        $("#tabulator-table").tabulator({
            height:300, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
            layout:"fitColumns", //fit columns to width of table (optional)
            columns:[ //Define Table Columns
                {title:"ID", field:"id", width:150},
                {title:"Name", field:"name", align:"left"},
                {title:"Signature", field:"signature"},
                {title:"Comment", field:"comment", align:"center"},
                {title:"Uploaded", field:"created", sorter:"date", align:"center"},
                {title:"Delete", formatter:"buttonCross", align:"center",
                cellClick:function(e, cell){
                    $('#deleteModal').find('input:hidden').attr('value', cell.getRow().getData().id);
                    $('#deleteModal').modal();
                }}],
            footerElement:$("<div class='tabulator-footer'><button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#addModal'>Add</button></div>"),
             // data is set in admin/index.php from php
             data:dataMalware
         });
        }
    });

// opens upload modal if there is an error message
if (!$('#errorMessage').is(':empty')) {
    $('#addModal').modal('show');
}

/**
 * Validates all the inputs recursively
 * @param  {Objet} form [Form element]
 * @param  {String} el   [error msg element id]
 * @return {Boolean}      [validated or not]
 */
 function validate(form, el) {
    var fail = "";
    if (form.inputFile != undefined) {
        fail += validateFile(form.inputFile.value)
    }
    if (form.inputEmail != undefined) {
        fail += validateEmail(form.inputEmail.value)
    }
    if (form.inputPassword != undefined) {
        fail += validatePassword(form.inputPassword.value)
    }
    if (form.inputName != undefined) {
        fail += validateName(form.inputName.value)
    }
    if (fail == "") {
        return true
    } else {
        $(el).text(fail);
        return false
    }
}

/**
 * Username validation
 * @param  {String} field [username]
 * @return {Boolean}       [validated]
 */
 function validateFile(field)
 {
    var regex = /[^a-zA-Z0-9-_]/g;

    if (field == "")
        return "Username is required.\n"
    else if (field.length < 5)
        return "Username must must be at least 5 characters.\n"
    else if (regex.test(field))
        return "Only a-z, A-Z, 0-9, - and _ allowed in Username.\n"
    return ""
}

/**
 * Email validation
 * @param  {String} field [email]
 * @return {Boolean}       [validated]
 */
 function validateEmail(field)
 {
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/g;

    if (field == "")
        return "Email is required.\n"
    else if (!regex.test(field))
        return "Email is not formatted properly.\n"
    return ""
}

/**
 * Password validation
 * @param  {String} field [password]
 * @return {Boolean}       [validated]
 */
 function validatePassword(field)
 {
    var regex = /[^a-zA-Z0-9-_!$/%@#]/g;

    if (field == "")
        return "Password is required.\n"
    else if (field.length < 5)
        return "Password must must be at least 5 characters.\n"
    else if (regex.test(field))
        return "Only a-z, A-Z, 0-9, !, $, /, %, @ and # allowed in Password.\n"
    return ""
}

/**
 * Name validation
 * @param  {String} field [Name]
 * @return {Boolean}       [validated]
 */
 function validateName(field)
 {
    var regex = /[^a-zA-Z0-9-_!$/%@#]/g;

    if (field == "")
        return "Password is required.\n"
    else if (field.length < 5)
        return "Password must must be at least 5 characters.\n"
    else if (regex.test(field))
        return "Only a-z, A-Z, 0-9, !, $, /, %, @ and # allowed in Password.\n"
    return ""
}

