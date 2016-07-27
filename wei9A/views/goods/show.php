<section>
    <h2><strong style="color:grey;">页面标题及表格/分页（根据具体情况列入重点，切勿放置可扩展内容不定的数据）</strong></h2>
    <div class="page_title">
        <h2 class="fl">例如产品详情标题</h2>
        <a class="fr top_rt_btn">右侧按钮</a>
    </div>
    <table class="table">
        <tr>
            <th>公众号名称</th>
            <th>app</th>
            <th>appsearce</th>
        </tr>
        <?php foreach($date as $k=>$v){?>
        <tr>
            <td><?php echo $v['g_name']?></td>
            <td><?php echo $v['g_app']?></td>
            <td><?php echo $v['g_number']?></td>
            <td>
                <a href="#">表内链接</a>
                <a href="index.php?r=goods/del&id=<?=$v['g_id']?>" class="inner_btn">删除</a>
                <a href="index.php?r=goods/up&id=<?=$v['g_id']?>" class="inner_btn">修改</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <aside class="paging">
        <a>第一页</a>
        <a>1</a>
        <a>2</a>
        <a>3</a>
        <a>…</a>
        <a>1004</a>
        <a>最后一页</a>
    </aside>
</section>