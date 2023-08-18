<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.BoxShadow')">
        <el-select v-model="optionModel.boxShadow">
            <el-option
                v-for="item in boxShadowConfig"
                :key="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";

export default {
    name: "BoxShadowEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object
    },
    data() {
        return {
            boxShadowConfig: [
                { label: "Shadow xs", value: "tsz-shadow-xs" },
                { label: "Shadow sm", value: "tsz-shadow-sm" },
                { label: "Shadow", value: "tsz-shadow" },
                { label: "Shadow md", value: "tsz-shadow-md" },
                { label: "Shadow lg", value: "tsz-shadow-lg" },
                { label: "Shadow 2xl", value: "tsz-shadow-2xl" },
                { label: "Shadow inner", value: "tsz-shadow-inner" },
                { label: "Shadow outline", value: "tsz-shadow-outline" },
                { label: "None", value: "tsz-shadow-none" }
            ]
        };
    }
};
</script>

<style scoped></style>
