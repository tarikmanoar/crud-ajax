<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Ajax Tute</title>
</head>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        SWIFT IT <i class="fa fa-plus float-right btn btn-success" aria-hidden="true" data-toggle="modal" data-target="#add"></i>
                    </div>
                    <div class="card-body">
                        <span class="error"></span>
                        <table class="table table-hover table-bordered "></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add NEW DATA Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="storeDB.php" method="POST" enctype="multipart/form-data" class="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="addRecordLabel">Add New Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="status text-center text-uppercase"></div>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Course Name</label>
                            <input type="text" class="form-control" name="c_name">
                        </div>
                        <div class="form-group">
                            <label>Card Id</label>
                            <input type="number" class="form-control" name="c_no">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit DATA Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="updateDB.php" method="POST" enctype="multipart/form-data" class="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="addRecordLabel">Update Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="status text-center text-uppercase"></div>
                            <input type="hidden" name="id" id="editId">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label>Course Name</label>
                            <input type="text" class="form-control" id="c_name" name="c_name">
                        </div>
                        <div class="form-group">
                            <label>Card Id</label>
                            <input type="number" class="form-control" id="c_no" name="c_no">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Delete Record Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="deleteDB.php" method="POST" enctype="multipart/form-data" class="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h1 class=" status modal-title text-center alert alert-danger" id="deleteLabel">Are You sure to delete?</h1>
                        <input type="hidden" name="id" id="deleteId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete Record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <script>
        $(function() {
            readData();

            $('form').on('submit', function(e) {
                e.preventDefault();
                form = $(this);
                if (checkForm(form)) {

                    // console.log('form');

                    crudRequest(form);
                } else {
                    console.log('SORRY ERROR!');
                }

            });

            $('.table').on('click', function(e) {
                e.preventDefault();
                let btn = $(e.target);
                id = btn.attr('data-id');
                if (btn.hasClass('btn')) {
                    getData(btn.attr('id'), id);
                    // console . log(id);
                }

            });
        });
        // Document Ready End 


        function checkForm(form) {
            let inputList = form.find('input');
            for (let i = 0; i < inputList.length; i++) {

                if (inputList[i].value === '' || inputList[i].value === null) {
                    return false;
                } else {
                    return true;
                }
            }

        }

        function readData() {
            $.ajax({
                url: 'readDB.php',
                method: 'GET',
                success: function(e) {
                    e = $.parseJSON(e);
                    if (e.status === 'success') {
                        $('.table').html(e.data);
                    } else {
                        $('.error').html(e.data);
                    }
                },
            });
        };

        function getData(idName, id) {
            $.ajax({
                url: 'getDB.php',
                method: 'get',
                data: {
                    id: id
                },
                success: function(e) {
                    e = $.parseJSON(e);
                    if (e.status === 'success') {
                        if (idName === 'update') {
                            let modal = $('#editModal');
                            let form = modal.find('.form');
                            form.find('#editId').val(e.data['id']);
                            form.find('#name').val(e.data['name']);
                            form.find('#c_name').val(e.data['c_name']);
                            form.find('#c_no').val(e.data['c_no']);
                            modal.modal('show');
                            // console.log(form.html());
                        } else if (idName === 'delete') {
                            let modal = $('#deleteModal');
                            let form = modal.find('.form');
                            form.find('#deleteId').val(e.data['id']);
                            modal.modal('show');
                        }
                    }
                }
            });
        }

        function crudRequest(form) {
            resetMsg();
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: form.serialize(),
                success: function(r) {
                    r = $.parseJSON(r);
                    if (r.status === 'success') {
                        setSuccessMsg(form, r.message);
                        readData();
                    } else if (r.status === 'error') {
                        setErrorMsg(form, r.message);
                    }
                    console.log(r);

                }
            });
        };

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
    </script>



</body>

</html>