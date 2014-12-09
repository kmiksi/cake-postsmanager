<ul class="timeline">
    <?php
    if (!empty($posts) && count($posts) > 0) {
        $lastday = '';
        // quick workaroud for timeline broken issue:
        $replaces = array(
            '/<i[ \t]*>/' => '<span style="font-style: italic">',
            '/<i[ \t]/' => '<span style="font-style: italic"',
            '/<\/i>/' => '</span>',
        );
        foreach ($posts as $post) {
            //list($day, $time) = explode(' ', $post['Post']['created']);
            list($day, $time) = array($post['Post']['day'], $post['Post']['time']);
            if ($lastday != $day) {
                $lastday = $day;
                ?>
                <li class="time-label">
                    <span class="bg-blue-gradient">
                        <i class="fa fa-calendar"></i>
                        <?php echo $day; ?>
                    </span>
                </li>
                <?php
            }
            ?>
            <li>
                <!--<i class="fa fa-envelope bg-blue"></i>-->
                <img src="/adminlte/img/<?php echo $avatars[$post['User']['id'] % (count($avatars) - 1)] ?>.png" class="user image fa">
                <div class="timeline-item">
                    <span class="time" title="<?php echo $post['Post']['created']; ?>"><i class="fa fa-clock-o"></i> <?php echo $time; ?></span>
                    <h3 class="timeline-header"><a href="<?php echo Router::url('/users/profile/' . $post['User']['id']); ?>"><?php echo $post['User']['name']; ?></a> ...</h3>
                    <div class="timeline-body">
                        <?php echo preg_replace(array_keys($replaces), array_values($replaces), $post['Post']['content']); ?>
                    </div>
                    <div class="timeline-footer">
                        <a href="<?php echo Router::url('/posts/edit/' . $post['Post']['id']); ?>" class="btn btn-primary btn-xs">Edit</a>
                        <a href="<?php echo Router::url('/posts/delete/' . $post['Post']['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
                    </div>
                </div>
            </li>
            <?php
        }
    } else {
        ?>
        <li class="time-label">
            <span class="bg-red">
                <?php echo date('D, d M Y'); ?>
            </span>
        </li>
        <li>
            <i class="fa fa-thumbs-down bg-olive"></i>
            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo __('just now'); ?></span>

                <div class="timeline-body">
                    <?php echo __('There are no posts to see... You can <a href="%s" class="btn btn-primary btn-small"><i class="fa fa-plus"></i> Add a post now</a>', Router::url('/posts/add')); ?>
                </div>

            </div>
        </li>
        <?php
    }
    ?>

    <li>
        <i class="fa fa-clock-o"></i>
    </li>
</ul>
