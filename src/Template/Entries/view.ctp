<section class="content-header">
  <h1>
    Entry
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
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($entry->id) ?></dd>
            <dt scope="row"><?= __('Date') ?></dt>
            <dd><?= h($entry->date) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($entry->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($entry->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Entry Items') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($entry->entry_items)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Entry Id') ?></th>
                    <th scope="col"><?= __('Account Id') ?></th>
                    <th scope="col"><?= __('Sign') ?></th>
                    <th scope="col"><?= __('Amount') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
              <?php foreach ($entry->entry_items as $entryItems): ?>
              <tr>
                    <td><?= h($entryItems->id) ?></td>
                    <td><?= h($entryItems->entry_id) ?></td>
                    <td><?= h($entryItems->account_id) ?></td>
                    <td><?= h($entryItems->sign) ?></td>
                    <td><?= h($entryItems->amount) ?></td>
                    <td><?= h($entryItems->created) ?></td>
                    <td><?= h($entryItems->modified) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('View'), ['controller' => 'EntryItems', 'action' => 'view', $entryItems->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Edit'), ['controller' => 'EntryItems', 'action' => 'edit', $entryItems->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Delete'), ['controller' => 'EntryItems', 'action' => 'delete', $entryItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $entryItems->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
