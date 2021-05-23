            <ul class="pagination">
                <?php if ($paginator->getPrevUrl()): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>&order=<?php echo $order; ?>&asc=<?php echo intval($asc) ?>">&laquo; Previous</a></li>
                <?php endif; ?>

                <?php foreach ($paginator->getPages() as $page): ?>
                    <?php if ($page['url']): ?>
                        <li <?php echo $page['isCurrent'] ? 'class="page-item active"' : ''; ?>>
                            <a class="page-link" href="<?php echo $page['url']; ?>&order=<?php echo $order; ?>&asc=<?php echo intval($asc) ?>"><?php echo $page['num']; ?></a>
                        </li>
                    <?php else: ?>
                        <li class="disabled"><span><?php echo $page['num']; ?></span></li>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if ($paginator->getNextUrl()): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>&order=<?php echo $order; ?>&asc=<?php echo intval($asc) ?>">Next &raquo;</a></li>
                <?php endif; ?>
            </ul>
