<html>
<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
</head>
<body>
<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th style="width: 3px;">Mã khóa học</th>
        <th>Mã môn</th>
        <th>Tên môn</th>
        <th>Hình thức thi</th>
        <th>Thời gian</th>
        <th>Ngày thi</th>
        <th>Trạng thái</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(isset($list_posts) && count($list_posts)){
        $link = base64_encode(getCurrentUrl());
        foreach($list_posts as $key => $val){
            $active = '<a href = "admin/posts/changeStatus/'.$val['id'].'?redirect='.$link.'"><button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button></a>';
            $pendding = '<a href = "admin/posts/changeStatus/'.$val['id'].'?redirect='.$link.'"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button></a>';
            $class = '';
            if(!empty($val['expected_return_date'])) {
                if (!empty($val['return_date']) && $val['return_date'] <= $val['expected_return_date']) {
                    $class = 'success';
                } elseif (!empty($val['return_date']) && $val['return_date'] > $val['expected_return_date']) {
                    $class = 'warning';
                } elseif (empty($val['return_date']) && $val['expected_return_date'] < date('Y-m-d')) {
                    $class = 'danger';
                }
            }
            ?>
            <tr class="<?php echo $class; ?>" id="<?php echo $key;?>">
                <td width="100px"><?php echo $val['year_code']; ?></td>
                <td width="80px"><?php echo $val['course_code']; ?></td>
                <td width="300px"><?php echo $val['subject_name']; ?></td>
                <td width="100px"><?php echo $form_exam[$val['exam_form']]?></td>
                <td width="80px"><?php echo $val['time']; ?></td>
                <td width="100px">
                    <?php echo date('d/m/Y', strtotime($val['exam_date'])); ?>
                </td>
                <td>
                    <?php if(!empty($val['day_assignment'])) {
                        echo "Ngày giao : " . date('d/m/Y', strtotime($val['day_assignment'])) . '<br/>';
                        echo "Ngày dự kiến trả : " . date('d/m/Y', strtotime($val['expected_return_date'])) . '<br/>';
                        echo "Ngày trả bài : " . ((!empty($val['return_date'])) ? date('d/m/Y', strtotime($val['return_date'])) : 'Chưa trả bài');
                    } else {
                        echo "Chưa giao bài";
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
    }
    else {
        echo '<tr><td colspan="4">Không có dữ liệu</td></tr>';
    }
    ?>
    </tbody>
</table>

</body>
</html>
