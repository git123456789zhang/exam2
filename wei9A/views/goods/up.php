<section>
    <h2><strong style="color:grey;">微信公众号修改</strong></h2>

    <form action="index.php?r=goods/up_pro" method="post" enctype="multipart/form-data">
        <ul class="ulColumn2">
            <input type="hidden" name="g_id" value="<?=$g_id?>"/>
            <li>
                <span class="item_name" style="width:120px;">公众号名称：</span>
                <input type="text" name="g_name" value="<?=$g_name?>" class="textbox textbox_295 placeholder="文本信息提示..."/>
                <span class="errorTips">错误提示信息...</span>
            </li>
            <li>
                <span class="item_name" style="width:120px;">APPid：</span>
                <input type="text" name="g_app" value="<?=$g_app?>" class="textbox textbox_295 placeholder="文本信息提示..."/>
                <span class="errorTips">错误提示信息...</span>
            </li>
            <li>
                <span class="item_name" style="width:120px;">appsearce：</span>
                <input type="text" name="g_number" value="<?=$g_number?>" class="textbox textbox_295 placeholder="文本信息提示..."/>
                <span class="errorTips">错误提示信息...</span>
            </li>
            <!--        <li>-->
            <!--            <span class="item_name" style="width:120px;">上传图片：</span>-->
            <!--            <label class="uploadImg">-->
            <!--                <input type="file" name="g_img"/>-->
            <!--                <span>上传图片</span>-->
            <!--            </label>-->
            <!--        </li>-->
            <li>
                <span class="item_name" style="width:120px;"></span>
                <input type="submit" class="link_btn"/>
            </li>

        </ul>
    </form>
</section>