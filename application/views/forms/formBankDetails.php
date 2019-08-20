<?php
$datenow = date("Y-m-d H:i:s");
?>
<div class="col-sm-10">

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                    <h2><i class="fa fa-angle-double-right "></i> Create Bank</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                    class="fa fa-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="fa fa-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                    class="fa fa-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <br>
                    <form  class="" id="frmBankName" name="frmBankName">
                        <div class="form-group">
                            <input type="hidden" id="txtid" name="txtid" value="0">
                            <label for="" class="control-label mb-1">Bank Name</label>
                            <input type="text" id="bankname" name="bankname" onclick="charachters_validate('bankname')" minlength="3" maxlength="60" class="form-control" required autocomplete="off">
                            <input type="hidden" id="isactive" name="isactive" value='1' class="form-control">
                            <small class="errormsg_bankname"></small>
                        </div>
                        <br>
                        <div class="form-actions form-group text-right">
                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <form action="">
                        <button type="button" class="btn  btn-sm" onclick="bankReport(1)">Recent Entries</button>
                        <button type="button" class="btn  btn-sm" onclick="bankReport(2)">All Entries</button>
                        <button type="button" class="btn  btn-sm" onclick="bankReport(3)">Active Entries</button>
                        <button type="button" class="btn  btn-sm" onclick="bankReport(4)">Inactive Entries</button>
                        <button type="button" class="btn btn-sm" onclick="bankReport(5)">Details View</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                    <h2><i class="fa fa-angle-double-right "></i> Report</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                    class="fa fa-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                    class="fa fa-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                    class="fa fa-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="table-responsive">
                        <table class="table  table-striped table-bordered bootstrap-datatable datatable  table-earning">
                        <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Bank name</th>
                            <th>IsActive</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="load_bank_names">
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $(function () {
        // load_bank_details();
    });
    $("#frmBankName").submit(function(e){
        e.preventDefault();
        var frm = $("#frmBankName").serialize();
        $.ajax({
            type:'post',
            url: "<?= base_url('Bank/create_bank')?>",
            crossDomain:true,
            data:frm,
            success:function(data){
                if(data!=false){
                    console.log(data);
                    $('#bankname').val("");
                }else{
                    console.log(data);
                }
                bankReport(1);
            }
        });
    });
    function bankReport(id){
      if(id==1){
          $.ajax({
              type:'post',
              url:"<?= base_url('Bank/report_bank_details')?>",
              crossDomain:true,
              data:{onlyrecent:1},
              success:function(data){
                  var jsondata = JSON.parse(data);
                  if(data!=false){
                      var j=0;
                      var z = jsondata.length;
                      // alert(z);
                      var html = "";
                      for(var i=0; i<z; i++){
                          j++;
                          html +=("<tr> <td>"+j+"</td><td>"+ jsondata[i].bankname+"</td><td>"+jsondata[i].isactive+"</td><td>Edit</td></tr>");
                      }
                      $("#load_bank_names").html(html);
                  }
              }
          });
      }else if(id==2){
          $.ajax({
              type:'post',
              url:"<?= base_url('Bank/report_bank_details')?>",
              crossDomain:true,
              success:function(data){
                  var jsondata = JSON.parse(data);
                  if(data!=false){
                      var j=0;
                      var z = jsondata.length;
                      // alert(z);
                      var html = "";
                      for(var i=0; i<z; i++){
                          j++;
                          html +=("<tr> <td>"+j+"</td><td>"+ jsondata[i].bankname+"</td><td>"+jsondata[i].isactive+"</td><td>Edit</td></tr>");
                      }
                      $("#load_bank_names").html(html);
                  }
              }
          });
      }else if(id==3){
          $.ajax({
              type:'post',
              url:"<?= base_url('Bank/report_bank_details')?>",
              crossDomain:true,
              data:{onlyactive:1},
              success:function(data){
                  var jsondata = JSON.parse(data);
                  if(data!=false){
                      var j=0;
                      var z = jsondata.length;
                      // alert(z);
                      var html = "";
                      for(var i=0; i<z; i++){
                          j++;
                          html +=("<tr> <td>"+j+"</td><td>"+ jsondata[i].bankname+"</td><td>"+jsondata[i].isactive+"</td><td>Edit</td></tr>");
                      }
                      $("#load_bank_names").html(html);
                  }
              }
          });
      }else if(id==4){
          $.ajax({
              type:'post',
              url:"<?= base_url('Bank/report_bank_details')?>",
              crossDomain:true,
              data:{onlyinactive:1},
              success:function(data){
                  var jsondata = JSON.parse(data);
                  if(data!=false){
                      var j=0;
                      var z = jsondata.length;
                      // alert(z);
                      var html = "";
                      for(var i=0; i<z; i++){
                          j++;
                          html +=("<tr> <td>"+j+"</td><td>"+ jsondata[i].bankname+"</td><td>"+jsondata[i].isactive+"</td><td>Edit</td></tr>");
                      }
                      $("#load_bank_names").html(html);
                  }
              }
          });
      }else if(id==5){
          alert('This report is not available right now');
      }
    }
</script>
