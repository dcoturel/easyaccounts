<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Outcomes

    <div class="pull-right"><?php echo $this->Html->link(__('New'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?php echo __('List'); ?></h3>

          <div class="box-tools">
            <form action="<?php echo $this->Url->build(); ?>" method="POST">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="<?php echo __('Search'); ?>">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('reference') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('cash_resource_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('concept_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('entry_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($outcomes as $outcome): ?>
                <tr>
                  <td><?= $this->Number->format($outcome->id) ?></td>
                  <td><?= h($outcome->reference) ?></td>
                  <td><?= h($outcome->date) ?></td>
                  <td><?= $this->Number->format($outcome->amount) ?></td>
                  <td><?= $outcome->has('cash_resource') ? $this->Html->link($outcome->cash_resource->name, ['controller' => 'CashResources', 'action' => 'view', $outcome->cash_resource->id]) : '' ?></td>
                  <td><?= $outcome->has('concept') ? $this->Html->link($outcome->concept->name, ['controller' => 'Concepts', 'action' => 'view', $outcome->concept->id]) : '' ?></td>
                  <td><?= $outcome->has('entry') ? $this->Html->link($outcome->entry->id, ['controller' => 'Entries', 'action' => 'view', $outcome->entry->id]) : '' ?></td>
                  <td><?= h($outcome->created) ?></td>
                  <td><?= h($outcome->modified) ?></td>
                  <td class="actions text-right">
                  <?php if ($outcome->is_editable): ?>
                      <?= $this->Html->link(__('View'), ['action' => 'view', $outcome->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $outcome->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outcome->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <?php echo $this->Paginator->numbers(); ?>
          </ul>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>