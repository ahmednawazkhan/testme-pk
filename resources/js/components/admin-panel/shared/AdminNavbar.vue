<template>
  <div class="sidebar">
    <b-nav vertical>
      <b-nav-item
        :to="{name: 'admin-overview'}"
        disabled
      >
        <i class="far fa-chart-pie" />
        Overview
      </b-nav-item>
    </b-nav>

    <hr class="navbar-divider">

    <b-nav vertical>
      <li class="nav-item">
        <a
          v-b-toggle.collapse1
          href="#"
          class="nav-link"
        >
          <i class="fal fa-home" />
          Dashboards
        </a>
        <b-collapse id="collapse1">
          <b-nav vertical>
            <b-nav-item>
              <i class="far fa-university" />
              University Test
            </b-nav-item>
            <b-nav-item>
              <i class="far fa-file-check" />
              Subject Test
            </b-nav-item>
          </b-nav>
        </b-collapse>
      </li>
      <b-nav-item
        href="#"
        disabled
      >
        <i class="far fa-chart-bar" />
        User Data
      </b-nav-item>
    </b-nav>

    <hr class="navbar-divider">

    <b-nav vertical>
      <li class="nav-item">
        <a
          v-b-toggle.collapse2
          href="#"
          class="nav-link"
        >
          <i class="fal fa-home" />
          MCQ / Questions
        </a>
        <b-collapse id="collapse2">
          <b-nav vertical>
            <b-nav-item :to="{name: 'admin-mcq'}">
              <i class="far fa-university" />
              MCQ Bank
            </b-nav-item>
            <b-nav-item :to="{name: 'mcq-subjects'}">
              <i class="far fa-university" />
              Sections / Chapters
            </b-nav-item>
          </b-nav>
        </b-collapse>
      </li>
    </b-nav>
  </div>
</template>

<script>
export default {
  name: 'AdminNavbar'
}
</script>

<style lang="scss" scoped>
  aside {
    height: stretch;
  }

  .sidebar {
    background-color: #f4f4f4;
    font-size: 14px;
    color: #333333;
    width: 100%;
    padding-top: 1rem;
    position: -webkit-sticky;
    position: sticky;
    top: 3rem;
    z-index: 1020;
    left: 0;
    bottom: 0;

    .nav-item {
      &:hover {
        background-color: #eaeaea;
      }

      .active {
        background-color: #C7E0F4;
      }
    }

    i {
      color: #666666;
    }

    .menu-title {
      margin-left: 1rem;
      color: #333333;
      font-weight: 400;
    }

    .nav-link {
      display: flex;
      align-items: center;
      font-size: .9375rem;

      &[aria-expanded]:after {
        font-family: 'Font Awesome 5 Pro';
        font-style: normal;
        font-weight: 300;
        display: block;
        margin-left: auto;
        content: "\f078";
        transition: transform .2s;
      }

      &[aria-expanded=true]:after {
        transform: rotate(-180deg);
      }

      i {
        display: inline-block;
        min-width: 1.75rem;
        font-size: 1.0625rem;
        line-height: 1.40625rem;
        padding-bottom: .125em;
      }
    }
  }

  .navbar-divider {
    margin-top: auto;
    margin-bottom: auto;
  }
</style>
