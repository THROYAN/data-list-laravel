<template>
    <el-container>
        <el-aside width="200">
            <HouseFilter v-model="filter" @onChange="reload"/>
        </el-aside>
        <el-container>
            <el-main>
                <el-row>
                    <el-table :data="tableData">
                        <el-table-column
                            prop="attributes.name"
                            label="Name"
                            width="180"
                        />
                        <el-table-column
                            prop="attributes.bedroomCount"
                            label="Bedrooms"
                            width="95"
                        />
                        <el-table-column
                            prop="attributes.bathroomCount"
                            label="Bathrooms"
                            width="95"
                        />
                        <el-table-column
                            prop="attributes.storeyCount"
                            label="Storeys"
                            width="95"
                        />
                        <el-table-column
                            prop="attributes.garageCount"
                            label="Garages"
                            width="95"
                        />
                        <el-table-column
                            prop="attributes.price"
                            label="Price"
                            width="125"
                        />
                    </el-table>
                </el-row>
            </el-main>
        </el-container>
    </el-container>
</template>

<script lang="ts">
    import { defineComponent } from 'vue'
    import axios from 'axios'
    import type { House } from '../models/House'
    import qs from 'qs';
    import HouseFilter from './HouseFilter.vue'

    interface HouseResponse {
        data: Array<House>
    }

    export default defineComponent({
        data() {
            return {
                tableData: Array<House>(),
                filter: {
                    name: null,
                    bedroomCount: null,
                    bathroomCount: null,
                    storeyCount: null,
                    garageCount: null,
                    price: [0, 1000000],
                }
            }
        },
        mounted() {
            this.reload();
        },
        methods: {
            reload() {
                const host = import.meta.env.DEV ? '' : import.meta.env.VITE_API_HOST
                
                let url = host + '/api/v1/houses';
                if (this.filter) {
                    url += '?' + qs.stringify({filter: this.filter});
                }
                axios.get<HouseResponse>(url).then(response => {
                    this.tableData = response.data.data
                })
            }
        },
        components: {
            HouseFilter
        }
    })
</script>

<style scoped>
.el-container {
    width: 975px;
}
</style>