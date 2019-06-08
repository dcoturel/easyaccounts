<section class="content-header">
  <h1>
    Transference
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
            <dt scope="row"><?= __('Reference') ?></dt>
            <dd><?= h($transference->reference) ?></dd>
            <dt scope="row"><?= __('Entry') ?></dt>
            <dd><?= $transference->has('entry') ? $this->Html->link($transference->entry->id, ['controller' => 'Entries', 'action' => 'view', $transference->entry->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($transference->id) ?></dd>
            <dt scope="row"><?= __('Amount') ?></dt>
            <dd><?= $this->Number->format($transference->amount) ?></dd>
            <dt scope="row"><?= __('Cash Resource Out Id') ?></dt>
            <dd><?= $this->Number->format($transference->cash_resource_out_id) ?></dd>
            <dt scope="row"><?= __('Cash Resource In Id') ?></dt>
            <dd><?= $this->Number->format($transference->cash_resource_in_id) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($transference->date) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($transference->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($transference->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
