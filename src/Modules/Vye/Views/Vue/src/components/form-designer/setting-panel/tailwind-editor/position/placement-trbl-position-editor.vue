<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.placementTrbl')">
        <el-select
            v-model="optionModel.placementTrbl"
            filterable
            remote
            reserve-keyword
            :remote-method="filterRemoteMethod"
            :loading="loading"
            @focus="setCollectionName('placementTrbl')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value"></el-option>
            </div>
        </el-select>
    </el-form-item>
</template>

<script>
    import i18n from "@/utils/i18n";
    import propertyProviderSettingsMixin from "@/components/form-designer/setting-panel/tailwind-editor/propertyProviderSettingsMixin";

    export default {
        name: "PlacementTrblPositionEditor",
        mixins: [i18n, propertyProviderSettingsMixin],
        props: {
            designer: Object,
            selectedWidget: Object,
            optionModel: Object,
            margin: Object
        },
        computed: {
            //
        },
        methods: {
            //
        },
        mounted() {
            //
        },
    };
</script>

<style scoped></style>
