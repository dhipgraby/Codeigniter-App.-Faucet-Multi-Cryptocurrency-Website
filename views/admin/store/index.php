              <section>
  <h2>Store Items</h2>
  <?php echo anchor('admin/store/edit', '<i class="fa fa-plus" aria-hidden="true"></i> Add new Item'); ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Parent</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th> 
      </tr>
    </thead>
    <tbody>
      <?php if(count($stores)): foreach($stores as $store): ?>
    
      <tr>
        <td><?php echo anchor('admin/store/edit/' . $store->id, $store->title); ?></td>
        <td><?php echo $store->parent_slug; ?></td>
        <td><?php echo $store->price; ?></td>
        <td><?php echo btn_edit('admin/store/edit/' . $store->id); ?></td>
        <td><?php echo btn_delete('admin/store/delete/' . $store->id); ?></td>
      </tr>
        <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="3">We could not find any stores.</td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
</section>