<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.minHeight')">
        <el-select
            v-model="optionModel.minHeight">
            <el-option
                v-for="item in minHeightConfig"
                :key="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import minHeight from "@/components/form-designer/setting-panel/tailwind-editor/sizing/json/min-height-classes.json";

export default {
    name: "MinHeightEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object,
        margin: Object
    },
    data() {
        return {
            minHeightConfig: minHeight
        };
    }
};
</script>

<style scoped></style>
