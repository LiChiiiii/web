<!--------------------MODAL-------------------->
<!-- Add Modal -->
<div class="modal fade" id="monitorModal" tabindex="-1" role="dialog" aria-labelledby="monitorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New monitor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="monitorForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <div class="form-group">
                    <label for="moni_name1">monitor Name</label>
                    <input type="text" class="form-control" id="moni_name1" name="moni_name1" />
                </div>
                <div class="form-group">
                    <label for="snid">snid</label>
                    <textarea class="form-control" id="snid" name="snid" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="moni_status1">Status</label>
                    <select class="form-control" id="moni_status1" name="moni_status1">
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
<div class="modal fade" id="monitorEditModal" tabindex="-1" role="dialog" aria-labelledby="monitorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit monitor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="monitorEditForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <input type="hidden" id="monitor_id" name="monitor_id" />
                <div class="form-group">
                    <label for="moni_name">monitor Name</label>
                    <input type="text" class="form-control" id="moni_name" name="moni_name" />
                </div>
                <div class="form-group">
                    <label for="snid2">SNID</label>
                    <textarea class="form-control" id="snid2" name="snid2" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="moni_status">Status</label>
                    <select class="form-control" id="moni_status" name="moni_status">
                        <option>正常</option>
                        <option>維修</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!--Mail Model-->
<div class="modal fade" id="moni_SendMailModal" tabindex="-1" role="dialog" aria-labelledby="moni_MailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Mail —— Monitor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="moni_SendMailForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <div class="form-group">
                    <label for="moni_email">收件者</label>
                    <input type="text" class="form-control" id="moni_email" name="moni_email" />
                </div>
                <div class="form-group">
                    <label for="moni_subject">主旨</label>
                    <input type="text" class="form-control" id="moni_subject" name="moni_subject" />
                </div>
                <div class="form-group">
                    <label for="moni_title">標題</label>
                    <input type="text" class="form-control" id="moni_title" name="moni_title" />
                </div>
                <div class="form-group">
                    <label for="moni_content">內文</label>
                    <textarea class="form-control" id="moni_content" name="moni_content" rows="5"></textarea>
                </div>
                <input type="hidden" id="moni_num" name="moni_num" />
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
    $("#monitorForm").submit(function(e){
        e.preventDefault();

        let name = $("#moni_name1").val();
        let snid = $("#snid").val();
        let status = $("#moni_status1").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('monitor.create', $id ) }}",
            type: "POST",
            data:{
                name:name,
                snid:snid,
                status:status,
                _token:_token,
                
            },
            error:function(response){
                console.log('新增失敗');
            },
            success:function(response)
            {
                $("#monitorTable tbody").prepend('<tr><td>'+response.name+'</td><td>'+response.snid+'</td><td>'+response.status+'</td><td class="text-center">'
                                                    +'<a href="javascript:void(0)" onclick="editMonitor({{$monitor->monitor_id}})"class="btn btn-info">Edit</a>  '
                                                    +'<a href="javascript:void(0)" onclick="deleteMonitor({{$monitor->monitor_id}})" class="btn btn-danger">Delete</a></td></tr>')
                $("#monitorForm")[0].reset();
                $("#monitorModal").modal('hide');
            }

        }); 
    })
</script>
<!-- Edit function-->
<script>
    function editMonitor(monitor_id)
    {
        $.get(monitor_id+'/moni_edit', function(response){
            $("#monitor_id").val(response.monitor_id);
            $("#moni_name").val(response.name);
            $("#snid2").val(response.snid);
            $("#moni_status").val(response.status);
            $("#monitorEditModal ").modal('toggle');
        
        })
    }

    $("#monitorEditForm").submit(function(e){
        e.preventDefault();

        let monitor_id = $("#monitor_id").val();
        let name = $("#moni_name").val();
        let snid = $("#snid2").val();
        let status = $("#moni_status").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('monitor.update') }}",
            type: "PUT",
            data:{
                monitor_id:monitor_id,
                name:name,
                snid:snid,
                status:status,
                _token:_token,
                
            },
            error:function(response){
                console.log('編輯失敗');
            },
            success:function(response)
            {
                $('#sid'+response.monitor_id+' td:nth-child(1)').text(response.name);
                $('#sid'+response.monitor_id+' td:nth-child(2)').text(response.snid);
                $('#sid'+response.monitor_id+' td:nth-child(3)').text(response.status);
                $('#monitorEditModal').modal('toggle');
                $('#monitorEditForm')[0].reset();
            }
        });
    })
</script>
<!--Delete function-->
<script>
    function deleteMonitor(monitor_id)
    {
        if(confirm("Are you sure?"))
        {
            $.ajax({
            url: monitor_id+'/moni_delete' ,
            type: "DELETE",
            data:{
                _token : $("input[name=_token]").val()
            },
            error:function(response){
                console.log('刪除失敗');
            },
            success:function(response)
            {
                $('#sid'+monitor_id).remove();
            }
        }); 

        }
    }
</script>


<!--Send Email-->
<script>
    function sendEmail_Monitor(monitor_id)
    {
        $.get(monitor_id+'/moni_email', function(response){
            $('#moni_email').val(response.email);
            $('#moni_subject').val(response.subject);
            $("#moni_title").val(response.title);
            $("#moni_content").val(response.content);
            $("#moni_num").val(response.snid);
            $("#moni_SendMailModal").modal('toggle');
        
        })

    }

    $("#moni_SendMailForm").submit(function(e){
        e.preventDefault();
        if(confirm("確定寄出郵件？"))
        {
            let email = $("#moni_email").val();
            let subject = $("#moni_subject").val();
            let title = $("#moni_title").val();
            let content = $("#moni_content").val();
            let snid = $("#moni_num").val();
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
                    $('#moni_SendMailModal').modal('toggle');
                    $('#moni_SendMailForm')[0].reset();
                }
            });
        }
    })


</script>
