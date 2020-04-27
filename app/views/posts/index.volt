<p>{{ link_to('posts/create', 'Create Post') }}</p>
{{ flash.output() }}
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
                <td>{{ item['id'] }}</td>
                <td>{{ item['title'] }}</td>
                <td>
                    {{ link_to('posts/edit/' ~item['id'], 'Edit') }}
                    <?php if($acl->isAllowed('manager', 'posts', 'delete')) {  ?>
                    {{ link_to('posts/delete/' ~item['id'], 'Delete', 'onClick': "return confirm('Are you sure?')") }}
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">{{ link_to('posts/index', 'First', 'class': 'page-link') }}</li>
    <li class="page-item">{{ link_to('posts/index?page=' ~page.getPrevious(), 'Previous', 'class': 'page-link') }}</li>
    <li class="page-item">{{ link_to('posts/index?page=' ~page.getNext(), 'Next', 'class': 'page-link') }}</li>
    <li class="page-item">{{ link_to('posts/index?page=' ~page.getLast(), 'Last', 'class': 'page-link') }}</li>
  </ul>
</nav>
Page {{page.getCurrent()}} of {{page.getLast()}}