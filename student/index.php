
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Student Admission Form 2024</title>  
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgb(32, 29, 31);
            text-align: center;
            color: white;
            padding: 10px 0;
        } 
    </style> 
</head>
    <body class="bg-light">
       
        <header class="bg-primary text-white text-center py-3 sticky-top">
            <h1 class="h4 h3-md">Student Admission Form 2024</h1>
        </header>
        <div class="container mt-5 mb-5">
                <div class="d-flex justify-content-center mb-3 mt-3">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#admissionFormContainer" aria-expanded="false" aria-controls="admissionFormContainer">
                        Admission Enquiry <i class="bi bi-arrow-down-right-square"></i>
                    </button>
                </div>
            <div class="collapse mt-3" id="admissionFormContainer">
                <div class="card card-body">
                    <form id="admissionForm" enctype="multipart/form-data" action="submit_form.php" method="POST">
                        <!-- Section 1: Personal Details -->
                        <h4>Personal Details</h4>
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="tel" class="form-control" id="contactNumber" name="contact_number" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
    
                        <!-- Section 2: Address Details -->
                        <h4>Address Details</h4>
                        <div class="form-group">
                            <label for="permStreet">Street</label>
                            <input type="text" class="form-control" id="permStreet" name="perm_street" required>
                        </div>
                        <div class="form-group">
                            <label for="permCity">City</label>
                            <input type="text" class="form-control" id="permCity" name="perm_city" required>
                        </div>
                        <div class="form-group">
                            <label for="permState">State</label>
                            <input type="text" class="form-control" id="permState" name="perm_state" required>
                        </div>
                        <div class="form-group">
                            <label for="permPostalCode">Postal Code</label>
                            <input type="text" class="form-control" id="permPostalCode" name="perm_postal_code" required>
                        </div>
                        
                        <!-- Section 3: Class/Course Details -->
                        <h4>Course & Branch</h4>
                        <div class="form-group">
                            <label for="desiredCourse">Desired Course</label>
                            <input type="text" class="form-control" id="desiredCourse" name="desired_course" required>
                        </div>
                        <div class="form-group">
                            <label for="desiredBranch">Desired Branch</label>
                            <input type="text" class="form-control" id="desiredBranch" name="desired_branch" required>
                        </div>
    
                        <!-- Section 4: Previous Qualifications -->
                        <h4>Previous Qualification</h4>
                        <div class="form-group">
                            <label for="highestQualification">Highest Qualification</label>
                            <input type="text" class="form-control" id="highestQualification" name="highest_qualification" required>
                        </div>
                        <div class="form-group">
                            <label for="institutionName">Institution Name</label>
                            <input type="text" class="form-control" id="institutionName" name="institution_name" required>
                        </div>
                        <div class="form-group">
                            <label for="yearOfPassing">Year of Passing</label>
                            <input type="number" class="form-control" id="yearOfPassing" name="year_of_passing" required>
                        </div>
                        <div class="form-group">
                            <label for="grade">Grade/Percentage</label>
                            <input type="text" class="form-control" id="grade" name="grade" required>
                        </div>
    
                        <!-- Section 5: Photograph Upload -->
                        <h4>Upload Photo</h4>
                        <div class="form-group">
                            <label for="photograph">Photograph Upload</label>
                            <input type="file" class="form-control-file" id="photograph" name="photograph" required>
                        </div>
                        
                        <div class="d-flex justify-content-center justify-content-md-start mt-3 mb-5">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        <div class="footer">
            <p class="p-1">Design & Developed by WeKnowTechnology.<br>
               © Copyright 2024. ALL RIGHTS RESERVED.
            </p>
        </div>
    
       
        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="form.js"></script>
    
    </body>
    </html>


