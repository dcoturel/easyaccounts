<section class="content-header">
  <h1>
    Income
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
            <dd><?= h($income->reference) ?></dd>
            <dt scope="row"><?= __('Cash Resource') ?></dt>
            <dd><?= $income->has('cash_resource') ? $this->Html->link($income->cash_resource->name, ['controller' => 'CashResources', 'action' => 'view', $income->cash_resource->id]) : '' ?></dd>
            <dt scope="row"><?= __('Concept') ?></dt>
            <dd><?= $income->has('concept') ? $this->Html->link($income->concept->name, ['controller' => 'Concepts', 'action' => 'view', $income->concept->id]) : '' ?></dd>
            <dt scope="row"><?= __('Entry') ?></dt>
            <dd><?= $income->has('entry') ? $this->Html->link($income->entry->id, ['controller' => 'Entries', 'action' => 'view', $income->entry->id]) : '' ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($income->id) ?></dd>
            <dt scope="row"><?= __('Amount') ?></dt>
            <dd><?= $this->Number->format($income->amount) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($income->date) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($income->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($income->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
