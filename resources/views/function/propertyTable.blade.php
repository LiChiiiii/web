<!--------------------FUNCTION-------------------->
<script  src="https://code.jquery.com/jquery-3.5.1.min.js"  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="   crossorigin="anonymous"></script>
<!-- preview image function-->
<script>
    function previewFile(input){
        var file=$("input[type=file]").get(0).files[0];
        if(file)
        {
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewImg').attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<!--Change Status function-->
<script>
    function editProperty(property_id)
    {
        if(confirm("確定更改為「已領取」？"))
        {
            $.ajax({
            url: 'lost_property/'+property_id+'/update' ,
            type: "PUT",
            data:{
                _token : $("input[name=_token]").val()
            },
            error:function(response){
                console.log('編輯失敗');
            },
            success:function(response)
            {
                $('#sid'+property_id+' td:nth-child(5)').text(response.status);
            }
        }); 

        }
    }
</script>


<!--Delete function-->
<script>
    function deleteProperty(property_id)
    {
        if(confirm("確定刪除此筆資料？"))
        {
            $.ajax({
            url: 'lost_property/'+property_id+'/delete' ,
            type: "DELETE",
            data:{
                _token : $("input[name=_token]").val()
            },
            error:function(response){
                console.log('刪除失敗');
            },
            success:function(response)
            {
                $('#sid'+property_id).remove();
            }
        }); 

        }
    }
</script>