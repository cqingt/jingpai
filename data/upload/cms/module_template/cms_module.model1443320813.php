<div class="cms-page-module-frame module-style-<?php echo $value['module_style']?>">
<div class="cms-module-frame">
        <div class="cms-module-frame-title">
        <!-- 标题 -->
<div class="cms-module-title">
    <h2 id="cms_module_title" nctype="object_module_edit"><?php echo $module_content['cms_module_title'];?></h2>
    <?php if($output['edit_flag']) { ?>    <div class="cms-index-module-handle"><a nctype="btn_module_title_edit" href="JavaScript:void(0);" class="tip-r" title="编辑标题">编辑标题</a></div>
    <?php } ?></div>

    </div>
                    <div nctype="cms_module_content" class="cms-module-frame-w5">
                        <!-- 文章　-->
<div class="cms-module-assembly-html">
    <div class="content-box">
        <div id="block1_html_content" nctype="object_module_edit">
            <?php echo html_entity_decode($module_content['block1_html_content']);?>        </div>
        <?php if($output['edit_flag']) { ?>        <div class="cms-index-module-handle"><a nctype="btn_module_html_edit" href="JavaScript:void(0);" class="tip-l" title="编辑自定义块">编辑自定义块</a></div>
        <?php } ?>    </div>
</div>

            </div>
            <div class="clear"></div>
    </div>
</div>

