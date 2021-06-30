<!--------------------MODAL-------------------->
<!-- Add Modal -->
<div class="modal fade" id="bucomputerModal" tabindex="-1" role="dialog" aria-labelledby="bucomputerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Computer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="bucomputerForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <div class="form-group">
                    <label for="buname">Computer Name</label>
                    <input type="text" class="form-control" id="buname" name="buname" />
                </div>
                <div class="form-group">
                    <label for="buasset_num">Asset Number</label>
                    <textarea class="form-control" id="buasset_num" name="buasset_num" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="bustatus">Status</label>
                    <select class="form-control" id="bustatus" name="bustatus">
                        <option>正常使用</option>
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
<div class="modal fade" id="bucomputerEditModal" tabindex="-1" role="dialog" aria-labelledby="bucomputerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Computer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="bucomputerEditForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <input type="hidden" id="bucomputer_id" name="bucomputer_id" />
                <div class="form-group">
                    <label for="buname2">Computer Name</label>
                    <input type="text" class="form-control" id="buname2" name="buname2" />
                </div>
                <div class="form-group">
                    <label for="buasset_num2">Asset Number</label>
                    <textarea class="form-control" id="buasset_num2" name="buasset_num2" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="bustatus2">Status</label>
                    <select class="form-control" id="bustatus2" name="bustatus2">
                        <option>正常使用</option>
                        <option>維修中</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="buclassroom_id2">Classroom ID</label>
                    <input type="text" class="form-control" id="buclassroom_id2" name="buclassroom_id2" />
                </div>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
<!--Mail Model-->
<div class="modal fade" id="SendMailModal" tabindex="-1" role="dialog" aria-labelledby="MailModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Send Mail —— Computer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="SendMailForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <div class="form-group">
                    <label for="email">收件者</label>
                    <input type="text" class="form-control" id="email" name="email" />
                </div>
                <div class="form-group">
                    <label for="subject">主旨</label>
                    <input type="text" class="form-control" id="subject" name="subject" />
                </div>
                <div class="form-group">
                    <label for="title">標題</label>
                    <input type="text" class="form-control" id="title" name="title" />
                </div>
                <div class="form-group">
                    <label for="content">內文</label>
                    <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                </div>
                <input type="hidden" id="num" name="num" />
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
    $("#bucomputerForm").submit(function(e){
        e.preventDefault();

        let name = $("#buname").val();
        let asset_num = $("#buasset_num").val();
        let status = $("#bustatus").val();
        let classroom_id='7';
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('computer.add') }}",
            type: "POST",
            data:{
                name:name,
                asset_num:asset_num,
                status:status,
                classroom_id:classroom_id,
                _token:_token,
                
            },
            error:function(response){
                console.log('新增失敗');
            },
            success:function(response)
            {
                $("#bucomputerTable tbody").prepend('<tr><td>'+response.name+'</td><td>'+response.asset_num+'</td><td>'+response.status+'</td><td class="text-center">'
                                                    +'<a href="javascript:void(0)" onclick="editComputer({{$post->bucomputer_id}})"class="btn btn-info">Edit</a>  '
                                                    +'<a href="javascript:void(0)" onclick="deleteComputer({{$post->bucomputer_id}})" class="btn btn-danger">Delete</a></td></tr> ')  
                $("#bucomputerForm")[0].reset();
                $("#bucomputerModal").modal('hide');
            }

        }); 
    })
</script>
<!-- Edit function-->
<script>
    function editBackupComputer(computer_id)
    {
        $.get(computer_id+'/edit', function(response){
            $("#bucomputer_id").val(response.computer_id);
            $("#buname2").val(response.name);
            $("#buasset_num2").val(response.asset_num);
            $("#bustatus2").val(response.status);
            $("#buclassroom_id2").val(response.classroom_id);
            $("#bucomputerEditModal ").modal('toggle');
        
        })
    }

    $("#bucomputerEditForm").submit(function(e){
        e.preventDefault();

        let computer_id = $("#bucomputer_id").val();
        let name = $("#buname2").val();
        let asset_num = $("#buasset_num2").val();
        let status = $("#bustatus2").val();
        let classroom_id = $("#buclassroom_id2").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('computer.update') }}",
            type: "PUT",
            data:{
                computer_id:computer_id,
                name:name,
                asset_num:asset_num,
                status:status,
                classroom_id:classroom_id,
                _token:_token,
                
            },
            error:function(response){
                console.log('編輯失敗');
            },
            success:function(response)
            {
                $('#busid'+response.computer_id+' td:nth-child(1)').text(response.name);
                $('#busid'+response.computer_id+' td:nth-child(2)').text(response.asset_num);
                $('#busid'+response.computer_id+' td:nth-child(3)').text(response.status);
                $('#bucomputerEditModal').modal('toggle');
                $('#bucomputerEditForm')[0].reset();
            }
        });
    })
</script>
<!--Delete function-->
<script>
    function deleteBackupComputer(computer_id)
    {
        if(confirm("確定刪除此電腦資訊?"))
        {
            $.ajax({
            url: computer_id+'/delete' ,
            type: "DELETE",
            data:{
                _token : $("input[name=_token]").val()
            },
            error:function(response){
                console.log('刪除失敗');
            },
            success:function(response)
            {
                $('#busid'+computer_id).remove();
            }
        }); 

        }
    }
</script>

<!--Send Email-->
<script>
    function sendEmail(computer_id)
    {
        $.get(computer_id+'/email', function(response){
            $('#email').val(response.email);
            $('#subject').val(response.subject);
            $("#title").val(response.title);
            $("#content").val(response.content);
            $("#num").val(response.asset_num);
            $("#SendMailModal").modal('toggle');
        
        })

    }

    $("#SendMailForm").submit(function(e){
        e.preventDefault();
        if(confirm("確定寄出郵件？"))
        {
            let email = $("#email").val();
            let subject = $("#subject").val();
            let title = $("#title").val();
            let content = $("#content").val();
            let asset_num = $("#num").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('sendEmail') }}",
                type: "POST",
                data:{
                    email:email,
                    subject:subject,
                    title:title,
                    content:content,
                    asset_num:asset_num,
                    _token:_token,
                    
                },
                error:function(response){
                    alert('寄出失敗');
                },
                success:function(response)
                {
                    alert(response.success);
                    $('#SendMailModal').modal('toggle');
                    $('#SendMailForm')[0].reset();
                }
            });
        }
    })


</script>
