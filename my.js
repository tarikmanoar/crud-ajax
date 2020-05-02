$(function () {
    // Read Data 
    readData();
    // crudRequest 
    $('form').on('submit', function (e) {
        e.preventDefault();
        form = $(this);
        if (checForm(form)) {
            crudRequest(form);
            // console.log('Success');

        } else {
            console.log('FUCK');

        }
    });

    // Edit data 
    $('.table').on('click', function (e) {
        e.preventDefault();
        let anchor = $(e.target).parent('.btn');
        console.log(anchor);
        
        let id = anchor.attr('data-id');
        if (anchor.hasClass('btn')) {
            // console.log(id);
            getRecord(anchor.attr('id'), id);
        }

    });
});

function getRecord(actionName, id) {
    $.ajax({
        url: 'getData.php',
        method: 'get',
        data: { id: id },
        success: function (response) {
            response = $.parseJSON(response);
            if (response.status === 'success') {
                if (actionName === 'update') {

                    let modal = $('#update-modal');
                    let form = modal.find('.form');
                    form.find('#editId').val( response.data['id']);
                    form.find('#name').val( response.data['name']);
                    form.find('#c_name').val( response.data['c_name']);
                    form.find('#c_no').val( response.data['c_no']);

                    modal.modal('show');
                    // console.log(modal.html());
                    
                } else if (actionName === 'delete') {

                    let modal = $('#delete-modal');
                    let form = modal.find('.form');
                    form.find('#deleteId').val( response.data['id']);

                    modal.modal('show');
                    // console.log(modal.html());
                    
                }
            }
        }
    });
}

// function deleteData(actionName, id) {
//     $.ajax({
//         url:'',
//     });
// }

function crudRequest(form) {
    resetMsg();
    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function (response) {
            response = $.parseJSON(response);
            if (response.status === 'success') {
                setSuccessMsg(form, response.message);
            } else if (response.status === 'error') {
                setErrorMsg(form, response.message);
            }
            readData();
            console.log(response);

        }
    });
    // console.log(form.serialize());

}

function checForm(form) {
    let inputList = form.find('input');
    for (let i = 0; i < inputList.length; i++) {
        if (inputList[i].value === '' || inputList[i].value === null || inputList[i].value === ' ') {
            return false;
        } else {
            return true;
        }


    }

}
// Read Data From Database 
function readData() {
    $('.table').html('<tr colspan="5" style="text-align:center" ><td><img src="loader.gif" alt="img"/></td></tr>');
    $.ajax({
        url: 'read.php',
        method: 'get',
        success: function (data) {
            data = $.parseJSON(data);
            if (data.status == 'success') {
                $('.table').html(data.html);
            }
            // console.log(data);
        }
    });
}

function setSuccessMsg(form, message) {
    let $alert = form.find('.status');
    $alert.addClass('alert');
    $alert.addClass('alert-success');
    $alert.html(message);
}
function setErrorMsg(form, message) {
    let $alert = form.find('.status');
    $alert.addClass('alert');
    $alert.addClass('alert-danger');
    $alert.html(message);
}
function resetMsg() {
    $('.status').removeClass('alert');
    $('.status').removeClass('alert-success');
    $('.status').removeClass('alert-danger');
    $('.status').html('');

}