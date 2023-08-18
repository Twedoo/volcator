<template>

    <el-form-item :label="i18nt('designer.setting.tailwind.overflow')">
        <el-select v-model="optionModel.overflow"
                   filterable>
            <el-option
                v-for="item in overflowConfig"
                :key="item.value"
                :class="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"
            >
                <span :class="['tsz-font-bold tsz-uppercase']">{{item.label}}</span>
            </el-option>
        </el-select>
    </el-form-item>

</template>

<script>
    import i18n from "@/utils/i18n";
    import propertyProviderSettingsMixin from "@/components/form-designer/setting-panel/tailwind-editor/propertyProviderSettingsMixin";
    import overflow from "@/components/form-designer/setting-panel/tailwind-editor/overflow/json/overflow-classes.json";

    export default {
        name: 'OverflowEditor',
        mixins: [i18n, propertyProviderSettingsMixin],
        props: {
            designer: Object,
            selectedWidget: Object,
            optionModel: Object,
        },
        data() {
            return {
                overflowConfig: overflow,
            };
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

<style scoped>
</style>

