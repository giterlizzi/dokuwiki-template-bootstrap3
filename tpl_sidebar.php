<!-- ********** ASIDE ********** -->
<div id="dokuwiki__aside" class="col-sm-3 col-md-2">
  <div class="content">
    <div class="toogle hidden-print hidden-lg hidden-md hidden-sm" data-toggle="collapse" data-target="#dokuwiki__aside .collapse">
      <i class="glyphicon glyphicon-th-list"></i> <?php echo $lang['sidebar'] ?>
    </div>
    <div class="collapse in">
      <?php tpl_includeFile('sidebarheader.html') ?>
      <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
      <?php tpl_includeFile('sidebarfooter.html') ?>
    </div>
  </div>
</div>
