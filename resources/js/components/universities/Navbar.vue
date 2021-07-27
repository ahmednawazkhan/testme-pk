<template>
  <b-navbar
    toggleable="md"
    type="dark"
    variant="primary"
    class="p-0"
    fixed="top"
  >
    <button
      type="button"
      role="menuitem"
      class="border-0 mr-2 text-white all-apps"
    >
      <i class="fas fa-th" />
    </button>

    <b-navbar-brand
      class="mr-lg-0"
      :to="{name: 'universities'}"
    >
      afiniti
    </b-navbar-brand>

    <button
      @click.prevent="toggleOffcanvas()"
      class="navbar-toggler"
      type="button"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon" />
    </button>

    <b-collapse
      is-nav
      id="offcanvas"
    >
      <b-nav-form class="form-inline w-50 mr-auto my-2 my-lg-0">
        <b-form-input
          class="mr-sm-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
        />
      </b-nav-form>

      <b-navbar-nav>
        <b-nav-item class="pt-1">
          <i
            class="fal fa-cog fa-lg"
            aria-hidden="true"
          />
        </b-nav-item>

        <b-nav-item class="pt-1">
          <i
            class="fas fa-question fa-lg"
            aria-hidden="true"
          />
        </b-nav-item>

        <b-nav-item-dropdown
          right
          no-caret=""
        >
          <!-- Using button-content slot -->
          <template slot="button-content">
            <b-img
              rounded="circle"
              src="https://picsum.photos/32/32/?image=1027"
              width="32"
              height="32"
              blank-color="#777"
              alt="img"
              class="m-1"
            />
          </template>
          <div
            class="arrow"
            style="left: 124px;"
          />
          <b-dropdown-item href="#">
            Profile
          </b-dropdown-item>
          <b-dropdown-item v-if="$auth.check(['Super admin'])"
            :to="{name: 'admin-overview'}"
          >
            Admin Panel
          </b-dropdown-item>
          <b-dropdown-item href="#"
            @click="logout()"
          >
            Signout
          </b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  name: 'Navbar',
  data () {
    return {}
  },
  methods: {
    toggleOffcanvas () {
      this.$emit('offCanvas')
    },
    logout () {
      this.$auth.logout({
        makeRequest: true,
        success (data) {
          console.log('logout', data)
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
nav.navbar {
  height: 48px;

  input {
    background: rgba(255,255,255,0.7);
    border: none;
    height: calc(2rem + 2px);
    width: calc(75% - 4.6rem);
    border-radius: 0.15rem;
  }

  .all-apps {
    width: 48px;
    height: 48px;
    line-height: 48px;
    color: var(--white);
    background: var(--primary);
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    cursor: pointer;
    position: relative;

    &:hover {
      background: #005A9E;
    }
  }

  i {
    color: #ffffff;
  }
}

.b-nav-dropdown {
  /deep/ a.nav-link {
    padding-top: .25rem !important;
    padding-bottom: 0 !important;
  }

  &.show {
    img {
      border: rgba(0, 120, 215, 0.23) 2px solid;
      box-shadow: 0px 0 30px 1px #b5d6f6;
    }
  }
}

/deep/ .dropdown-menu {
  margin-top: .5rem;
  will-change: transform;
  transition: all .3s ease;

  .dropdown-item {
    font-size: 14px;

    &:hover, &:focus, &.active {
      background-color: #C7E0F4;
    }
  }
}

.arrow {
  position: absolute;
  display: block;
  width: 1rem;
  height: .5rem;
  margin: -1rem 0 0;

  &::before, &::after {
    position: absolute;
    display: block;
    content: "";
    border-color: transparent;
    border-style: solid;
    border-width: 0 .5rem .5rem .5rem;
  }

  &::after {
    top: 1px;
    border-bottom-color: #fff;
  }

  &::before {
    top: 0;
    border-bottom-color: rgba(0,0,0,.25);
  }
}
</style>
