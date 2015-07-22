<!-- ********** ASIDE ********** -->
<aside id="<?php echo $sidebar_id ?>" class="dw__sidebar <?php echo $sidebar_class ?> hidden-print">
  <div class="content">
    <div class="toogle hidden-lg hidden-md hidden-sm" data-toggle="collapse" data-target="#<?php echo $sidebar_id ?> .collapse">
      <i class="glyphicon glyphicon-th-list"></i> <?php echo $lang['sidebar'] ?>
    </div>
    <div class="collapse in">
      <?php tpl_includeFile($sidebar_header) ?>
      <?php bootstrap_sidebar(tpl_include_page($sidebar_page, 0, 1)) /* includes the nearest sidebar page */ ?>
      <?php tpl_includeFile($sidebar_footer) ?>
    </div>
  </div>
</aside>
