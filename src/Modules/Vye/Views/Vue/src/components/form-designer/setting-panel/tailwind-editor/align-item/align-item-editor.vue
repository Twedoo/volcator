<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.alignItem')">
        <el-select v-model="optionModel.alignItem">
            <el-option
                v-for="item in alignItemConfig"
                :key="item.value"
                :selected="Center"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";

export default {
    name: "AlignItemEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object
    },
    data() {
        return {
            alignItemConfig: [
                { label: "None", value: "" },
                { label: "Start", value: "tsz-items-start" },
                { label: "End", value: "tsz-items-end" },
                { label: "Center", value: "tsz-items-center" },
                { label: "Base line", value: "tsz-items-baseline" },
                { label: "Stretch", value: "tsz-items-stretch" }
            ]
        };
    }
};
</script>

<style scoped></style>
