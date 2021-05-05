<!--------------------MODAL-------------------->
<!-- Add Modal -->
<div class="modal fade" id="computerModal" tabindex="-1" role="dialog" aria-labelledby="computerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Computer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="computerForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <div class="form-group">
                    <label for="name">Computer Name</label>
                    <input type="text" class="form-control" id="name" name="name" />
                </div>
                <div class="form-group">
                    <label for="asset_num">Asset Number</label>
                    <textarea class="form-control" id="asset_num" name="asset_num" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option>正常使用</option>
                        <option>主機維修</option>
                        <option>螢幕維修</option>
                        <option>主機、螢幕維修</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="computerEditModal" tabindex="-1" role="dialog" aria-labelledby="computerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Computer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="computerEditForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <input type="hidden" id="computer_id" name="computer_id" />
                <div class="form-group">
                    <label for="name2">Computer Name</label>
                    <input type="text" class="form-control" id="name2" name="name2" />
                </div>
                <div class="form-group">
                    <label for="asset_num2">Asset Number</label>
                    <textarea class="form-control" id="asset_num2" name="asset_num2" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="status2">Status</label>
                    <select class="form-control" id="status2" name="status2">
                        <option>正常使用</option>
                        <option>主機維修</option>
                        <option>螢幕維修</option>
                        <option>主機、螢幕維修</option>
                    </select>
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
    $("#computerForm").submit(function(e){
        e.preventDefault();

        let name = $("#name").val();
        let asset_num = $("#asset_num").val();
        let status = $("#status").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('computer.create', $id ) }}",
            type: "POST",
            data:{
                name:name,
                asset_num:asset_num,
                status:status,
                _token:_token,
                
            },
            error:function(response){
                console.log('新增失敗');
            },
            success:function(response)
            {
                $("#computerTable tbody").prepend('<tr><td>'+response.name+'</td><td>'+response.asset_num+'</td><td>'+response.status+'</td><td class="text-center">'
                                                    +'<a href="javascript:void(0)" onclick="editComputer({{$post->computer_id}})"class="btn btn-info">Edit</a>  '
                                                    +'<a href="javascript:void(0)" onclick="sendEmail({{$post->computer_id}})" class="btn btn-danger">Mail</a></td>'
                                                    +'<td><button type="button" class="close" aria-label="Close" href="javascript:void(0)" onclick="deleteComputer({{$post->computer_id}})">'
                                                    +'<span aria-hidden="true">&times;</span>'
                                                    +'</button></td></tr>')
                $("#computerForm")[0].reset();
                $("#computerModal").modal('hide');
            }

        }); 
    })
</script>
<!-- Edit function-->
<script>
    function editComputer(computer_id)
    {
        $.get(computer_id+'/edit', function(response){
            $("#computer_id").val(response.computer_id);
            $("#name2").val(response.name);
            $("#asset_num2").val(response.asset_num);
            $("#status2").val(response.status);
            $("#computerEditModal ").modal('toggle');
        
        })
    }

    $("#computerEditForm").submit(function(e){
        e.preventDefault();

        let computer_id = $("#computer_id").val();
        let name = $("#name2").val();
        let asset_num = $("#asset_num2").val();
        let status = $("#status2").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('computer.update') }}",
            type: "PUT",
            data:{
                computer_id:computer_id,
                name:name,
                asset_num:asset_num,
                status:status,
                _token:_token,
                
            },
            error:function(response){
                console.log('編輯失敗');
            },
            success:function(response)
            {
                $('#sid'+response.computer_id+' td:nth-child(1)').text(response.name);
                $('#sid'+response.computer_id+' td:nth-child(2)').text(response.asset_num);
                $('#sid'+response.computer_id+' td:nth-child(3)').text(response.status);
                $('#computerEditModal').modal('toggle');
                $('#computerEditForm')[0].reset();
            }
        });
    })
</script>
<!--Delete function-->
<script>
    function deleteComputer(computer_id)
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
                $('#sid'+computer_id).remove();
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
