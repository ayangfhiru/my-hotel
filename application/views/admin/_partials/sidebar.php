<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?php echo base_url(); ?>dist/index">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo base_url(); ?>dist/index">St</a>
    </div>

    <ul class="sidebar-menu">
      <!-- Dashboard -->
      <li class="menu-header">Dashboard</li>
      <li class="dropdown <?php echo $this->uri->segment(1) == 'reservation' || $this->uri->segment(1) == 'reservation' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(1) == 'reservation' || $this->uri->segment(2) == 'reservation' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('reservation'); ?>">Reservasi</a>
          </li>
        </ul>
      </li>
      <!-- End Dashboard -->

      <!-- Hotel -->
      <li class="menu-header">Hotel</li>
      <li class="dropdown <?php echo $this->uri->segment(1) == 'hotel' || $this->uri->segment(1) == 'room' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data Hotel</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(1) == 'hotel' || $this->uri->segment(2) == 'hotel' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('hotel'); ?>">Hotel</a>
          </li>
        </ul>
      </li>
      <!-- End Hotel -->

      <!-- Assets -->
      <li class="menu-header">Assets</li>
      <li class="dropdown <?php echo $this->uri->segment(1) == 'facility' || $this->uri->segment(1) == 'equipment' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data Assets</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(1) == 'facility' || $this->uri->segment(2) == 'facility' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('facility'); ?>">Fasilitas</a>
          </li>
          <li class="<?php echo $this->uri->segment(1) == 'bed' || $this->uri->segment(2) == 'facility' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('bed'); ?>">Tempat Tidur</a>
          </li>
        </ul>
      </li>
      <!-- End Assets -->
    </ul>
  </aside>
</div>
