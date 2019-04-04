              <section>
  <h2>faq/<?php echo $topic; ?></h2>
  <?php echo anchor('admin/faq/edit', '<i class="fa fa-plus" aria-hidden="true"></i> Add new FAQ'); ?>
  <table class="table table-striped">
    <thead>
      <tr>
       
        <th>Title</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($articles)): foreach($articles as $article): ?>
    
      <tr>

        <td><?php echo anchor('admin/faq/edit/' . $article->id, $article->title); ?></td>
     
        <td><?php echo btn_edit('admin/faq/edit/' . $article->id); ?></td>
        <td><?php echo btn_delete('admin/faq/delete/' . $article->id); ?></td>
      </tr>
        <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="3">We could not find any FAQ.</td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
</section>