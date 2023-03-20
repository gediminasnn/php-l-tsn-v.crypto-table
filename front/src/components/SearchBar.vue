<template>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="Search"
          v-model="searchQuery"
          @keyup="debouncedSearchCryptoCurrencies()"
        />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import debounce from 'lodash/debounce'

export default {
  data() {
    return {
      searchQuery: ''
    }
  },
  methods: {
    debouncedSearchCryptoCurrencies: debounce(function (this: any) {
      this.$emit('search', this.searchQuery)
    }, 500)
  },
  emits: ['search']
}
</script>
