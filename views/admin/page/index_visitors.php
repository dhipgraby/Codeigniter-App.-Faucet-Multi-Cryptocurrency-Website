              <section>
  <h2>Menu for Visitors</h2>
  <?php echo anchor('admin/menu/edit', '<i class="fa fa-plus" aria-hidden="true"></i> Add new page'); ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Parent</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($pages)): foreach($pages as $page): ?>
    
      <tr>
        <td><?php echo anchor('admin/menu/edit/' . $page->id, $page->title); ?></td>
        <td><?php echo $page->parent_slug; ?></td>
        <td><?php echo btn_edit('admin/menu/edit/' . $page->id); ?></td>
        <td><?php echo btn_delete('admin/menu/delete/' . $page->id); ?></td>
      </tr>
        <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="3">We could not find any menu pages.</td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
</section>