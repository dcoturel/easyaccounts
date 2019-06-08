<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Account Ledger

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
        <?php
        $total = $totalInit;        
        ?>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Account</th>
                  <th scope="col">D</th>
                  <th scope="col">H</th>
                  <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td colspan="5">Total at beggining: <?= $this->Number->format($totalInit) ?></td>
                </tr>
              <?php foreach ($entryItems as $entryItem):
              		$total = $entryItem->sign == 'D' ? $total + $entryItem->amount : $total - $entryItem->amount;
              ?>
                <tr>
                  <td><?= $this->Number->format($entryItem->id) ?></td>
                  <td><?= $entryItem->has('account') ? $this->Html->link($entryItem->account->name, ['controller' => 'Accounts', 'action' => 'view', $entryItem->account->id]) : '' ?></td>
                  <td><?= $entryItem->sign == 'D' ? $this->Number->format($entryItem->amount) : "" ?></td>
                  <td><?= $entryItem->sign == 'H' ? $this->Number->format($entryItem->amount) : "" ?></td>
                  <td><?= $this->Number->format($total) ?></td>
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