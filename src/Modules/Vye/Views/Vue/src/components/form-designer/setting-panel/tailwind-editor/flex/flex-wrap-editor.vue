<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.flexWrap')">
        <el-select v-model="optionModel.flexWrap">
            <el-option
                v-for="item in flexWrapConfig"
                :key="item.value"
                :selected="NoWrap"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";

export default {
    name: "FlexWrapEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object
    },
    data() {
        return {
            flexWrapConfig: [
                { label: "Wrap", value: "tsz-flex-wrap" },
                { label: "NoWrap", value: "tsz-flex-nowrap" },
                { label: "Wrap reverse", value: "tsz-flex-wrap-reverse" }
            ]
        };
    }
};
</script>

<style scoped></style>
