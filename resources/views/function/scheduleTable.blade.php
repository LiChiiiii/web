<!--------------------MODAL-------------------->
<!-- Edit Modal -->
<div class="modal fade" id="scheduleEditModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit schedule</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="scheduleEditForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <input type="hidden" id="schedule_id" name="schedule_id" />
                <div class="form-group">
                    <label for="Time">TIME：</label>
                    <input class="title" id="work_time" name="work_time" style="border: none; font-size:20px" disabled/>
                </div>
                <div class="form-group">
                    <label for="Mon">Mon</label>
                    <input type="text" class="form-control" id="Mon" name="Mon" />
                </div>
                <div class="form-group">
                    <label for="Tue">Tue</label>
                    <input type="text" class="form-control" id="Tue" name="Tue" />
                </div>
                <div class="form-group">
                    <label for="Wed">Wed</label>
                    <input type="text" class="form-control" id="Wed" name="Wed" />
                </div>
                <div class="form-group">
                    <label for="Thu">Thu</label>
                    <input type="text" class="form-control" id="Thu" name="Thu" />
                </div>
                <div class="form-group">
                    <label for="Fri">Fri</label>
                    <input type="text" class="form-control" id="Fri" name="Fri" />
                </div>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!--------------------FUNCTION-------------------->
<!-- Edit function-->
<script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="   crossorigin="anonymous"></script>
<script>
    function editSchedule(schedule_id)
    {
        $.get('schedule/'+schedule_id+'/sche_edit', function(response){
            $("#schedule_id").val(response.schedule_id);
            $("#work_time").val(response.work_time);
            $("#Mon").val(response.Mon);
            $("#Tue").val(response.Tue);
            $("#Wed").val(response.Wed);
            $("#Thu").val(response.Thu);
            $("#Fri").val(response.Fri);
            $("#scheduleEditModal").modal('toggle');
        
        })
    }

    $("#scheduleEditForm").submit(function(e){
        e.preventDefault();

        let schedule_id = $("#schedule_id").val();
        let work_time = $("#work_time").val();
        let Mon = $("#Mon").val();
        let Tue = $("#Tue").val();
        let Wed = $("#Wed").val();
        let Thu = $("#Thu").val();
        let Fri = $("#Fri").val();
        let _token = $("input[name=_token]").val();
        
        $.ajax({
            url: "{{ route('schedule.update') }}",
            type: "PUT",
            data:{
                schedule_id:schedule_id,
                work_time:work_time,
                Mon:Mon,
                Tue:Tue,
                Wed:Wed,
                Thu:Thu,
                Fri:Fri,
                _token:_token,
                
            },
            error:function(response){
                console.log(response);
            },
            success:function(response)
            {
                console.log('編輯成功');
                $('#sid'+response.schedule_id+' td:nth-child(2)').text(response.Mon);
                $('#sid'+response.schedule_id+' td:nth-child(3)').text(response.Tue);
                $('#sid'+response.schedule_id+' td:nth-child(4)').text(response.Wed);
                $('#sid'+response.schedule_id+' td:nth-child(5)').text(response.Thu);
                $('#sid'+response.schedule_id+' td:nth-child(6)').text(response.Fri);
                $('#scheduleEditModal').modal('toggle');
                $('#scheduleEditForm')[0].reset();
            }
        });
    })
</script>