<template>
  <div
    id="dashboard"
    :class="{'openCanvas': openCanvas}"
  >
    <navbar @offCanvas="onOffCanvas()" />
    <div class="nav-scroller">
      <nav class="nav nav-underline">
        <a
          class="sidebar-collapse active"
          href="#"
        >
          <i
            class="fa fa-bars"
            aria-hidden="true"
          />
        </a>
        <a
          class="nav-link mr-4"
          href="#"
        >
          <i
            class="fa fa-plus"
            aria-hidden="true"
          />
          New message
        </a>
        <a
          class="nav-link"
          href="#"
        >
          <i
            class="fal fa-trash-alt"
            aria-hidden="true"
          />
          Delete
        </a>
        <a
          class="nav-link pl-0"
          href="#"
        >
          <i
            class="fal fa-archive"
            aria-hidden="true"
          />
          Archive
        </a>
        <a
          class="nav-link pl-0"
          href="#"
        >
          <i
            class="fal fa-ban"
            aria-hidden="true"
          />
          Chunk
        </a>
        <a
          class="nav-link pl-0"
          href="#"
        >
          <i
            class="fal fa-trash"
            aria-hidden="true"
          />
          Sweep
        </a>
        <a
          class="nav-link pl-0"
          href="#"
        >
          <i
            class="fa fa-archive"
            aria-hidden="true"
          />
          Move To
        </a>
        <a
          class="nav-link disabled"
          href="#"
        >
          <i
            class="fa fa-archive"
            aria-hidden="true"
          />
          Undo
        </a>
      </nav>
    </div>

    <div class="container-fluid">
      <div class="row">
        <aside class="col-6 col-sm-3 col-md-2 text-left px-0 border-right offcanvas-collapse">
          <sidenav
            :tags-hidden="tagsHidden"
            @showTags="onShowTags()"
          />
        </aside>

        <transition
          name="toggle-filters"
          enter-active-class="animated fadeInLeft"
          leave-active-class="animated bounceOutLeft"
        >
          <div
            class="d-none d-md-block col-md-2 tags p-0 border-right"
            v-if="!tagsHidden"
          >
            <tags @hideTags="onHideTags()" />
          </div>
        </transition>

        <section class="col main-content">
          <router-view />
        </section>
      </div>
    </div>
    <circle-menu class="d-md-none" />
  </div>
</template>

<script>
import { Navbar, Tags, Sidenav, CircleMenu } from '../../../../components'

export default {
  components: {
    Navbar,
    Sidenav,
    Tags,
    CircleMenu
  },
  data () {
    return {
      tagsHidden: false,
      openCanvas: false
    }
  },
  beforeRouteEnter: (to, from, next) => {
    next((vm) => {
      console.log(vm.$auth.check())
    })
  },
  methods: {
    onHideTags () {
      this.tagsHidden = true
    },
    onShowTags () {
      this.tagsHidden = false
    },
    onOffCanvas () {
      this.openCanvas = !this.openCanvas
    }
  }
}
</script>

<style lang="scss" scoped>
  #dashboard {
    background-color: #f4f4f4;
  }

  .nav-scroller {
    font-size: 14px;
    font-weight: 400;
    vertical-align: baseline;
    background-color: #f4f4f4;
    border-bottom: 1px solid #dcdcdc;
    position: relative;
    z-index: 2;
    overflow-y: hidden;

    .nav {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-wrap: nowrap;
      flex-wrap: nowrap;
      margin-top: -1px;
      overflow-x: auto;
      color: rgba(255, 255, 255, .75);
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .nav-underline {
      .nav-link {
        padding-top: .5rem;
        padding-bottom: .5rem;
        font-size: .875rem;

        &:hover {
          color: #007bff;
        }
      }

      .active {
        font-weight: 500;
        color: #343a40;
      }
    }
  }

  .sidebar-collapse {
    width: 48px;
    height: 40px;
    line-height: 40px;
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
      background: #C7E0F4;
    }
  }
</style>
