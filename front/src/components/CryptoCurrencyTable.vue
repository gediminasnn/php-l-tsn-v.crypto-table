<template>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Symbol</th>
            <th>Price</th>
            <th>Market Cap</th>
            <th>24H Change</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="currency in searchResults" :key="currency.id">
            <td>{{ currency.name }}</td>
            <td>{{ currency.symbol }}</td>
            <td>{{ currency.price }}</td>
            <td>{{ currency.market_cap }}</td>
            <td>{{ currency.percent_change_24h }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import type { CryptoCurrencyTableProps } from '@/interfaces/CryptoCurrencyTableProps'

export default defineComponent({
  props: {
    searchResults: Array as CryptoCurrencyTableProps['searchResults']
  }
})
</script>
