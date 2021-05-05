<script>
    $('.custom-control-input').change(function(){
        var status = $(this).prop('checked') == true ? 1 : 0 ;
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('classroom.changeStatus') }}",
            type: "GET",
            dataType: "json",
            data: 
            {
                status:status,
                id:id
            },
            error:function(response){
                console.log('change failed')
            },
            success: function(response){
                if(response.status==0)
                $('#description'+response.id).text('CLOSE');
                else
                $('#description'+response.id).text('OPEN');
            }
            

        });

    });

</script>