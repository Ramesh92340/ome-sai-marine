<?php
include '../../db.connection/db_connection.php';

// --- 1. HANDLE UPDATE LOGIC (Runs before HTML) ---
if (isset($_POST['update_media'])) {
    $id = intval($_POST['media_id']);
    $new_title = mysqli_real_escape_string($conn, $_POST['title']);
    $new_cat = intval($_POST['category_id']);
    $new_type = $_POST['media_type'];

    // Check if a NEW file was uploaded
    if (!empty($_FILES['media_file']['name'])) {

        // A. Delete OLD file from folder
        $old_res = $conn->query("SELECT file_path FROM media_table WHERE id = $id");
        $old_data = $old_res->fetch_assoc();
        if ($old_data) {
            $old_path = "../uploads/gallery/" . $old_data['file_path'];
            if (file_exists($old_path)) {
                unlink($old_path);
            }
        }

        // B. Upload NEW file
        $target_dir = "../uploads/gallery/";
        $file_ext = pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION);
        $db_filename = uniqid('media_') . '.' . $file_ext;
        $target_file = $target_dir . $db_filename;

        if (move_uploaded_file($_FILES['media_file']['tmp_name'], $target_file)) {
            $sql = "UPDATE media_table SET title='$new_title', category_id=$new_cat, media_type='$new_type', file_path='$db_filename' WHERE id=$id";
        }
    } else {
        // No new file, update text only
        $sql = "UPDATE media_table SET title='$new_title', category_id=$new_cat, media_type='$new_type' WHERE id=$id";
    }

    $conn->query($sql);
    header("Location: all_media.php?msg=updated");
    exit();
}

// --- 2. HANDLE DELETE LOGIC ---
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $file_query = $conn->query("SELECT file_path FROM media_table WHERE id = $id");
    $file_data = $file_query->fetch_assoc();

    if ($file_data) {
        $full_path = "../uploads/gallery/" . $file_data['file_path'];
        if (file_exists($full_path)) {
            unlink($full_path);
        }
        $conn->query("DELETE FROM media_table WHERE id = $id");
        header("Location: all_media.php?msg=deleted");
        exit();
    }
}
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include 'navbar.php'; ?>

        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Gallery Management</h1>
                <a href="upload_media.php" class="btn btn-primary btn-sm shadow-sm">
                    <i class="fas fa-upload fa-sm text-white-50"></i> Upload New Media
                </a>
            </div>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    Action completed successfully!
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Uploaded Images & Videos</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th style="width: 5%;">S.No</th>
                                    <th style="width: 15%;">Preview</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT m.*, c.category_name 
                                          FROM media_table m 
                                          LEFT JOIN categories_table c ON m.category_id = c.id 
                                          ORDER BY m.id DESC";
                                $result = $conn->query($query);
                                $sno = 1;

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Path construction for the browser
                                        $display_path = "../uploads/gallery/" . $row['file_path'];
                                ?>
                                        <tr>
                                            <td class="font-weight-bold"><?php echo $sno++; ?></td>
                                            <td>
                                                <?php if ($row['media_type'] == 'image'): ?>
                                                    <a href="<?php echo $display_path; ?>" target="_blank">
                                                        <img src="<?php echo $display_path; ?>" class="rounded shadow-sm" style="width: 100px; height: 60px; object-fit: cover;">
                                                    </a>
                                                <?php else: ?>
                                                    <video width="120" height="70" controls muted class="rounded shadow-sm bg-dark">
                                                        <source src="<?php echo $display_path; ?>" type="video/mp4">
                                                        <source src="<?php echo $display_path; ?>" type="video/webm">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-dark"><?php echo $row['title']; ?></td>
                                            <td><span class="badge badge-info"><?php echo $row['category_name'] ?? 'Uncategorized'; ?></span></td>
                                            <td><span class="text-uppercase small font-weight-bold"><?php echo $row['media_type']; ?></span></td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-circle btn-sm editMediaBtn"
                                                    data-id="<?php echo $row['id']; ?>"
                                                    data-title="<?php echo $row['title']; ?>"
                                                    data-cat="<?php echo $row['category_id']; ?>"
                                                    data-type="<?php echo $row['media_type']; ?>"
                                                    data-toggle="modal" data-target="#editMediaModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="all_media.php?delete_id=<?php echo $row['id']; ?>"
                                                    class="btn btn-danger btn-circle btn-sm"
                                                    onclick="return confirm('Delete this file permanently?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No media uploaded yet.</td></tr>";
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</div>

<div class="modal fade" id="editMediaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-left-primary shadow">
            <div class="modal-header">
                <h5 class="modal-title text-primary font-weight-bold">Edit Media Details</h5>
                <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="all_media.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="media_id" id="m_id">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="text-dark font-weight-bold">Title / Caption</label>
                            <input type="text" name="title" id="m_title" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-dark font-weight-bold">Media Type</label>
                            <select name="media_type" id="m_type" class="form-control" onchange="updateEditFileType()">
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-dark font-weight-bold">Change Category</label>
                            <select name="category_id" id="m_cat" class="form-control" required>
                                <?php
                                $cat_res = $conn->query("SELECT * FROM categories_table ORDER BY category_name ASC");
                                while ($cat = $cat_res->fetch_assoc()) {
                                    echo "<option value='{$cat['id']}'>{$cat['category_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class="p-3 bg-light border rounded">
                                <label class="text-primary font-weight-bold">Replace Media File (Optional)</label>
                                <input type="file" name="media_file" id="edit_file_input" class="form-control-file">
                                <small class="text-muted">Keep empty to keep the current file. Choosing a new file deletes the old one.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="update_media">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.editMediaBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('m_id').value = this.getAttribute('data-id');
            document.getElementById('m_title').value = this.getAttribute('data-title');
            document.getElementById('m_cat').value = this.getAttribute('data-cat');
            document.getElementById('m_type').value = this.getAttribute('data-type');

            updateEditFileType(); // Adjust file accept types
        });
    });

    function updateEditFileType() {
        const type = document.getElementById('m_type').value;
        const fileInput = document.getElementById('edit_file_input');
        fileInput.accept = (type === 'image') ? "image/*" : "video/mp4,video/webm";
    }
</script>