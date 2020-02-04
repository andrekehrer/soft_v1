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
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span style="<?php if($menu == 'dashboard'){echo "border: 1px white solid;border-radius: 5px;";} ?> ">Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEntradas" aria-expanded="true" aria-controls="collapseEntradas">
            <i class="fas fa-fw fa-wrench"></i>
            <span style="<?php if($menu == 'entradas'){echo "border: 1px white solid;border-radius: 5px;";} ?> ">Entradas ></span>
          </a>
          <div id="collapseEntradas" class="collapse" aria-labelledby="headingEntradas" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?php echo base_url(); ?>/entradas">Fixas</a>
              <a class="collapse-item" href="<?php echo base_url(); ?>/">Variaveis</a>
            </div>
          </div>
        </li>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSaidas" aria-expanded="true" aria-controls="collapseSaidas">
            <i class="fas fa-fw fa-wrench"></i>
            <span style="<?php if($menu == 'saidas'){echo "border: 1px white solid;border-radius: 5px;";} ?> ">Saidas ></span>
          </a>
          <div id="collapseSaidas" class="collapse" aria-labelledby="headingSaidas" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?php echo base_url(); ?>/saidas">saidas</a>
              <a class="collapse-item" href="<?php echo base_url(); ?>/saidas_v">Variaveis</a>
            </div>
          </div>
        </li>

        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
<!--         <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>/saidas_v" style="background: #28d8c2;color: black;text-align: center;">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>+ DESPESA</span></a>
        </li>      
          <hr class="sidebar-divider my-0"> -->

          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url(); ?>/categorias">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span style="<?php if($menu == 'categorias'){echo "border: 1px white solid;border-radius: 5px;";} ?> ">Categorias</span></a>
            </li>

            <hr class="sidebar-divider my-0">


                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                  <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

              </ul>