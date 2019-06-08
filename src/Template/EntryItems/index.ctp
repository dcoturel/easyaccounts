<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Entry Items

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
                  <th scope="col"><?= $this->Paginator->sort('entry_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('account_id') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('sign') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                  <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($entryItems as $entryItem): ?>
                <tr>
                  <td><?= $this->Number->format($entryItem->id) ?></td>
                  <td><?= $entryItem->has('entry') ? $this->Html->link($entryItem->entry->id, ['controller' => 'Entries', 'action' => 'view', $entryItem->entry->id]) : '' ?></td>
                  <td><?= $entryItem->has('account') ? $this->Html->link($entryItem->account->name, ['controller' => 'Accounts', 'action' => 'view', $entryItem->account->id]) : '' ?></td>
                  <td><?= h($entryItem->sign) ?></td>
                  <td><?= $this->Number->format($entryItem->amount) ?></td>
                  <td><?= h($entryItem->created) ?></td>
                  <td><?= h($entryItem->modified) ?></td>
                  <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $entryItem->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $entryItem->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $entryItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $entryItem->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>