<section class="content-header">
  <h1>
    Entry Item
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Information'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('Entry') ?></dt>
            <dd><?= $entryItem->has('entry') ? $this->Html->link($entryItem->entry->id, ['controller' => 'Entries', 'action' => 'view', $entryItem->entry->id]) : '' ?></dd>
            <dt scope="row"><?= __('Account') ?></dt>
            <dd><?= $entryItem->has('account') ? $this->Html->link($entryItem->account->name, ['controller' => 'Accounts', 'action' => 'view', $entryItem->account->id]) : '' ?></dd>
            <dt scope="row"><?= __('Sign') ?></dt>
            <dd><?= h($entryItem->sign) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($entryItem->id) ?></dd>
            <dt scope="row"><?= __('Amount') ?></dt>
            <dd><?= $this->Number->format($entryItem->amount) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($entryItem->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($entryItem->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
