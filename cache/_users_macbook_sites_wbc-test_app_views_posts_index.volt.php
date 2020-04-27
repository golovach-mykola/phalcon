<p><?= $this->tag->linkTo(['posts/create', 'Create Post']) ?></p>
<?= $this->flash->output() ?>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($page->getItems() as $item) { ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['title'] ?></td>
                <td>
                    <?= $this->tag->linkTo(['posts/edit/' . $item['id'], 'Edit']) ?>
                    <?php if($acl->isAllowed('manager', 'posts', 'delete')) {  ?>
                    <?= $this->tag->linkTo(['posts/delete/' . $item['id'], 'Delete', 'onClick' => 'return confirm(\'Are you sure?\')']) ?>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><?= $this->tag->linkTo(['posts/index', 'First', 'class' => 'page-link']) ?></li>
    <li class="page-item"><?= $this->tag->linkTo(['posts/index?page=' . $page->getPrevious(), 'Previous', 'class' => 'page-link']) ?></li>
    <li class="page-item"><?= $this->tag->linkTo(['posts/index?page=' . $page->getNext(), 'Next', 'class' => 'page-link']) ?></li>
    <li class="page-item"><?= $this->tag->linkTo(['posts/index?page=' . $page->getLast(), 'Last', 'class' => 'page-link']) ?></li>
  </ul>
</nav>
Page <?= $page->getCurrent() ?> of <?= $page->getLast() ?>