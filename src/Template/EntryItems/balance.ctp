<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Balance

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
                  <th scope="col">Code</th>
                  <th scope="col">Name</th>
                  <th scope="col">Start</th>
                  <th scope="col">D</th>
                  <th scope="col">H</th>
                  <th scope="col">End</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($balance as $balanceItem): ?>
                <tr>
                  <td><?= $this->Html->link($balanceItem["code"], ["action" => "account_ledger", $balanceItem["account_id"]]); ?></td>
                  <td><?= $balanceItem["name"] ?></td>
                  <td><?= $this->Number->format($balanceItem["start"]) ?></td>
                  <td><?= $this->Number->format($balanceItem["debits"]) ?></td>
                  <td><?= $this->Number->format($balanceItem["credits"]) ?></td>
                  <td><?= $this->Number->format($balanceItem["end"]) ?></td>
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