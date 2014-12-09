
<div class='box'>
    <div class='box-body pad'>
        <?php echo $this->Form->create('Post', array('action' => 'add', 'autocomplete' => 'off')); ?>
        <input type="hidden" name="id" value="<?php
        if (!empty($post)) {
            echo $post['id'];
        }
        ?>" />
        <textarea name="content" class="bootstrap-wysihtml5" placeholder="<?php echo __('Place some text here'); ?>" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php
            if (!empty($post)) {
                echo $post['content'];
            }
            ?></textarea>

        <div class="btn-toolbar pad">
            <a href="<?php echo Router::url('/posts'); ?>" class="btn btn-default"><?php echo __('Cancel'); ?></a>
            <input type="submit" class="btn btn-success btn-large" value="<?php echo __('Save'); ?>" />
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
