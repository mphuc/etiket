<form id="myForm" class="form-horizontal" name="kirimemail" action="<?php echo base_url(); ?>index.php/cms/test_email/process_kirim" method="post">
    <div class="page-content-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN sample_2 TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">To</label>
                        <div class="col-md-10">
                            <input type="text" name="emailnya" class="form-control" id="emailnya" value="<?php echo @$pegawai['gelar_depan'] . ' ' . @$pegawai['nama'] . ' ' . @$pegawai['gelar_belakang']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Subject</label>
                        <div class="col-md-10">
                            <input type="text" name="subject" class="form-control" id="subject" value="<?php echo @$pegawai['nip']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Isi email</label>
                        <div class="col-md-10">
                            <input type="text" name="message" class="form-control" id="message" value="<?php echo @$pegawai['nik']; ?>">
                        </div>
                    </div>
                    <div class="actions">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn green btn-outline ">
                                <i class="fa fa-pencil"></i> &nbsp; Kirim email
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>