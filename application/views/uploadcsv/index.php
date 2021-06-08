<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage CSV</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CSV</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="inner" >
    <?php if (!empty($this->session->flashdata('error'))) {
      echo '<div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong> <span class="glyphicon glyphicon-ok-sign"></span>'.$this->session->flashdata('error').' </strong>';
    }else if(!empty($this->session->flashdata('success'))){
      echo '<div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong> <span class="glyphicon glyphicon-ok-sign"></span>'.$this->session->flashdata('success').' </strong>';
    }
    ?> 
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open_multipart('uploadcsv/import', array('id' => 'import_csv_form','method' => 'post')); ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Import CSV File <span class="text-red">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="file" name="file" class="form-control"  accept=".csv" required/>
                                           
                                        </div>
                                        <div class="col-sm-4">
                                            
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-success" name="importSubmit" value="IMPORT">
                           
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>


 