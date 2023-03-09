<template>
    <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column
        prop="attributes.name"
        label="Name"
        width="180"
      />
      <el-table-column
        prop="attributes.bedroomCount"
        label="Bedrooms"
        width="100"
      />
      <el-table-column
        prop="attributes.bathroomCount"
        label="Bathrooms"
        width="100"
      />
      <el-table-column
        prop="attributes.storeyCount"
        label="Storeys"
        width="100"
      />
      <el-table-column
        prop="attributes.garageCount"
        label="Garages"
        width="100"
      />
      <el-table-column
        prop="attributes.price"
        label="Price"
        width="100"
      />
    </el-table>
  </template>

  <script lang="ts">
    import { defineComponent } from 'vue'
    import axios from 'axios'
    import type { House } from '../models/House'
    import queryString from 'query-string'

    interface HouseResponse {
      data: Array<House>
    }

    export default defineComponent({
      props: {
        filter: Object,
      },
      data() {
        return {
          tableData: Array<House>()
        }
      },
      mounted() {
        const host = import.meta.env.DEV ? '' : import.meta.env.VITE_API_HOST

        let url = host + '/api/v1/houses';
        if (this.filter) {
          url += '?' + queryString.stringify(this.filter);
        }
        axios.get<HouseResponse>(url).then(response => {
          this.tableData = response.data.data
        })
      }
    })
  </script>