<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Upload Gallery Media</h1>

            <?php
            include '../../db.connection/db_connection.php';

            if (isset($_POST['upload_media'])) {
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $media_type = $_POST['media_type'];
                $category_id = $_POST['category_id'];
                $file = $_FILES['media_file'];

                $target_dir = "../uploads/gallery/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }

                $file_ext = pathinfo($file["name"], PATHINFO_EXTENSION);
                $db_filename = uniqid('media_') . '.' . $file_ext; // JUST the filename
                $target_file = $target_dir . $db_filename;

                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    // SAVE ONLY $db_filename
                    $sql = "INSERT INTO media_table (category_id, media_type, file_path, title) 
                            VALUES ('$category_id', '$media_type', '$db_filename', '$title')";
                    if ($conn->query($sql)) {
                        echo '<div class="alert alert-success">Uploaded successfully!</div>';
                    }
                }
            }
            ?>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="upload_media.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Type</label>
                                <select name="media_type" class="form-control">
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" required>
                                    <?php
                                    $cats = $conn->query("SELECT * FROM categories_table");
                                    while ($c = $cats->fetch_assoc()) {
                                        echo "<option value='{$c['id']}'>{$c['category_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="media_file" class="form-control-file" required>
                        </div>
                        <button type="submit" name="upload_media" class="btn btn-primary btn-block">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</div>

<script>
    // Logic to switch accepted file types dynamically
    function toggleFileType() {
        const type = document.getElementById('media_type').value;
        const fileInput = document.getElementById('mediaFile');
        const helpText = document.getElementById('fileHelp');

        if (type === 'image') {
            fileInput.accept = "image/*";
            helpText.innerHTML = "Supported: JPG, PNG, WEBP for Images.";
        } else {
            fileInput.accept = "video/mp4,video/webm,video/ogg";
            helpText.innerHTML = "Supported: MP4, WEBM for Videos.";
        }
    }

    // Bootstrap custom file input display fix
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("mediaFile").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>