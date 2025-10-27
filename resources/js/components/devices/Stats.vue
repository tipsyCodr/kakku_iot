<template>
  <div>
    <Table>
      <TableCaption>A list of your recent devices.</TableCaption>

      <TableHeader>
        <TableRow>
          <TableHead v-for="(key, index) in headers" :key="index">
            {{ key }}
          </TableHead>
        </TableRow>
      </TableHeader>

      <TableBody>
        <TableRow v-for="(row, index) in rows" :key="index">
          <TableCell v-for="key in headers" :key="key">
            {{ row[key] ?? '-' }}
          </TableCell>
        </TableRow>
      </TableBody>
    </Table>
  </div>
</template>

<script setup>
import { ref, watchEffect } from 'vue'
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'

// Props
const props = defineProps({
  stats: {
    type: Array,
    default: () => [],
  },
})

// Dynamic columns and rows
const headers = ref([])
const rows = ref([])

watchEffect(() => {
  if (props.stats.length > 0) {
    // Collect all keys across all JSON rows
    const allKeys = new Set()
    props.stats.forEach(stat => {
      Object.keys(stat).forEach(key => allKeys.add(key))
    })
    headers.value = Array.from(allKeys)
    rows.value = props.stats
  } else {
    headers.value = []
    rows.value = []
  }
})
</script>
