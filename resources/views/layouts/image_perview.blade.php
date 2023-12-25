

<script>

    $('.image-upload-input').change(()=>{
        const file =  this.files[0];
        const previewer = $(this).closest('.image-preview'.find('img'));
        if(file){
            let reader = new FileReader();
            reader.onload = function(event){
                previewer.attr('src',event.target.result);
            }
            reader.readAsDataURL(file);
        }
    })

</script>
