<?php 
    require('inc/essentials.php');
    require('inc/db_config.php');
    adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - STUDENT</title>
    <?php require('inc/links.php'); ?>
    <style>
        .btn-wrapper {
        margin-bottom: 5px; 
    }
    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php');  ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">STUDENT DATA</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <input type="text" oninput="search_student(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search by name">
                        </div>

                        <div class="table-responsive-lg" style="height: auto; max-height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light align-middle sticky-top" style="width: 100%;">
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Contact Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Permanent Address</th>
                                        <th scope="col">Desired Course</th>
                                        <th scope="col">Desired Branch</th>
                                        <th scope="col">Highest Qualification</th>
                                        <th scope="col">Institution Name</th>
                                        <th scope="col">Year of Passing</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Photograph</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="student-data">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
   
    <!-- Edit Student Modal -->
    <div class="modal fade" id="edit-student" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_student_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Student Data</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- form fields as provided -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>  
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Gender</label>
                                <input type="text" name="gender" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Contact Number</label>
                                <input type="number" name="mobile" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Permanent Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Desired Course</label>
                                <input type="text" name="course" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Desired Branch</label>
                                <input type="text" name="branch" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Highest Qualification</label>
                                <input type="text" name="qualification" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Institution Name</label>
                                <input type="text" name="inst_name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Year Of Passing</label>
                                <input type="number" name="passing" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Grade</label>
                                <input type="text" name="grade" class="form-control shadow-none" required>
                            </div>
                            
                            <input type="hidden" name="student_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" id="cancel-edit-student" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                    </div>
                </div> 
            </form>
        </div>
    </div>

    <?php require('inc/scripts.php'); ?> 
    <script src="scripts/users.js"></script>
</body>
</html>
