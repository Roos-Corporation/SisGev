<template>
    <div class="main-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar">
        <div class="sidebar-header">
          <a href="#" class="sidebar-brand"> Sis <span>Gev</span>
          </a>
          <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <div class="sidebar-body">
          <ul class="nav">
            <li class="nav-item">
                <!-- @click="$router.push('/dashboard')"  -->
              <a href="dashboard"  class="nav-link">
                <i class="link-icon" data-feather="home"></i>
                <span class="link-title">Painel</span>
              </a>
            </li>

            <li class="nav-item nav-category">Cadastros</li>
            <li class="nav-item">
                <!-- @click="$router.push('/events')" -->
              <a href="events"  class="nav-link">
                <i class="link-icon" data-feather="calendar"></i>
                <span class="link-title">Eventos</span>
              </a>
            </li>
            <li class="nav-item">
                <!-- @click="$router.push('/event-rooms')" -->
              <a href="event-rooms"  class="nav-link">
                <i class="link-icon" data-feather="table"></i>
                <span class="link-title">Salas do evento</span>
              </a>
            </li>
            <li class="nav-item">
                <!-- @click="$router.push('/coffee-spaces')"  -->
              <a href="coffee-spaces" class="nav-link">
                <i class="link-icon" data-feather="coffee"></i>
                <span class="link-title">Espaços de café</span>
              </a>
            </li>
            <li class="nav-item">
                <!-- @click="$router.push('/people')" -->
              <a href="people"  class="nav-link">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Pessoas</span>
              </a>
            </li>

            <li class="nav-item nav-category">Processos</li>
            <li class="nav-item">
                <!-- @click="$router.push('/event-participants')" -->
              <a href="event-participants"  class="nav-link">
                <i class="link-icon" data-feather="list"></i>
                <span class="link-title">Lista de participantes</span>
              </a>
            </li>
            <li class="nav-item">
                <!-- @click="$router.push('/reports')"  -->
              <a href="reports" class="nav-link">
                <i class="link-icon" data-feather="book-open"></i>
                <span class="link-title">Relatórios</span>
              </a>
            </li>

          </ul>
        </div>
      </nav>
      <!-- partial -->
      <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar">
          <a href="#" class="sidebar-toggler">
            <i data-feather="menu"></i>
          </a>
          <div class="navbar-content">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                  <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                    <div class="mb-3">
                      <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt="">
                    </div>
                    <div class="text-center">
                      <p class="tx-16 fw-bolder">Amiah Burton</p>
                      <p class="tx-12 text-muted">amiahburton@gmail.com</p>
                    </div>
                  </div>
                  <ul class="list-unstyled p-1">
                    <li class="dropdown-item py-2">
                      <a href="pages/general/profile.html" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="user"></i>
                        <span>Profile</span>
                      </a>
                    </li>
                    <li class="dropdown-item py-2">
                      <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="edit"></i>
                        <span>Edit Profile</span>
                      </a>
                    </li>
                    <li class="dropdown-item py-2">
                      <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="repeat"></i>
                        <span>Switch User</span>
                      </a>
                    </li>
                    <li class="dropdown-item py-2">
                      <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="log-out"></i>
                        <span>Log Out</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <!-- partial -->

        <!-- @yield('page-content') -->
        <RouterView/>
        <!-- partial:partials/_footer.html -->
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
          <p class="text-muted mb-1 mb-md-0">Copyright © 2023 <a href="https://www.SisGev.com" target="_blank">SisGev</a>. </p>
          <p class="text-muted">
            v. 0.1
          </p>
        </footer>
        <!-- partial -->
      </div>
    </div>
</template>
