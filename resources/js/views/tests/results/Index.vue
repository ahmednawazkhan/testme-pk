<template>
  <div class="tests-results py-4">
    <h1 class="mb-4">
      TEST RESULTS HISTORY
    </h1>

    <b-card>
      <b-table
        responsive
        hover
        head-variant="light"
        :per-page="perPage"
        :current-page="currentPage"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
        :items="items"
        :fields="fields"
      >
        <template
          slot="date_time"
          slot-scope="data"
        >
          {{ data.value.toDateString() }}
        </template>

        <template
          slot="action"
          slot-scope="data"
        >
          <b-button
            size="sm"
            :to="{name: 'result-show', params: {slug: data.item.test_name.toLowerCase()}}"
          >
            VIEW FULL RESULT
          </b-button>
        </template>
      </b-table>
      <template slot="footer">
        <b-pagination
          class="mb-0"
          :per-page="perPage"
          v-model="currentPage"
          :total-rows="items.length"
        />
      </template>
    </b-card>
  </div>
</template>

<script>
export default {
  data () {
    return {
      currentPage: 0,
      perPage: 6,
      sortBy: 'age',
      sortDesc: false,
      fields: [
        { key: 'test_name', label: 'TEST NAME', sortable: true },
        { key: 'result', label: 'RESULT', sortable: true },
        { key: 'date_time', label: 'DATE & TIME', sortable: true },
        { key: 'action', label: '', sortable: false }
      ],
      items: [
        { date_time: new Date(), result: 'Failed', test_name: 'Macdonald' },
        { date_time: new Date(), result: 'Failed', test_name: 'Shaw' },
        { date_time: new Date(), result: 'Passed', test_name: 'Mathmetical' },
        { date_time: new Date(), result: 'Passed', test_name: 'Mathmetical' },
        { date_time: new Date(), result: 'Passed', test_name: 'Mathmetical' },
        { date_time: new Date(), result: 'Failed', test_name: 'English' },
        { date_time: new Date(), result: 'Passed', test_name: 'English' },
        { date_time: new Date(), result: 'Passed', test_name: 'Mathmetical' },
        { date_time: new Date(), result: 'Failed', test_name: 'Shaw' },
        { date_time: new Date(), result: 'Passed', test_name: 'Mathmetical' },
        { date_time: new Date(), result: 'Passed', test_name: 'Mathmetical' }
      ]
    }
  }
}
</script>

<style lang="scss" scoped>
.card {
  margin-bottom: 2rem;
}
.card-body {
  padding-top: 0;
  padding-left: 0;
  padding-right: 0;
}
</style>
