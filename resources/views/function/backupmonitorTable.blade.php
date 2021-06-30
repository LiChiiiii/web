<!--------------------MODAL-------------------->
<!-- Add Modal -->
<div class="modal fade" id="backupmonitorModal" tabindex="-1" role="dialog" aria-labelledby="backupmonitorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New monitor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="bumonitorForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <div class="form-group">
                    <label for="bumoni_name1">backupmonitor Name</label>
                    <input type="text" class="form-control" id="bumoni_name1" name="bumoni_name1" />
                </div>
                <div class="form-group">
                    <label for="busnid">snid</label>
                    <textarea class="form-control" id="busnid" name="busnid" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="bumoni_status1">Status</label>
                    <select class="form-control" id="bumoni_status1" name="bumoni_status1">
                        <option>正常</option>
                        <option>維修中</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="backupmonitorEditModal" tabindex="-1" role="dialog" aria-labelledby="backupmonitorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit monitor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="bumonitorEditForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <input type="hidden" id="bumonitor_id" name="bumonitor_id" />
                <div class="form-group">
                    <label for="bumoni_name">monitor Name</label>
                    <input type="text" class="form-control" id="bumoni_name" name="bumoni_name" />
                </div>
                <div class="form-group">
                    <label for="busnid2">SNID</label>
                    <textarea class="form-control" id="busnid2" name="busnid2" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="bumoni_status">Status</label>
                    <select class="form-control" id="bumoni_status" name="bumoni_status">
                        <option>正常使用</option>
                        <option>維修中</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bumoni_classroom_id">電腦教室ID</label>
                    <input type="text" class="form-control" id="bumoni_classroom_id" name="bumoni_classroom_id" />
                </div>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!--Mail Model-->
<div class="modal fade" id="backupmoni_SendMailModal" tabindex="-1" role="dialog" aria-labelledby="backupmoni_MailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Mail —— Monitor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="bumoni_SendMailForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <div class="form-group">
                    <label for="bumoni_email">收件者</label>
                    <input type="text" class="form-control" id="bumoni_email" name="bumoni_email" />
                </div>
                <div class="form-group">
                    <label for="bumoni_subject">主旨</label>
                    <input type="text" class="form-control" id="bumoni_subject" name="bumoni_subject" />
                </div>
                <div class="form-group">
                    <label for="bumoni_title">標題</label>
                    <input type="text" class="form-control" id="bumoni_title" name="bumoni_title" />
                </div>
                <div class="form-group">
                    <label for="bumoni_content">內文</label>
                    <textarea class="form-control" id="bumoni_content" name="bumoni_content" rows="5"></textarea>
                </div>
                <input type="hidden" id="bumoni_num" name="bumoni_num" />
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
<!--------------------FUNCTION-------------------->
<!-- Add function-->
<script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="   crossorigin="anonymous"></script>
<script>
    $("#bumonitorForm").submit(function(e){
        e.preventDefault();

        let name = $("#bumoni_name1").val();
        let snid = $("#busnid").val();
        let status = $("#bumoni_status1").val();
        let classroom_id = '7';
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('monitor.add') }}",
            type: "POST",
            data:{
                name:name,
                snid:snid,
                status:status,
                classroom:classroom,
                _token:_token,
                
            },
            error:function(response){
                console.log('新增失敗');
            },
            success:function(response)
            {
                $("#bumonitorTable tbody").prepend('<tr><td>'+response.name+'</td><td>'+response.snid+'</td><td>'+response.status+'</td><td class="text-center">'
                                                    +'<a href="javascript:void(0)" onclick="editMonitor({{$monitor->bumonitor_id}})"class="btn btn-info">Edit</a>  '
                                                    +'<a href="javascript:void(0)" onclick="deleteMonitor({{$monitor->bumonitor_id}})" class="btn btn-danger">Delete</a></td></tr>')
                $("#bumonitorForm")[0].reset();
                $("#bumonitorModal").modal('hide');
            }

        }); 
    })
</script>
<!-- Edit function-->
<script>
    function editBackupMonitor(monitor_id)
    {
        $.get(monitor_id+'/moni_edit', function(response){
            $("#bumonitor_id").val(response.monitor_id);
            $("#bumoni_name").val(response.name);
            $("#busnid2").val(response.snid);
            $("#bumoni_status").val(response.status);
            $("#bumoni_classroom_id").val(response.classroom_id);
            $("#backupmonitorEditModal ").modal('toggle');
        })
    }


    $("#bumonitorEditForm").submit(function(e){
        e.preventDefault();

        let monitor_id = $("#bumonitor_id").val();
        let name = $("#bumoni_name").val();
        let snid = $("#busnid2").val();
        let status = $("#bumoni_status").val();
        let classroom_id = $("#bumoni_classroom_id").val();

        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('monitor.update') }}",
            type: "PUT",
            data:{
                monitor_id:monitor_id,
                name:name,
                snid:snid,
                status:status,
                classroom_id:classroom_id,
                _token:_token,    
            },
            error:function(response){
                console.log('編輯失敗');
            },
            success:function(response)
            {
                $('#busid'+response.monitor_id+' td:nth-child(1)').text(response.name);
                $('#busid'+response.monitor_id+' td:nth-child(2)').text(response.snid);
                $('#busid'+response.monitor_id+' td:nth-child(3)').text(response.status);
                $('#backupmonitorEditModal').modal('toggle');
                $('#bumonitorEditForm')[0].reset();
            }
        });
    })
</script>
<!--Delete function-->
<script>
    function deleteBackupMonitor(monitor_id)
    {
        if(confirm("Are you sure?"))
        {
            $.ajax({
            url: monitor_id+'/bumoni_delete' ,
            type: "DELETE",
            data:{
                _token : $("input[name=_token]").val()
            },
            error:function(response){
                console.log('刪除失敗');
            },
            success:function(response)
            {
                $('#busid'+monitor_id).remove();
            }
        }); 

        }
    }
</script>


<!--Send Email-->
<script>
    function sendEmail_BackupMonitor(monitor_id)
    {
        $.get(monitor_id+'/bumoni_email', function(response){
            $('#bumoni_email').val(response.email);
            $('#bumoni_subject').val(response.subject);
            $("#bumoni_title").val(response.title);
            $("#bumoni_content").val(response.content);
            $("#bumoni_num").val(response.snid);
            $("#bumoni_SendMailModal").modal('toggle');
        
        })

    }

    $("#bumoni_SendMailForm").submit(function(e){
        e.preventDefault();
        if(confirm("確定寄出郵件？"))
        {
            let email = $("#bumoni_email").val();
            let subject = $("#bumoni_subject").val();
            let title = $("#bumoni_title").val();
            let content = $("#bumoni_content").val();
            let snid = $("#bumoni_num").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('sendEmail') }}",
                type: "POST",
                data:{
                    email:email,
                    subject:subject,
                    title:title,
                    content:content,
                    asset_num:snid,
                    _token:_token,
                    
                },
                error:function(response){
                    alert('寄出失敗');
                },
                success:function(response)
                {
                    alert(response.success);
                    $('#bumoni_SendMailModal').modal('toggle');
                    $('#bumoni_SendMailForm')[0].reset();
                }
            });
        }
    })


</script>
