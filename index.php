<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>CRUD with AJAX</title>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-title">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info btn-small float-right mb-5" data-toggle="modal" data-target="#addRecord">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Record
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-hover"></table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Record Modal -->
    <div class="modal fade" id="addRecord" tabindex="-1" role="dialog" aria-labelledby="addRecordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="store.php" method="POST" enctype="multipart/form-data" class="form">
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
                            <input type="text" class="form-control" aria-describedby="name" name="name">
                        </div>
                        <div class="form-group">
                            <label>Course Name</label>
                            <input type="text" class="form-control" aria-describedby="c_name" name="c_name">
                        </div>
                        <div class="form-group">
                            <label>Card Id</label>
                            <input type="number" class="form-control" aria-describedby="c_no" name="c_no">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--Update Record Modal -->
    <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="updateData.php" method="POST" enctype="multipart/form-data" class="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="updateLabel">UpdateData</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="editId">
                            <div class="status text-center text-uppercase"></div>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="name" name="name">
                        </div>
                        <div class="form-group">
                            <label>Course Name</label>
                            <input type="text" class="form-control" id="c_name" aria-describedby="c_name" name="c_name">
                        </div>
                        <div class="form-group">
                            <label>Card Id</label>
                            <input type="text" class="form-control" id="c_no" aria-describedby="c_no" name="c_no">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Record</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--Delete Record Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="deleteData.php" method="POST" enctype="multipart/form-data" class="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h1 class="modal-title text-center text-danger" id="deleteLabel">Are You sure to delete?</h1>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">

    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="my.js"></script>
</body>

</html>