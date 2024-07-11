
<?php 

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    require_once('../tcpdf/tcpdf.php');
    adminLogin();


    if (isset($_POST['get_student'])) {
        $frm_data = filteration($_POST);
        $res = select("SELECT * FROM `student_data` WHERE `id`=?", [$frm_data['get_student']], 'i');
        $studentdata = mysqli_fetch_assoc($res);

        $data = ["studentdata" => $studentdata];
        echo json_encode($data);
    }

    if (isset($_POST['edit_student'])) {
        $frm_data = filteration($_POST);
        $flag = 0;

        $q = "UPDATE `student_data` SET `full_name`=?, `date_of_birth`=?, `gender`=?, `contact_number`=?, `email`=?, `permanent_address`=?, `desired_course`=?, `desired_branch`=?, `highest_qualification`=?, `institution_name`=?, `year_of_passing`=?, `grade`=? WHERE `id`=?";
        $values = [$frm_data['name'], $frm_data['dob'], $frm_data['gender'], $frm_data['mobile'], $frm_data['email'], $frm_data['address'], $frm_data['course'], $frm_data['branch'], $frm_data['qualification'], $frm_data['inst_name'], $frm_data['passing'], $frm_data['grade'], $frm_data['student_id']];

        if (update($q, $values, 'ssssssssssssi')) {
            $flag = 1;
        }

        echo $flag;
    }

    if (isset($_POST['get_all_student'])) {
        $res = selectAll('student_data');
        $i = 1;
        $path = USERS_IMG_PATH;
        $data = "";

        while ($row = mysqli_fetch_assoc($res)) {
            $del_btn = "<div class='btn-wrapper'><button type='button' onclick='remove_student($row[id])' class='btn btn-danger btn-sm'>
            <i class='bi bi-trash'></i>
            </button></div>";

            $edit_btn = "<div class='btn-wrapper'><button type='button' onclick='edit_details($row[id])' class='btn btn-primary btn-sm shadow-none' data-bs-toggle='modal' data-bs-target='#edit-student'>
            <i class='bi bi-pencil-square'></i>
            </button></div>";

            $down_btn = "<div class='btn-wrapper'><button type='button' onclick='downloadPDF($row[id])' class='btn btn-primary btn-sm shadow-none'>
            <i class='bi bi-file-earmark-arrow-down'></i>
            </button></div>";

            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-sm btn-dark shadow-none'>
            approved
            </button>";
            if (!$row['status']) {
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-sm btn-danger shadow-none'>
                pending...
                </button>";
            }

            $data .= "
                <tr>
                    <td>$i</td>
                    <td>$row[full_name]</td>
                    <td>$row[date_of_birth]</td>
                    <td>$row[gender]</td>
                    <td>$row[contact_number]</td>
                    <td>$row[email]</td>
                    <td>$row[permanent_address]</td>
                    <td>$row[desired_course]</td>
                    <td>$row[desired_branch]</td>
                    <td>$row[highest_qualification]</td>
                    <td>$row[institution_name]</td>
                    <td>$row[year_of_passing]</td>
                    <td>$row[grade]</td>
                    <td><img src='$path$row[photograph]' width='55px'></td>
                    <td>$status</td>
                    <td>
            
                        $del_btn
                        $edit_btn
                        $down_btn

                    </td>
                </tr>
            ";
            $i++;
        }

        echo $data;
    }

    if(isset($_POST['toggle_status'])) 
    {
        $frm_data  = filteration($_POST);

        $q = "UPDATE `student_data` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'],$frm_data['toggle_status']];

        if(update($q,$v,'ii')){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if (isset($_POST['remove_student'])) {
        $frm_data = filteration($_POST);
        $values = [$frm_data['student_id']];

        $q = "DELETE FROM `student_data` WHERE `id`=?";
        if (delete($q, $values, 'i')) {
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['search_student'])) {
        $frm_data = filteration($_POST);
        $query = "SELECT * FROM `student_data` WHERE `full_name` LIKE ?";
        $values = ["%$frm_data[full_name]%"];
        $res = select($query, $values, 's');
        $path = USERS_IMG_PATH;
        $i = 1;
        $data = "";

        while ($row = mysqli_fetch_assoc($res)) {
            $del_btn = "<div class='btn-wrapper'><button type='button' onclick='remove_student($row[id])' class='btn btn-danger btn-sm'>
            <i class='bi bi-trash'></i>
            </button></div>";

            $edit_btn = "<div class='btn-wrapper'><button type='button' onclick='edit_details($row[id])' class='btn btn-primary btn-sm shadow-none' data-bs-toggle='modal' data-bs-target='#edit-student'>
            <i class='bi bi-pencil-square'></i>
            </button></div>";

            $down_btn = "<div class='btn-wrapper'><button type='button' onclick='downloadPDF($row[id])' class='btn btn-primary btn-sm shadow-none'>
            <i class='bi bi-file-earmark-arrow-down'></i>
            </button></div>";

            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-sm btn-dark shadow-none'>
            approved
            </button>";
            if (!$row['status']) {
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-sm btn-danger shadow-none'>
                pending...
                </button>";
            }

            $data .= "
                <tr>
                    <td>$i</td>
                    <td>$row[full_name]</td>
                    <td>$row[date_of_birth]</td>
                    <td>$row[gender]</td>
                    <td>$row[contact_number]</td>
                    <td>$row[email]</td>
                    <td>$row[permanent_address]</td>
                    <td>$row[desired_course]</td>
                    <td>$row[desired_branch]</td>
                    <td>$row[highest_qualification]</td>
                    <td>$row[institution_name]</td>
                    <td>$row[year_of_passing]</td>
                    <td>$row[grade]</td>
                    <td><img src='$path$row[photograph]' width='55px'></td>
                    <td>$status</td>
                    <td>
        
                        $del_btn
                        $edit_btn
                        $down_btn
                        
                    </td>
                </tr>
            ";
            $i++;
        }

        echo $data;
    }

    function generateStudentPDF($id, $conn) {
        $query = "SELECT * FROM student_data WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Student Management System');
        $pdf->SetTitle('Student Admission Form Details');
        $pdf->SetSubject('Student Admission Form Details');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // create html content
        $html = '
        <h2>Student Admission Form Details</h2>
        <table border="1" cellpadding="4">
            <tr>
                <td><strong>Full Name</strong></td>
                <td>' . $student['full_name'] . '</td>
            </tr>
            <tr>
                <td><strong>Date of Birth</strong></td>
                <td>' . $student['date_of_birth'] . '</td>
            </tr>
            <tr>
                <td><strong>Gender</strong></td>
                <td>' . $student['gender'] . '</td>
            </tr>
            <tr>
                <td><strong>Contact Number</strong></td>
                <td>' . $student['contact_number'] . '</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>' . $student['email'] . '</td>
            </tr>
            <tr>
                <td><strong>Permanent Address</strong></td>
                <td>' . $student['permanent_address'] . '</td>
            </tr>
            <tr>
                <td><strong>Desired Course</strong></td>
                <td>' . $student['desired_course'] . '</td>
            </tr>
            <tr>
                <td><strong>Desired Branch</strong></td>
                <td>' . $student['desired_branch'] . '</td>
            </tr>
            <tr>
                <td><strong>Highest Qualification</strong></td>
                <td>' . $student['highest_qualification'] . '</td>
            </tr>
            <tr>
                <td><strong>Institution Name</strong></td>
                <td>' . $student['institution_name'] . '</td>
            </tr>
            <tr>
                <td><strong>Year of Passing</strong></td>
                <td>' . $student['year_of_passing'] . '</td>
            </tr>
            <tr>
                <td><strong>Grade</strong></td>
                <td>' . $student['grade'] . '</td>
            </tr>
        </table>';

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // close and output PDF document
        $pdfContent = $pdf->Output('student_details.pdf', 'S');

        return base64_encode($pdfContent);
    }

    if (isset($_POST['download_pdf'])) {
        $frm_data = filteration($_POST);
        $pdfData = generateStudentPDF($frm_data['download_pdf'], $conn);
        echo $pdfData;
    }

    
?>




   