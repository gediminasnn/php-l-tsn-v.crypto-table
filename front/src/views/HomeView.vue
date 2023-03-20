<template>
  <div>
    <SearchBar @search="searchCryptoCurrencies" />
    <CryptoTable :searchResults="searchResults" />
  </div>
</template>

<script lang="ts">
import SearchBar from '../components/SearchBar.vue'
import CryptoTable from '../components/CryptoCurrencyTable.vue'
import type { CryptoCurrency } from '@/interfaces/CryptoCurrency'

export default {
  components: {
    SearchBar,
    CryptoTable
  },
  data() {
    return {
      searchResults: []
    }
  },
  methods: {
    async searchCryptoCurrencies(searchQuery: string = '') {
      const API_ENDPOINT = 'http://127.0.0.1:8000/api/cryptocurrencies'
      const perPage = 100
      const currentPage = 1

      try {
        const response = await fetch(
          `${API_ENDPOINT}?search=${searchQuery.toLowerCase()}&perPage=${perPage}&page=${currentPage}`
        )
        const { data } = await response.json()

        this.searchResults = data.map(function (currency: CryptoCurrency) {
          return {
            id: currency.id,
            name: currency.name,
            symbol: currency.symbol,
            price: currency.price,
            market_cap: currency.market_cap,
            percent_change_24h: currency.percent_change_24h
          }
        })
      } catch (error) {
        console.error(error)
      }
    }
  },
  mounted() {
    this.searchCryptoCurrencies()
  }
}
</script>
