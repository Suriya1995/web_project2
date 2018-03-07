<script>
    var cls = new Call_Service();
    var card_id = '<?= $_SESSION["card_id"]; ?>';
    var username = '<?= $_SESSION["username"]; ?>';
    var password = '<?= $_SESSION["password"]; ?>';
    $(document).ready(function () {
        $("#username").focus(function () {
            $('#error-username').fadeOut(100);
        });
        $("#password").focus(function () {
            $('#error-password').fadeOut(100);
            $('#error-new-pass').fadeOut(100);
        });
        $('#old_pass').focus(function () {
            $('#error-old-pass').fadeOut(100);
        });
        $("#confirm").focus(function () {
            $('#error-confirm-pass').fadeOut(100);
        });
    });
    function btn_login(LOGIN) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            // code for IE6, IE5
        }
        var value = "FN=" + LOGIN
                + "&username=" + $('input[name=username]').val()
                + "&password=" + $('input[name=password]').val();
        xmlhttp.open("POST", "PS_processDB/login_DB.php", true);
//    xmlhttp.addEventListener("load", btn_login); โหลดฟังชันก์เรียกอีกครั้ง
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(value);
        xmlhttp.onreadystatechange = function () {

            if (this.readyState == 3)  // Loading Request
            {
                $('#chkststus').html('Now Loading...');
                $(".loading").hide();
            }
            if (this.readyState == 4 && this.status == 200) {
                if (xmlhttp.responseText == "ok") {
                    $('#error-username ,#error-password').hide();
                    window.location.href = 'PS_mainpage/main_personnal.php';
                } else {
                    $(".loading").show();
                    $('#chkststus').hide();
                    cls.GetJSON("PS_processDB/login_DB.php", "CHK_USER", [$('input[name=username]').val()], false, function (data) {
                        if ((data == 0) && ($('#username').val() != '')) {
                            $('#username').parents('.form-line').addClass('form-line focused error');
                            $('#error-username').fadeIn(100);
                        } else {
                            $('#username').parents('.form-line').removeClass('form-line focused error');
                            $('#error-username').fadeOut(100);
                        }
                    });
                    cls.GetJSON("PS_processDB/login_DB.php", "CHK_PASS", [$('input[name=username]').val(), $('input[name=password]').val()], false, function (data) {
                        if ((data == 0) && ($('#password').val() != '')) {
                            $('#password').parents('.form-line').addClass('form-line focused error');
                            $('#error-password').fadeIn(100);
                        } else {
                            $('#password').parents('.form-line').removeClass('form-line focused error');
                            $('#error-password').fadeOut(100);
                        }
                    });
                }
            }
        };
//        event.preventDefault(); หยุดการทำงาน
    }
    function btn_chPass(CHPASS) {
        var user = '';
        var pass = '';
        if ($('#username').val() != '') {
            cls.GetJSON("../PS_processDB/login_DB.php", "CHK_USER", [$('#username').val()], true, function (data) {
                console.log(data);
                if (data == 0) {
                    $('#username').parents('.form-line').addClass('form-line focused error');
                    $('#error-username').fadeIn(100);
                } else {
                    $('#username').parents('.form-line').removeClass('form-line focused error');
                    $('#error-username').fadeOut(100);
                    user = 'success';
                    if ($('#old_pass').val() != '') {
                        cls.GetJSON("../PS_processDB/login_DB.php", "CHK_PASS", [$('#username').val(), $('#old_pass').val()], true, function (data) {
                            if (data == 0) {
                                $('#old_pass').parents('.form-line').addClass('form-line focused error');
                                $('#error-old-pass').fadeIn(100);
                            } else {
                                $('#old_pass').parents('.form-line').removeClass('form-line focused error');
                                $('#error-old-pass').fadeOut(100);
                                pass = 'success';
                                if (($('#password').val() && $('#confirm').val()) != '') {
                                    if ($('#password').val() != $('#confirm').val()) {

                                        $('#error-new-pass ,#error-confirm-pass').parents('.form-line').addClass('form-line focused error');
                                        $('#error-new-pass ,#error-confirm-pass').fadeIn(100);
                                    }
                                    if (($('#password').val() == $('#confirm').val()) && user == pass) {
                                        $('#error-new-pass ,#error-confirm-pass').parents('.form-line').removeClass('form-line focused error');
                                        $('#error-new-pass ,#error-confirm-pass').fadeOut(100);
                                        cls.GetJSON("../PS_processDB/change_pass.php", CHPASS, [card_id, $('#confirm').val()], true, function (data) {
                                            swal("บันทึกสำเร็จ!", "รหัสใหม่พร้อมใช้งาน", "success");
                                            $('#change_pass').modal('hide');
                                        });
                                    }
                                }
                            }
                        });
                    }
                }
            });
        }

    }

</script>