<?php
/**
 * Created by PhpStorm.
 * Author: yuanzb (yuan_zb@qq.com)
 * DateTime: 16-6-25 下午4:31
 */

$this->pageTitle='会员列表';
?>


<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="<?php echo $this->createUrl('index/index') ?>">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <a href="<?php echo $this->createUrl('user/list') ?>">会员列表</a>
    </li>
</ul>

<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">会员列表</h3>
                </div>

                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" >
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting">ID</th>
                                        <th class="sorting">姓名</th>
                                        <th class="sorting">加入时间</th>
                                        <th class="sorting">上次登录</th>
                                        <th class="sorting">状态</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ( $user as $item) {?>

                                        <tr role="row" class="odd">
                                            <td class=""><?php echo $item['id']?></td>
                                            <td class=""><?php echo $item['u_name'] ?></td>
                                            <td class="sorting_1"><?php echo $item['u_join_date'] ?></td>
                                            <td class="sorting_1"><?php echo $item['u_login_date'] ?></td>
                                            <td><?php echo $item['u_state'] ?></td>
                                        </tr>
                                    <?php } ?>

</tbody>

</table>
</div>
</div>
</div>
</div>
<!-- /.box-body -->
</div>
</div>
</div>

</section>