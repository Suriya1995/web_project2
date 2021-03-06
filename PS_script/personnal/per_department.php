<script type="text/javascript">
    var cls = new Call_Service();
    var card_id = '<?= $_SESSION["card_id"]; ?>';
    var username = '<?= $_SESSION["username"]; ?>';
    var password = '<?= $_SESSION["password"]; ?>';
    $(function () {
        cls.GetJSON("../../PS_processDB/personnal/per_manageBasic.php", "sl_table_depart", "", true, table_depart);
//        $(document).on("click", ".table_depart tbody tr td:not(:last-child)", function () {
//            var clickedBtnID = $(this).parent().attr('id'); // or var clickedBtnID = this.id
//            console.log(clickedBtnID);
//            cls.GetJSON("../../PS_processDB/personnal/per_manageBasic.php", "sl_dataEdit_depart", [clickedBtnID], true, function (data) {
//                $.each(data, function (i, k) {
//                    $("#dep_nameE").val(data[i].dep_name);
//                    $("#dep_codeE").val(data[i].dep_code)
//                    $("#dep_idE").val(data[i].dep_id)
//                });
//                $("#editDPM").modal("show");
//            });
//        });
    });
    function show_department() {
        cls.GetJSON("../../PS_processDB/personnal/per_manageBasic.php", "sl_table_depart", "", true, table_depart);
    }

    function table_depart(data) {
        $(".table_depart").html('');
        var dataSet = [];
        var a = 0;
        $.each(data, function (i, k) {
            a++;
            dataSet.push(['<center>' + a + '</center>', '<center>' + data[i].dep_code + '</center>', data[i].dep_name, '<center><img class="btn-edit" id="' + data[i].dep_id + '" data-toggle="modal" data-target="#editDPM" onclick="javascript: slEditDPM(this)"/>' + ' ' + '<img class="btn-delete" id="' + data[i].dep_id + '" onclick="javascript: delDPM(this)"/></center>']);
        });
        $('#table_depart_show').html('<table class="table table-bordered table-striped table-hover table_depart dataTable" width="100%"></table>');
        $('.table_depart').DataTable({
            responsive: true,
            data: dataSet,
            columns: [
                {title: "ลำดับ"},
                {title: "รหัส"},
                {title: "ชื่อกลุ่มบริหาร"},
                {title: "..."},
            ],
            "fnRowCallback": function (nRow) {
//                console.log($(nRow).find('img').attr('id'));
//                $(nRow).attr('id', $(nRow).find('img').attr('id'));
//                $(nRow).css('cursor', 'pointer');
            }
        });
    }
    function addDPM(ADPM) {
        cls.GetJSON("../../PS_processDB/personnal/per_manageBasic.php", ADPM, [$('#dep_code').val(), $('#dep_name').val()], true, function (data) {
            show_department();
            swal("บันทึกสำเร็จ!", "ประเภทใหม่พร้อมใช้งาน", "success");
            $('#addDPM').modal('hide');
        });
    }
    function slEditDPM(data) {
        cls.GetJSON("../../PS_processDB/personnal/per_manageBasic.php", "sl_dataEdit_depart", [$(data).attr("id")], true, function (data) {
            $.each(data, function (i, k) {
                $("#dep_nameE").val(data[i].dep_name);
                $("#dep_codeE").val(data[i].dep_code)
                $("#dep_idE").val(data[i].dep_id)
            });
        });
    }
    function editDPM(EDPM) {
        cls.GetJSON("../../PS_processDB/personnal/per_manageBasic.php", EDPM, [$('#dep_idE').val(), $('#dep_codeE').val(), $('#dep_nameE').val()], true, function (data) {
            show_department();
            swal("แก้ไขสำเร็จ!", "ประเภทของคุณ อัพเดทเเล้ว", "success");
            $('#editDPM').modal('hide');
        });
    }
    function delDPM(data) {
        swal({
            title: "คุณต้องการลบหรือไม่?",
            text: "หากลบจะไม่สามารถกู้คืนข้อมูลที่ลบได้อีก!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่, ต้องการลบ!",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: false
        }, function () {
            cls.GetJSON("../../PS_processDB/personnal/per_manageBasic.php", "DDPM", [$(data).attr("id")], true, function (data) {
                show_department();
                swal("ลบสำเร็จ!", "ข้อมูลของคุณถูกลบเรียบร้อยเเล้ว", "success");
            });
        });
    }
</script>