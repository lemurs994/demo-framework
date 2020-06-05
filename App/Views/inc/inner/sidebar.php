<?php use app\helpers\Status as Status; ?>

    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

        <?php foreach($sidebar as $link): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= $link->link ?>">
              <i class="<?= $link->icon ?>"></i>
               <?= $link->name ?>
            </a>
          </li>
        <?php endforeach; ?>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>My Projects</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
      </div>
    </nav>
