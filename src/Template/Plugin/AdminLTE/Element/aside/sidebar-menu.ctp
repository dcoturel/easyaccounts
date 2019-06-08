<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MENU</li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-files-o"></i>
      <span>Configuration</span>
      <span class="pull-right-container">
        <span class="label label-primary pull-right">4</span>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo $this->Url->build('/accounts/'); ?>"><i class="fa fa-circle-o"></i> Accounts</a></li>
      <li><a href="<?php echo $this->Url->build('/cash-resources/'); ?>"><i class="fa fa-circle-o"></i> Cash resources</a></li>
      <li><a href="<?php echo $this->Url->build('/concepts/'); ?>"><i class="fa fa-circle-o"></i> Concepts</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-files-o"></i>
      <span>Operation</span>
      <span class="pull-right-container">
        <span class="label label-primary pull-right">4</span>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo $this->Url->build('/incomes/'); ?>"><i class="fa fa-circle-o"></i> Incomes</a></li>
      <li><a href="<?php echo $this->Url->build('/outcomes/'); ?>"><i class="fa fa-circle-o"></i> Outcomes</a></li>
      <li><a href="<?php echo $this->Url->build('/transferences/'); ?>"><i class="fa fa-circle-o"></i> Transferences</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-files-o"></i>
      <span>Information</span>
      <span class="pull-right-container">
        <span class="label label-primary pull-right">4</span>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo $this->Url->build('/entry-items/balance'); ?>"><i class="fa fa-circle-o"></i> Balance</a></li>
      <!-- <li><a href="<?php echo $this->Url->build('/entries/'); ?>"><i class="fa fa-circle-o"></i> Subsidiary Journal</a></li> -->
      <!-- <li><a href="<?php echo $this->Url->build('/entry-items/'); ?>"><i class="fa fa-circle-o"></i> Subsidiary Ledger</a></li> -->
    </ul>
  </li>  
</ul>