<template>
  <div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-info flex-column">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">MOHOLAND</a>
      </div>
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item d-flex align-items-center">
              <i class="fas fa-home"></i>
              <router-link :to="{ name: 'home'}" aria-current="page" class="nav-link">خانه</router-link>
            </li>
            <li class="nav-item d-flex align-items-center me-4">
              <i class="fas fa-laptop-medical"></i>
              <router-link :to="{ name: 'about'}" class="nav-link">درباره ما</router-link>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
</template>

<style>
</style>
