?>
<div class="user-panel">
    <div class="pull-left image">
        <i class="fa fa-tablet"></i>
    </div>
    <div class="pull-left info">
        <p><?= $this->request->getSession()->read('Auth.User.username') ?></p>
    </div>
</div>
