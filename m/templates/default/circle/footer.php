<footer>
    <nav>
        <a class="col-4" href="<?php echo M_CIRCLE?>/index.php?act=circle_index&op=index"><i class="fa fa-home fa-fw"></i><p>首页</p></a>
        <a class="col-4" href="index.php?act=circle_search&op=circlr_more"><i class="fa fa-list-ul fa-fw"></i><p>圈子</p></a>
        <a class="col-4" href="index.php?act=circle_member_snshome&op=trace&mid=<?php echo $_SESSION['member_id']?>"><i class="fa fa-shopping-cart fa-fw"></i><p>新鲜事</p></a>
        <a class="col-4" href="index.php?act=circle_sns_circle&mid=<?php echo $_SESSION['member_id']?>"><i class="fa fa-user fa-fw"></i><p>个人中心</p></a>
    </nav>
</footer>