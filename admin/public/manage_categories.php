<?php include 'header.php'; ?>

<?php include 'sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php include 'navbar.php'; ?>
        
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Media Category Management</h1>
            </div>

            <?php
            include '../../db.connection/db_connection.php';

            // Logic for Add/Update/Delete remains the same as previous step
            if (isset($_POST['add_category'])) {
                $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
                if (!empty($category_name)) {
                    $conn->query("INSERT INTO categories_table (category_name) VALUES ('$category_name')");
                    echo '<div class="alert alert-success alert-dismissible fade show">Category added. <button type="button" class="close" data-dismiss="alert">&times;</button></div>';
                }
            }

            if (isset($_POST['update_category'])) {
                $id = intval($_POST['cat_id']);
                $new_name = mysqli_real_escape_string($conn, $_POST['category_name']);
                $conn->query("UPDATE categories_table SET category_name = '$new_name' WHERE id = $id");
                echo '<div class="alert alert-info alert-dismissible fade show">Category updated. <button type="button" class="close" data-dismiss="alert">&times;</button></div>';
            }

            if (isset($_GET['delete_id'])) {
                $id = intval($_GET['delete_id']);
                $conn->query("DELETE FROM categories_table WHERE id = $id");
                echo '<div class="alert alert-warning alert-dismissible fade show">Category removed. <button type="button" class="close" data-dismiss="alert">&times;</button></div>';
            }
            ?>

            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Add New Filter Category</h6></div>
                        <div class="card-body">
                            <form action="manage_categories.php" method="POST">
                                <div class="form-group">
                                    <label class="text-dark">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" placeholder="e.g. Shipbuilding" required>
                                </div>
                                <button type="submit" name="add_category" class="btn btn-info btn-block shadow-sm"><i class="fas fa-plus fa-sm"></i> Save Category</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Existing Categories</h6></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover border-left-info" width="100%" cellspacing="0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 10%;">S.No</th>
                                            <th>Category Name</th>
                                            <th class="text-center" style="width: 25%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM categories_table ORDER BY id DESC";
                                        $result = $conn->query($query);
                                        
                                        // Initialize the Serial Number Counter
                                        $sno = 1; 

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <td class='text-gray-600 font-weight-bold'>{$sno}</td>
                                                        <td class='font-weight-bold text-dark'>{$row['category_name']}</td>
                                                        <td class='text-center'>
                                                            <button class='btn btn-primary btn-circle btn-sm shadow-sm editBtn' 
                                                                    data-id='{$row['id']}' 
                                                                    data-name='{$row['category_name']}' 
                                                                    data-toggle='modal' data-target='#editModal'>
                                                                <i class='fas fa-edit'></i>
                                                            </button>
                                                            <a href='manage_categories.php?delete_id={$row['id']}' 
                                                               class='btn btn-danger btn-circle btn-sm shadow-sm' 
                                                               onclick='return confirm(\"Are you sure?\")'>
                                                                <i class='fas fa-trash'></i>
                                                            </a>
                                                        </td>
                                                      </tr>";
                                                $sno++; // Increment S.No for the next row
                                            }
                                        } else {
                                            echo "<tr><td colspan='3' class='text-center'>No categories found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Edit Category Name</h5>
                <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
            </div>
            <form action="manage_categories.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="cat_id" id="edit_id">
                    <div class="form-group">
                        <label>New Category Name</label>
                        <input type="text" name="category_name" id="edit_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="update_category">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Logic to populate edit modal
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('edit_id').value = this.getAttribute('data-id');
        document.getElementById('edit_name').value = this.getAttribute('data-name');
    });
});
</script>