import type { CryptoCurrency } from './CryptoCurrency'
import type { PropType } from 'vue';

export interface CryptoCurrencyTableProps {
  searchResults: PropType<CryptoCurrency[]>;
}
