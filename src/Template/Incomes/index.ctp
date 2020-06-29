<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Incomes

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
              <?php foreach ($incomes as $income): ?>
                <tr>
                  <td><?= $this->Number->format($income->id) ?></td>
                  <td><?= h($income->reference) ?></td>
                  <td><?= h($income->date) ?></td>
                  <td><?= $this->Number->format($income->amount) ?></td>
                  <td><?= $income->has('cash_resource') ? $this->Html->link($income->cash_resource->name, ['controller' => 'CashResources', 'action' => 'view', $income->cash_resource->id]) : '' ?></td>
                  <td><?= $income->has('concept') ? $this->Html->link($income->concept->name, ['controller' => 'Concepts', 'action' => 'view', $income->concept->id]) : '' ?></td>
                  <td><?= $income->has('entry') ? $this->Html->link($income->entry->id, ['controller' => 'Entries', 'action' => 'view', $income->entry->id]) : '' ?></td>
                  <td><?= h($income->created) ?></td>
                  <td><?= h($income->modified) ?></td>
                  <td class="actions text-right">
                  <?php if ($income->is_editable): ?>
                      <?= $this->Html->link(__('View'), ['action' => 'view', $income->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $income->id], ['confirm' => __('Are you sure you want to delete # {0}?', $income->id), 'class'=>'btn btn-danger btn-xs']) ?>
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