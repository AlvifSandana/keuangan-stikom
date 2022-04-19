<script>
    function saveSetting(id){
        var data = {
            id_setting: id,
            value: $('#val').val()
        };
        $.ajax({
            url: '<?= base_url()?>/settings-application/apply',
            method: 'POST',
            dataType: 'JSON',
            data: data,
            success: function(data){
                if(data.status == 'success'){
                    showSWAL('success', data.message);
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                } else {
                    showSWAL('error', data.message);
                }
            },
            error: function(jqXHR){

            }
        });
    }
</script>