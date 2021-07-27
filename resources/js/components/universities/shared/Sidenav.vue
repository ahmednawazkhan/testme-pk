<template>
  <div class="sidebar">
    <b-nav vertical>
      <transition
        name="filters-toggle"
        enter-active-class="animated bounceIn"
        leave-active-class="animated zoomOut"
      >
        <b-nav-item
          v-if="tagsHidden"
          @click="showFilters()"
        >
          <span class="menu-title mx-2">
            Show Filters
          </span>
          <i class="fal fa-chevron-right" />
        </b-nav-item>
      </transition>
      <b-nav-item>
        <i
          class="fal fa-tachometer"
          aria-hidden="true"
        />
        <span class="menu-title">
          Dashboard
        </span>
      </b-nav-item>
      <b-nav-item>
        <i
          class="fal fa-calendar-check-o"
          aria-hidden="true"
        />
        <span class="menu-title">
          Take Tests
        </span>
      </b-nav-item>
      <b-nav-item
        :to="{name: 'universities'}"
        exact
      >
        <i
          class="fal fa-university"
          aria-hidden="true"
        />
        <span class="menu-title">
          Universities
        </span>
      </b-nav-item>
      <b-nav-item
        :to="{name: 'tests-results'}"
        exact
      >
        <i
          class="fal fa-history"
          aria-hidden="true"
        />
        <span class="menu-title">
          Histories
        </span>
      </b-nav-item>
      <b-nav-item>
        <i
          class="fal fa-comment-o"
          aria-hidden="true"
        />
        <span class="menu-title">
          Explanations
        </span>
      </b-nav-item>
      <b-nav-item>
        <i
          class="fal fa-certificate"
          aria-hidden="true"
        />
        <span class="menu-title">
          Badges
        </span>
      </b-nav-item>
      <b-nav-item>
        <i
          class="fal fa-trophy"
          aria-hidden="true"
        />
        <span class="menu-title">
          Leaderboards
        </span>
      </b-nav-item>
      <b-nav-item>
        <i
          class="fal fa-shopping-bag"
          aria-hidden="true"
        />
        <span class="menu-title">
          Orders
        </span>
      </b-nav-item>
      <b-nav-item>
        <i
          class="fal fa-users"
          aria-hidden="true"
        />
        <span class="menu-title">
          Referrals
        </span>
      </b-nav-item>
    </b-nav>
  </div>
</template>

<script>
/**
 * Left sidebar nav that hold navigations
 */
export default {
  name: 'Sidenav',
  props: {
    tagsHidden: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {}
  },
  mounted () {
    this.$on('hideTags', () => {
      console.log('Tags sont cache')
    })
  },
  methods: {
    showFilters () {
      this.$emit('showTags')
    }
  }
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
  }
</style>
