
function get_all_student() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('student-data').innerHTML = this.responseText;
    }

    xhr.send('get_all_student=true');
}

let edit_student_form = document.getElementById('edit_student_form');

function edit_details(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        if (data.studentdata) {
            edit_student_form.elements['name'].value = data.studentdata.full_name;
            edit_student_form.elements['dob'].value = data.studentdata.date_of_birth;
            edit_student_form.elements['gender'].value = data.studentdata.gender;
            edit_student_form.elements['mobile'].value = data.studentdata.contact_number;
            edit_student_form.elements['email'].value = data.studentdata.email;
            edit_student_form.elements['address'].value = data.studentdata.permanent_address;
            edit_student_form.elements['course'].value = data.studentdata.desired_course;
            edit_student_form.elements['branch'].value = data.studentdata.desired_branch;
            edit_student_form.elements['qualification'].value = data.studentdata.highest_qualification;
            edit_student_form.elements['inst_name'].value = data.studentdata.institution_name;
            edit_student_form.elements['passing'].value = data.studentdata.year_of_passing;
            edit_student_form.elements['grade'].value = data.studentdata.grade;
            edit_student_form.elements['student_id'].value = data.studentdata.id;

            var editStudentModal = new bootstrap.Modal(document.getElementById('edit-student'));
            editStudentModal.show();
        } else {
            alert('error','No student data found');
        }
    }

    xhr.send('get_student=' + id);
}

edit_student_form.addEventListener('submit', function(e) {
    e.preventDefault();
    submit_edit_student();
});

function submit_edit_student() {
    let data = new FormData(edit_student_form);
    data.append('edit_student', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);

    xhr.onload = function() {
        // var myModal = document.getElementById('edit-student');
        // var modal = bootstrap.Modal.getInstance(myModal);
        // modal.hide();

        if (this.responseText == 1) {
            alert('success','Student data edited successfully!');
            edit_student_form.reset();
            get_all_student();
            hideModal('edit-student');
            
        } else {
            alert('error','No changes made in the student data!');
            hideModal('edit-student');
        }
    }
    xhr.send(data);
}

document.getElementById('cancel-edit-student').addEventListener('click', function() {
    hideModal('edit-student');
});

function hideModal(modalId) {
    var myModal = document.getElementById(modalId);
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    removeModalBackdrop();
}

function removeModalBackdrop() {
    let backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) {
        backdrop.remove();
    }
    document.body.classList.remove('modal-open');
    document.body.style = '';
}

function get_student() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('student-data').innerHTML = this.responseText;
    }
    xhr.send('get_student=true');
}

function toggle_status(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success','Status toggled!');
            get_all_student();
        } else {
            alert('error','Server Down!');
        }
    }
    xhr.send('toggle_status=' + id + '&value=' + val);
}

function remove_student(student_id) {
    if (confirm("Are you sure, you want to remove this student data?")) {
        let data = new FormData();
        data.append('student_id', student_id);
        data.append('remove_student', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);

        xhr.onload = function() {
            if (this.responseText == 1) {
                alert('success','Student data deleted!');
                get_all_student();
            } else {
                alert('error','Student data deletion failed!');
            }
        }

        xhr.send(data);
    }
}

function search_student(username) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('student-data').innerHTML = this.responseText;
    }

    xhr.send('search_student=true&full_name=' + encodeURIComponent(username));
}

function downloadPDF(student_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status === 200) {
            let link = document.createElement('a');
            link.href = 'data:application/pdf;base64,' + this.responseText;
            link.download = 'student_details_' + student_id + '.pdf';
            link.click();
        } else {
            alert('error','Failed to download PDF');
        }
    }

    xhr.send('download_pdf=' + student_id);
}

window.onload = function() {
    get_all_student();
}







