<?php
$datenow = date("Y-m-d H:i:s");
?>
<div class="col-sm-12">
    <div class="row" style="margin-top: 6%;">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">Bank Details</div>
                <div class="card-body card-block">
                    <form  class="" id="frmBankName" name="frmBankName">
                        <div class="form-group">
                            <input type="hidden" id="txtid" name="txtid" value="0">
                            <label for="" class="control-label mb-1">Bank Name</label>
                            <input type="text" id="bankname" name="bankname" onclick="charachters_validate('bankname')" minlength="3" maxlength="60" class="form-control" required>
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
                        <button type="reset" class="btn  btn-sm">All Records</button>
                        <button type="submit" class="btn btn-sm">Details View</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">Report</div>
                <div class="card-body">
                    <div class="table table-responsive" >
                        <table class="table table-striped">
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
<script>
    $(function () {
        load_bank_details();
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
                load_bank_details();
            }
        });
    });
    function load_bank_details(){
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
    }
</script>