<?php
session_start();
require_once '../../config/utils.php';
checkAdminLoggedIn();
// get id from url
$id = isset($_GET['id']) ? $_GET['id'] : -1;
// get data from vehicle types tables by id
$getRoom_galleriesEditQuery = "select * from room_galleries where id = '$id'";
$room_galleriesEdit = queryExecute($getRoom_galleriesEditQuery, false);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once '../_share/style.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include_once '../_share/header.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once '../_share/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Edit room_galleries</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->

                    <form id="edit-our-team-form" action="<?= ADMIN_URL . 'room_galleries/save-edit.php' ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $room_galleriesEdit['id'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Room_id<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="room_id" value="<?= $room_galleriesEdit['room_id'] ?>">
                                    <?php if (isset($_GET['room_iderr'])) : ?>
                                        <label class="error"><?= $_GET['room_iderr'] ?></label>
                                    <?php endif; ?>
                                </div>
                              
                                
                               
                            </div>
                            <div class="col-md-6">
                           
                                <div class="form-group d-flex justify-content-center">
                                    <img src="<?= BASE_URL . $news['image_url']  ?>" width="300" id="preview-img" alt="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="image_url" onchange="util.convertImg(this, '#preview-img', '<?= BASE_URL . $news['image_url']?>')">
                                        <label class="custom-file-label" for="inputGroupFile01">Ảnh<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="from-group pt-2">
                                    <div class="col d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>&nbsp;
                                        <a href="<?= ADMIN_URL . 'room_galleries' ?>" class="btn btn-danger">Hủy</a>
                                    </div>
                                </div>
                            </div>
                    </form>

                    <!-- /.row -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once '../_share/footer.php'; ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php include_once '../_share/script.php'; ?>
    <script>
        $('#edit-vehicle-type-form').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 191,
                    remote: {
                        url: "<?= ADMIN_URL . 'vehicle_types/verify-name-type-existed.php' ?>",
                        type: "post",
                        data: {
                            name: function() {
                                return $("input[name='name']").val();
                            },
                            id: <?= $vehicleTypeEdit['id']?>
                        }
                    }
                },
                seat: {
                    required: true,
                    number: true,
                    min: 9,
                    max: 40
                },
                status: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Hãy nhập loại phương tiện",
                    maxlength: "Số lượng ký tự tối đa bằng 191 ký tự",
                    remote: "Loại phương tiện đã tồn tại."
                },
                seat: {
                    required: "Nhập số ghế có",
                    number: "Hãy nhập số ghế bằng số",
                    min: "Số ghế tối thiểu phải lớn hơn hoặc bằng 9",
                    max: "Số ghế tối đa phải nhỏ hơn 40"
                },
                status: {
                    required: "Chọn trạng thái xe"
                }
            }
        });
    </script>
</body>

</html>