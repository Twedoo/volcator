<template>
    <el-form-item :label="i18nt('designer.setting.tailwind.font')">
        <el-select
            v-model="optionModel.font">
            <el-option
                v-for="item in fontConfig"
                :key="item.value"
                :selected="None"
                :label="item.label"
                :value="item.value"></el-option>
        </el-select>
    </el-form-item>
</template>

<script>
import i18n from "@/utils/i18n";
import font from "@/components/form-designer/setting-panel/tailwind-editor/text/json/font-classes.json";

export default {
    name: "FontEditor",
    mixins: [i18n],
    props: {
        designer: Object,
        selectedWidget: Object,
        optionModel: Object,
        margin: Object
    },
    data() {
        return {
            fontConfig: font
        };
    }
};
</script>

<style scoped></style>
