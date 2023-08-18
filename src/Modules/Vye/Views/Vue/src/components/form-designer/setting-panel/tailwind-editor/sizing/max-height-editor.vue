<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.maxHeight')">
        <el-select
            v-model="optionModel.maxHeight"
            filterable
            remote
            reserve-keyword
            :remote-method="filterRemoteMethod"
            :loading="loading"
            @focus="setCollectionName('maxHeight')">
            <div v-infinite-scroll="loadRemote">
                <el-option
                    v-for="item in optionItems"
                    :key="item.value"
                    :selected="None"
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
    name: "MaxHeightEditor",
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
