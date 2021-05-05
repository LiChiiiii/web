<!--------------------MODAL-------------------->
<!-- Edit Modal -->
<div class="modal fade" id="patrolEditModal" tabindex="-1" role="dialog" aria-labelledby="patrolModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit patrol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="patrolEditForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <input type="hidden" id="patrol_id" name="patrol_id" />
                <div class="form-group">
                    <label for="patrol_time1">Patrol Time</label>
                    <input type="text" class="form-control" id="patrol_time1" name="patrol_time1" />
                </div>
                <div class="form-group">
                    <label for="patrol_status1">Status</label>
                    <textarea class="form-control" id="patrol_status1" name="patrol_status1" rows="5"></textarea>
                </div>
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
    $("#patrolForm").submit(function(e){
        e.preventDefault();

        let staff = $("#staff").val();
        let patrol_time = $("#patrol_date").val()+' '+$("#patrol_time").val();
        let status = $("#status").val();
        let _token = $("input[name=_token]").val();
    
        $.ajax({
            url: "{{ route('patrol.create' ) }}",
            type: "POST",
            data:{
                staff:staff,
                patrol_time:patrol_time,
                status:status,
                _token:_token,
            },
            error:function(response){
                console.log(response);
            },
            success:function(response)
            {
                $("#patrolTable tbody").prepend('<tr><td>'+response.staff+'</td><td>'+response.patrol_time+'</td><td>'+response.status+'</td><td class="text-center">'
                                                    +'<a href="javascript:void(0)" onclick="editpatrol({{$patrol->patrol_id}})"class="btn btn-info">Edit</a>  '
                                                    +'<a href="javascript:void(0)" onclick="deletepatrol({{$patrol->patrol_id}})" class="btn btn-danger">Delete</a></td></tr>')
                $("#patrolForm")[0].reset();
            }

        }); 
    })
</script>


<!-- Edit function-->
<script>
    function editPatrol(patrol_id)
    {
        $.get('patrol/'+patrol_id+'/patrol_edit', function(response){
            $("#patrol_id").val(response.patrol_id);
            $("#patrol_time1").val(response.patrol_time);
            $("#patrol_status1").val(response.status);
            $("#patrolEditModal").modal('toggle');
        
        })
    }

    $("#patrolEditForm").submit(function(e){
        e.preventDefault();

        let patrol_id = $("#patrol_id").val();
        let patrol_time = $("#patrol_time1").val();
        let status = $("#patrol_status1").val();
        let _token = $("input[name=_token]").val();
        
        $.ajax({
            url: "{{ route('patrol.update') }}",
            type: "PUT",
            data:{
                patrol_id:patrol_id,
                patrol_time:patrol_time,
                status:status,
                _token:_token,
                
            },
            error:function(response){
                console.log("編輯失敗");
            },
            success:function(response)
            {
                $('#sid'+response.patrol_id+' td:nth-child(1)').text(response.staff);
                $('#sid'+response.patrol_id+' td:nth-child(2)').text(response.patrol_time);
                $('#sid'+response.patrol_id+' td:nth-child(3)').text(response.status);
                $('#patrolEditModal').modal('toggle');
                $('#patrolEditForm')[0].reset();
            }
        });
    })
</script>

<!--Delete function-->
<script>
    function deletePatrol(patrol_id)
    {
        if(confirm("Are you sure?"))
        {
            $.ajax({
            url: 'patrol/'+patrol_id+'/delete' ,
            type: "DELETE",
            data:{
                _token : $("input[name=_token]").val()
            },
            error:function(response){
                console.log('刪除失敗');
            },
            success:function(response)
            {
                $('#sid'+patrol_id).remove();
            }
        }); 

        }
    }
</script>