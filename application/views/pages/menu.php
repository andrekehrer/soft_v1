    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Meu Dinheiro</div>
      </a>

      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item" style="<?php if ($menu == 'dashboard') {
                                    echo "background: #506a79;";
                                  } ?> ">
        <a class="nav-link" href="<?php echo base_url(); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item" style="<?php if ($menu == 'entradas') {
                                    echo "background: #506a79;";
                                  } ?> ">
        <a class="nav-link" href="<?php echo base_url(); ?>/entradas">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Entradas</span></a>
      </li>
      <hr class="sidebar-divider my-0">

      <li class="nav-item" style="<?php if ($menu == 'saidas') {
                                    echo "background: #506a79;";
                                  } ?> ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSaidas" aria-expanded="true" aria-controls="collapseSaidas">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Saidas</span>
        </a>
        <div id="collapseSaidas" class="collapse" aria-labelledby="headingSaidas" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url(); ?>/saidas">Saidas</a>
            <a class="collapse-item" href="<?php echo base_url(); ?>/saidas_v">Variaveis</a>
          </div>
        </div>
      </li>


      <hr class="sidebar-divider my-0">

      <li class="nav-item" style="<?php if ($menu == 'dividas') {
                                    echo "background: #506a79;";
                                  } ?> ">
        <a class="nav-link" href="<?php echo base_url(); ?>/dividas">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dividas</span></a>
      </li>
      <hr class="sidebar-divider my-0">


      <li class="nav-item" style="<?php if ($menu == 'contas') {
                                    echo "background: #506a79;";
                                  } ?> ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContas" aria-expanded="true" aria-controls="collapseContas">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Contas</span></a>
        <div id="collapseContas" class="collapse" aria-labelledby="headingSaidas" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url(); ?>/contas">Gerenciar</a>
            <?php
            if (isset($contas) && $contas >= 1) {
              foreach ($data_contas as $key => $value) {
                echo "<a class='collapse-item' href='" . base_url() . "/contas/" . $value['id'] . "'>" . $value['nome'] . "</a>";
              }
            }
            ?>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider my-0">


      <li class="nav-item" style="<?php if ($menu == 'categorias') {
                                    echo "background: #506a79;";
                                  } ?> ">
        <a class="nav-link" href="<?php echo base_url(); ?>/categorias">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Categorias</span></a>
      </li>

      <hr class="sidebar-divider my-0">


      <li class="nav-item" style="background: #47edef;">
        <a class="nav-link" style="text-align:center" href="<?php echo base_url(); ?>/saidas_v">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span style="color: black">+ Despesa</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>