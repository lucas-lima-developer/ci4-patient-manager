<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center mb-0">
        <li class="page-item <?= $pager->hasPrevious() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->hasPrevious() ? $pager->getPrevious() : '#' ?>">
                <i class="bi bi-chevron-left"></i>
            </a>
        </li>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
            </li>
        <?php endforeach ?>

        <li class="page-item <?= $pager->hasNext() ? '' : 'disabled' ?>">
            <a class="page-link" href="<?= $pager->hasNext() ? $pager->getNext() : '#' ?>">
                <i class="bi bi-chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>
