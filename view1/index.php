<!DOCTYPE html>
<html>
<head>
    <title>summerNote</title>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
</head>
<body>
<br /><br />
<div class="container" style="width:700px;">
    <form method="post">
        <h2 align="center">summerNote</h2>
        <br />
        <label>Select Image</label>
        <input type="file" name="file" id="file" />
        <br />
        <textarea id="summernote" name="editordata">
                    <span id="uploaded_image"></span>
        </textarea>
    </form>
</div>
</body>
</html>

<script>
    $(document).ready(function(){
        $('#summernote').summernote();
        $(document).on('change', '#file', function(){
            var name = document.getElementById("file").files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
            {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("file").files[0]);
            var f = document.getElementById("file").files[0];
            var fsize = f.size||f.fileSize;
            if(fsize > 2000000)
            {
                alert("Image File Size is very big");
            }
            else
            {
                form_data.append("file", document.getElementById('file').files[0]);
                $.ajax({
                    url:"upload.php",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                        $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                    },
                    success:function(data)
                    {
                       for (var i=1;i<data.length;i++){
                          $("#uploaded_image").html(data);

//                           $('#summernote').html("<span id='uploaded_image'>"+data+"</span>");
                       }
                    }
                });
            }
        });
    });
</script>
