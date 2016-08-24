<?php
if(!empty($content['data'])) {
    $cateIdVn = $content['data']['cate_id_vn'];
    $cateIdEn = $content['data']['cate_id_en'];
    $limit    = $content['data']['limit'];
}

?>
<div class="form-group">
    <label>Danh Mục Hiển Thị : </label><br/>
    <label>Tiếng Việt :</label>
    <select class= "form-control" name = "<?php echo 'cate_' . $content['name'] . '_vn'; ?>">
        <?php
        if(isset($cateTitleVn)&&!empty($cateTitleVn)){
            foreach($cateTitleVn as $key => $val){
                ?>
                <option <?php echo (isset($cateIdVn) && $cateIdVn == $val['id'])? 'selected' : ''; ?> value = "<?php echo $val['id'];?>"> <?php echo $val['title'];?> </option>
            <?php
            }
        }
        ?>
    </select>
    <label>English :</label>
    <select class= "form-control" name = "<?php echo 'cate_' . $content['name'] . '_en'; ?>">
        <?php
        if(isset($cateTitleEn)&&!empty($cateTitleEn)){
            foreach($cateTitleEn as $key => $val){
                ?>
                <option <?php echo (isset($cateIdEn) && $cateIdEn == $val['id'])? 'selected' : ''; ?> value = "<?php echo $val['id'];?>"> <?php echo $val['title'];?> </option>
            <?php
            }
        }
        ?>
    </select>
</div>
<div class="form-group">
    <label>Số Bản ghi hiển thị :</label>
    <input type="text" class="form-control" value="<?php echo (isset($limit)) ? $limit : 5; ?>" name="<?php echo 'number_' . $content['name']; ?>" placeholder="Nhập số bản ghi hiển thị..." >
</div>