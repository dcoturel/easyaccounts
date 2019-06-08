<section class="content-header">
  <h1>
    Outcome
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
            <dd><?= h($outcome->reference) ?></dd>
            <dt scope="row"><?= __('Cash Resource') ?></dt>
            <dd><?= $outcome->has('cash_resource') ? $this->Html->link($outcome->cash_resource->name, ['controller' => 'CashResources', 'action' => 'view', $outcome->cash_resource->id]) : '' ?></dd>
            <dt scope="row"><?= __('Concept') ?></dt>
            <dd><?= $outcome->has('concept') ? $this->Html->link($outcome->concept->name, ['controller' => 'Concepts', 'action' => 'view', $outcome->concept->id]) : '' ?></dd>
            <dt scope="row"><?= __('Entry') ?></dt>
            <dd><?= $outcome->has('entry') ? $this->Html->link($outcome->entry->id, ['controller' => 'Entries', 'action' => 'view', $outcome->entry->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($outcome->id) ?></dd>
            <dt scope="row"><?= __('Amount') ?></dt>
            <dd><?= $this->Number->format($outcome->amount) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($outcome->date) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($outcome->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($outcome->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
