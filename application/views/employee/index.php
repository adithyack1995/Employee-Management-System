<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Employee Information</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employee</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="messages"></div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Employee</button>
        <br /> <br />
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="manageTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Employee Code</th>
                    <th>Employee name</th>
                    <th>Department</th>
                    <th>Age</th>
                    <th>Experience in the organization</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" method="post" id="createForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="brand_name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter employee name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Employee code</label>
            <input type="text" class="form-control" id="emp_code" name="emp_code" placeholder="Enter employee code" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Department</label>
            <input type="text" class="form-control" id="department" name="department" placeholder="Enter department" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Date of Birth</label>
            <input type="date" id="dob" class="form-control datepicker" name="dob" placeholder="Enter date of birth" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Joining Date</label>
            <input type="date" class="form-control" id="joining" name="joining" placeholder="Enter joining  date" autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->