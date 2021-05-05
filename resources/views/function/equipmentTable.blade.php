<!--Edit Modal-->
<div class="modal fade" id="equipmentEditModal" tabindex="-1" role="dialog" aria-labelledby="equipmentEditModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="equipmentEditModalTitle">Edit Equipment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="equipmentEditForm">
                @csrf   
                <!--防止跨網站提交表單(從原始碼可看到加入一個token,確保表單來自我們自己的網站-->
                <input type="hidden" id="equipment_id" name="equipment_id" />
                <div class="form-group">
                    <label for="equip_name">Equipment</label>
                    <input type="text" class="form-control" id="equip_name" name="equip_name" disabled>
                </div>
                <div class="form-group">
                    <label for="equip_status">Status</label>
                    <select class="form-control" id="equip_status" name="equip_status">
                        <option>正常使用</option>
                        <option>有問題尚未報修</option>
                        <option>已報修</option>
                    </select>
                </div>
            <button type="submit" class="btn btn-primary pull-right">Save changes</button>          
        </form>
    </div>

    </div>
</div>
</div>

<!-- Edit function-->
<script>
    function editEquipment(equipment_id)
    {
        $.get(equipment_id+'/equip_edit', function(response){
            $("#equipment_id").val(response.equipment_id);
            $("#equip_name").val(response.name);
            $("#equip_status").val(response.status);
            $("#equipmentEditModal").modal('toggle');   
        })
        
    }
    $("#equipmentEditForm").submit(function(e){
        e.preventDefault();
        

        let equipment_id = $("#equipment_id").val();
        let name = $("#equip_name").val();
        let status = $("#equip_status").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('equipment.update') }}",
            type: "PUT",
            data:{
                equipment_id:equipment_id,
                name:name,
                status:status,
                _token:_token,
                
            },
            error:function(response){
                console.log('編輯失敗');
            },
            success:function(response)
            {
                $('#eid'+response.equipment_id+' td:nth-child(2)').text(response.status);
                $('#equipmentEditModal').modal('toggle');
                $('#equipmentEditForm')[0].reset();
            }
        });
    })
</script>
