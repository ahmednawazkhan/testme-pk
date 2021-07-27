<template>
  <div
    class="admin-panel"
    :class="{'openCanvas': openCanvas}"
  >
    <navbar @offCanvas="onOffCanvas()" />

    <div class="container-fluid">
      <div class="row">
        <aside class="col-6 col-sm-3 col-md-2 text-left px-0 border-right offcanvas-collapse">
          <admin-navbar />
        </aside>

        <div class="col admin-content">
          <router-view />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { AdminNavbar, Navbar } from '../../components'

export default {
  components: {
    AdminNavbar,
    Navbar
  },
  data () {
    return {
      openCanvas: false
    }
  },
  methods: {
    onOffCanvas () {
      this.openCanvas = !this.openCanvas
    }
  }
}
</script>

<style lang="scss" scoped>
.admin-panel {
  margin-top: -1rem;
  position: relative;
  min-height: 100%;
  background-color: #f9fbfd;
}

.sidebar {
  margin-top: 3rem;
}

.admin-content {
  text-align: left;
}

@media (min-width: 768px) {
  .sidebar {
    margin-top: 1rem;
    height: 100vh;
  }

  .admin-content {
    padding-top: 1em;
  }
}
</style>

<style lang="scss">
h1, h6 {
  font-size: .625rem;
  margin-bottom: .5625rem;
  font-weight: 500;
  line-height: 1.1;
}

.header {
  margin-bottom: 2rem;
}

.header-body {
  padding-top: 1.5rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #e3ebf6;
  text-align: left;
}

.header-pretitle {
  letter-spacing: .08em;
  text-transform: uppercase;
  color: #95aac9;
}

.header-title {
  margin-bottom: 0;
  letter-spacing: -.02em;
  font-size: 1.5rem;
}
</style>
