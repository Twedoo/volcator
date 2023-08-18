<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.justify')">
        <el-select v-model="optionModel.justify">
            <el-option
                v-for="item in justifyItemConfig"
                :key="item.value"
                :selected="Start"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";

export default {
    name: "JustifyEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object
    },
    data() {
        return {
            justifyItemConfig: [
                { label: "None", value: "" },
                { label: "Start", value: "tsz-justify-start" },
                { label: "End", value: "tsz-justify-end" },
                { label: "Center", value: "tsz-justify-center" },
                { label: "Between", value: "tsz-justify-between" },
                { label: "Evenly", value: "tsz-justify-evenly" }
            ]
        };
    }
};
</script>

<style scoped></style>
