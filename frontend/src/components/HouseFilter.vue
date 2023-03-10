<template>
    <el-form v-if="selected" ref="filter-form" :model="selected" label-position="top" size="mini">
        <el-form-item label="Name">
            <el-input placeholder="Name" :clearable="true" v-model="selected.name"></el-input>
        </el-form-item>
        <el-form-item label="Bedrooms">
            <el-input type="number" placeholder="Bedrooms" size="small" :min="0" :clearable="true" v-model="selected.bedroomCount"/>
        </el-form-item>
        <el-form-item label="Bathrooms">
            <el-input type="number" placeholder="Bathrooms" size="small" :min="0" v-model="selected.bathroomCount"/>
        </el-form-item>
        <el-form-item label="Storeys">
            <el-input type="number" placeholder="Storeys" size="small" :min="0" v-model="selected.storeyCount"/>
        </el-form-item>
        <el-form-item label="Garages">
            <el-input type="number" placeholder="Garages" size="small" :min="0" v-model="selected.garageCount"/>
        </el-form-item>
        <el-form-item label="Price">
            <el-slider
                v-model="selected.price"
                range
                :max="maxPrice"
                label="Price"
            />
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="onSubmit">Apply</el-button>
            <el-button @click="onClear">Clear</el-button>
        </el-form-item>
    </el-form>
</template>

<script lang="ts">
    import { defineComponent } from 'vue'
    import type { Filter } from '../models/Filter'
    export default defineComponent({
        props: {
            value: Object as () => Filter,
        },
        data() {
            return {
                selected: this.value,
                maxPrice: 100000,
            }
        },
        methods: {
            onClear() {
                if (!this.selected) {
                    return;
                }
                this.selected.name = null;
                this.selected.bedroomCount = null;
                this.selected.bathroomCount = null;
                this.selected.storeyCount = null;
                this.selected.garageCount = null;
                this.selected.price = [0, this.maxPrice];

                this.onSubmit();
            },
            onSubmit() {
                this.$emit('input', this.selected)
                this.$emit('onChange', this.selected)
            }
        }
    })
</script>

<style scoped>
form {
    margin: 20px;
}
</style>