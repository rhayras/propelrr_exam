<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />


    <title>Propelrr Exam</title>
    <style>
        .error-span {
            color: red;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <form method="POST" id="informationForm">
            <h3>Please enter information here.</h3>
            <div class="row mb-2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullName" id="fullName" class="form-control" />
                        <span class="error-span"></span>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="email" id="email" class="form-control" />
                        <span class="error-span"></span>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" maxlength="11" placeholder="09xxxxxxxxx" name="mobileNumber" id="mobileNumber" class="form-control" />
                        <span class="error-span"></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="text" name="bday" id="bday" class="form-control" onkeydown="return false" />
                        <span class="error-span"></span>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="text" name="age" id="age" class="form-control" onkeydown="return false" />
                        <span class="error-span"></span>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="float-end">
                <button type="submit" class="btn btn-primary btn-md btn-submit">Submit Information</button>
            </div>
            <div class="clearfix"></div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        function validation(element) {
            var good = true;
            if (element.val() == null || element.val() == "") {
                element.next(".error-span").html("This field is required");
                element.addClass('is-invalid');
                good = false;
            } else {
                element.next(".error-span").html("");
                element.removeClass('is-invalid');
            }
            return good;
            console.log(good);
        }

        function preventNumberInput(e) {
            var regex = new RegExp("^[a-zA-Z., ]+$");

            var charCode = (e.which) ? e.which : event.keyCode

            if (!String.fromCharCode(charCode).match(/[a-zA-Z., ]+$/g)) {
                event.preventDefault();
                return false;
            }

        }

        function emailValidation(element) {
            var value = element.val();
            var good = false;

            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (!filter.test(value)) {
                element.addClass('is-invalid');
                element.next(".error-span").html("Please enter valid email");
            } else {
                element.next(".error-span").html("");
                element.removeClass('is-invalid');
                good = true;
            }
            return good;
        }

        function getAge(dateString) {
            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        function contactValidation(element) {
            var good = true;
            var mobileNo = element.val();

            var prefix = mobileNo.substring(0, 2);
            if (prefix != "09") {
                element.next(".error-span").html("Invalid phone number. Follow this format 09xxxxxxxxx");
                element.addClass('is-invalid');
                good = false;
            } else {
                if (mobileNo.length < 11) {
                    element.next(".error-span").html("Invalid phone number. Follow this format 09xxxxxxxxx");
                    element.addClass('is-invalid');
                    good = false;
                } else {
                    element.next(".error-span").html("");
                    element.removeClass('is-invalid');
                }
            }
            return good;
        }

        $(document).ready(function() {

            $('#bday').datepicker({
                autoclose: true
            });

            $(document).on("keypress", "#fullName", function(e) {
                preventNumberInput(e);

            });

            $(document).on("blur", "#fullName,#email,#bday", function() {
                validation($(this));
            });

            $(document).on("keyup", "#email", function() {
                emailValidation($(this));
            });

            $(document).on("change", "#bday", function() {
                validation($(this));
                var val = (getAge($(this).val()) > 0) ? getAge($(this).val()) : 0;
                $("#age").val(val);
            });

            $(document).on("change", "#mobileNumber", function() {
                contactValidation($(this));
            });

            $('#mobileNumber').keypress(function(e) {

                var charCode = (e.which) ? e.which : event.keyCode

                if (String.fromCharCode(charCode).match(/[^0-9]/g))

                    return false;

            });

            $(document).on("submit", "#informationForm", function(e) {
                e.preventDefault();
                var formdata = $(this).serialize();
                var errorFlag = 0;

                if (!validation($("#fullName"))) {
                    errorFlag = 1;
                }

                if (!validation($("#email"))) {
                    errorFlag = 1;
                } else {
                    if (!emailValidation($("#email"))) {
                        errorFlag = 1;
                    }
                }

                if (!validation($("#mobileNumber"))) {
                    errorFlag = 1;
                } else {
                    if (!contactValidation($("#mobileNumber"))) {
                        errorFlag = 1;
                    }
                }

                if (!validation($("#bday"))) {
                    errorFlag = 1;
                }

                if (errorFlag == 1) {
                    alert("Please review your form again.");
                } else {
                    $.ajax({
                        url: 'action.php?action=saveInfo',
                        type: 'post',
                        data: formdata,
                        dataType: 'JSON',
                        beforeSend: function() {
                            $(".btn-submit").html("Please wait...");
                            $(".btn-submit").attr('disabled', true);
                        },
                        success: function(data) {
                            $(".btn-submit").html("Submit Information");
                            $(".btn-submit").attr('disabled', false);
                            if (data.success) {
                                alert("Information Saved!");
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                alert(data.msg);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var message = errorThrown;
                            if (jqXHR.responseText !== null && jqXHR.responseText !== 'undefined' && jqXHR.responseText !== '') {
                                message = jqXHR.responseText;
                            }
                            alert(messag + " ASD");
                        }
                    });
                }

            });

        });
    </script>

</body>

</html>