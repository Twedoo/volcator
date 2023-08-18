<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.minWidth')">
        <el-select
            v-model="optionModel.minWidth">
            <el-option
                v-for="item in minWidthConfig"
                :key="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import minWidth from "@/components/form-designer/setting-panel/tailwind-editor/sizing/json/min-width-classes.json";

export default {
    name: "MinWidthEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object,
        margin: Object
    },
    data() {
        return {
            minWidthConfig: minWidth
        };
    }
};
</script>

<style scoped></style>
